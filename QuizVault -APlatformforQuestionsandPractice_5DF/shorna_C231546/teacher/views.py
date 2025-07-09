from django.shortcuts import render, redirect, reverse
from . import forms, models
from django.db.models import Sum
from django.contrib.auth.models import Group
from django.http import HttpResponseRedirect
from django.contrib.auth.decorators import login_required, user_passes_test
from django.conf import settings
from datetime import date, timedelta
from quiz import models as QMODEL
from student import models as SMODEL
from quiz import forms as QFORM

# For showing signup/login button for teacher
def teacherclick_view(request):
    if request.user.is_authenticated:
        return HttpResponseRedirect('afterlogin')
    return render(request, 'teacher/teacherclick.html')

# Teacher Signup view
def teacher_signup_view(request):
    userForm = forms.TeacherUserForm()
    teacherForm = forms.TeacherForm()

    if request.method == 'POST':
        userForm = forms.TeacherUserForm(request.POST)
        teacherForm = forms.TeacherForm(request.POST, request.FILES)
        if userForm.is_valid() and teacherForm.is_valid():
            user = userForm.save()
            user.set_password(user.password)
            user.save()
            teacher = teacherForm.save(commit=False)
            teacher.user = user
            teacher.save()

            # Add user to teacher group
            my_teacher_group, created = Group.objects.get_or_create(name='TEACHER')
            my_teacher_group.user_set.add(user)
            return HttpResponseRedirect('teacherlogin')

    return render(request, 'teacher/teachersignup.html', {'userForm': userForm, 'teacherForm': teacherForm})

# Custom function to check if user is a teacher
def is_teacher(user):
    return user.groups.filter(name='TEACHER').exists()

# Teacher Dashboard View
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def teacher_dashboard_view(request):
    context = {
        'total_course': QMODEL.Course.objects.all().count(),
        'total_question': QMODEL.Question.objects.all().count(),
        'total_student': SMODEL.Student.objects.all().count(),
        'teacher_name': request.user.first_name + " " + request.user.last_name,  # Add teacher name
        'teacher_mobile': request.user.teacher.mobile,  # Teacher mobile from Teacher model
        'teacher_salary': request.user.teacher.salary,  # Teacher salary from Teacher model
    }
    return render(request, 'teacher/teacher_dashboard.html', context)

# Teacher Exam View
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def teacher_exam_view(request):
    return render(request, 'teacher/teacher_exam.html')

# Add Exam View
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def teacher_add_exam_view(request):
    courseForm = QFORM.CourseForm()

    if request.method == 'POST':
        courseForm = QFORM.CourseForm(request.POST)
        if courseForm.is_valid():
            courseForm.save()
            return HttpResponseRedirect('/teacher/teacher-view-exam')
        else:
            print("Form is invalid")

    return render(request, 'teacher/teacher_add_exam.html', {'courseForm': courseForm})

# View Exams
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def teacher_view_exam_view(request):
    courses = QMODEL.Course.objects.all()
    return render(request, 'teacher/teacher_view_exam.html', {'courses': courses})

# Delete Exam View
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def delete_exam_view(request, pk):
    course = QMODEL.Course.objects.get(id=pk)
    course.delete()
    return HttpResponseRedirect('/teacher/teacher-view-exam')

# Teacher Question View
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def teacher_question_view(request):
    return render(request, 'teacher/teacher_question.html')

# Add Question View
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def teacher_add_question_view(request):
    questionForm = QFORM.QuestionForm()

    if request.method == 'POST':
        questionForm = QFORM.QuestionForm(request.POST)
        if questionForm.is_valid():
            question = questionForm.save(commit=False)
            course = QMODEL.Course.objects.get(id=request.POST.get('courseID'))
            question.course = course
            question.save()
            return HttpResponseRedirect('/teacher/teacher-view-question')
        else:
            print("Form is invalid")

    return render(request, 'teacher/teacher_add_question.html', {'questionForm': questionForm})

# View Questions
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def teacher_view_question_view(request):
    courses = QMODEL.Course.objects.all()
    return render(request, 'teacher/teacher_view_question.html', {'courses': courses})

# See Questions by Course
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def see_question_view(request, pk):
    questions = QMODEL.Question.objects.filter(course_id=pk)
    return render(request, 'teacher/see_question.html', {'questions': questions})

# Remove Question View
@login_required(login_url='teacherlogin')
@user_passes_test(is_teacher)
def remove_question_view(request, pk):
    question = QMODEL.Question.objects.get(id=pk)
    question.delete()
    return HttpResponseRedirect('/teacher/teacher-view-question')
