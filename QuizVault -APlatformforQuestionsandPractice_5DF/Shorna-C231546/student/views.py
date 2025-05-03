from django.shortcuts import render, redirect, reverse
from . import forms, models
from django.db.models import Sum
from django.contrib.auth.models import Group
from django.http import HttpResponseRedirect
from django.contrib.auth.decorators import login_required, user_passes_test
from django.conf import settings
from datetime import date, timedelta
from quiz import models as QMODEL
from teacher import models as TMODEL

# Check if the user is a student
def is_student(user):
    return user.groups.filter(name='STUDENT').exists()

# Render the page for signup/login button for students
def studentclick_view(request):
    if request.user.is_authenticated:
        return HttpResponseRedirect('afterlogin')
    return render(request, 'student/studentclick.html')

# Handle student signup
def student_signup_view(request):
    userForm = forms.StudentUserForm()
    studentForm = forms.StudentForm()
    mydict = {'userForm': userForm, 'studentForm': studentForm}

    if request.method == 'POST':
        userForm = forms.StudentUserForm(request.POST)
        studentForm = forms.StudentForm(request.POST, request.FILES)

        if userForm.is_valid() and studentForm.is_valid():
            # Save user and set password
            user = userForm.save()
            user.set_password(user.password)
            user.save()

            # Save student details
            student = studentForm.save(commit=False)
            student.user = user
            student.save()

            # Add user to student group
            my_student_group, created = Group.objects.get_or_create(name='STUDENT')
            my_student_group.user_set.add(user)

            return HttpResponseRedirect('studentlogin')

    return render(request, 'student/studentsignup.html', context=mydict)

# Student Dashboard View
@login_required(login_url='studentlogin')
@user_passes_test(is_student)
def student_dashboard_view(request):
    try:
        student = models.Student.objects.get(user_id=request.user.id)  # Get the student object
    except models.Student.DoesNotExist:
        student = None

    context = {
        'student': student,  # Pass the student object to the context
        'total_course': QMODEL.Course.objects.all().count(),
        'total_question': QMODEL.Question.objects.all().count(),
    }
    return render(request, 'student/student_dashboard.html', context=context)

# Display all courses available for the student to take the exam
@login_required(login_url='studentlogin')
@user_passes_test(is_student)
def student_exam_view(request):
    courses = QMODEL.Course.objects.all()
    return render(request, 'student/student_exam.html', {'courses': courses})

# Display details of a particular course
@login_required(login_url='studentlogin')
@user_passes_test(is_student)
def take_exam_view(request, pk):
    course = QMODEL.Course.objects.get(id=pk)
    total_questions = QMODEL.Question.objects.filter(course=course).count()
    questions = QMODEL.Question.objects.filter(course=course)
    total_marks = sum(q.marks for q in questions)

    return render(request, 'student/take_exam.html', {
        'course': course,
        'total_questions': total_questions,
        'total_marks': total_marks
    })

# Start the exam for a specific course
@login_required(login_url='studentlogin')
@user_passes_test(is_student)
def start_exam_view(request, pk):
    course = QMODEL.Course.objects.get(id=pk)
    questions = QMODEL.Question.objects.filter(course=course)

    # Set course ID in the cookies for tracking
    response = render(request, 'student/start_exam.html', {'course': course, 'questions': questions})
    response.set_cookie('course_id', course.id)
    return response

# Calculate the marks after the student submits the exam
@login_required(login_url='studentlogin')
@user_passes_test(is_student)
def calculate_marks_view(request):
    course_id = request.COOKIES.get('course_id')

    if course_id:
        course = QMODEL.Course.objects.get(id=course_id)
        questions = QMODEL.Question.objects.filter(course=course)
        total_marks = 0

        # Calculate total marks based on answers
        for i, question in enumerate(questions):
            selected_ans = request.COOKIES.get(str(i+1))
            if selected_ans == question.answer:
                total_marks += question.marks

        # Save the result
        student = models.Student.objects.get(user_id=request.user.id)
        result = QMODEL.Result(marks=total_marks, exam=course, student=student)
        result.save()

        return HttpResponseRedirect('view-result')

# View the result of the student
@login_required(login_url='studentlogin')
@user_passes_test(is_student)
def view_result_view(request):
    courses = QMODEL.Course.objects.all()
    return render(request, 'student/view_result.html', {'courses': courses})

# Check the marks of the student for a specific course
@login_required(login_url='studentlogin')
@user_passes_test(is_student)
def check_marks_view(request, pk):
    course = QMODEL.Course.objects.get(id=pk)
    student = models.Student.objects.get(user_id=request.user.id)
    results = QMODEL.Result.objects.filter(exam=course, student=student)

    return render(request, 'student/check_marks.html', {'results': results})

# Display student's marks for all courses
@login_required(login_url='studentlogin')
@user_passes_test(is_student)
def student_marks_view(request):
    courses = QMODEL.Course.objects.all()
    return render(request, 'student/student_marks.html', {'courses': courses})

