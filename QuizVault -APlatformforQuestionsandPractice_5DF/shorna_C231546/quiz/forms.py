from django import forms
from django.contrib.auth.models import User
from . import models

class ContactusForm(forms.Form):
    Name = forms.CharField(max_length=30, widget=forms.TextInput(attrs={'class': 'form-control'}))
    Email = forms.EmailField(widget=forms.EmailInput(attrs={'class': 'form-control'}))
    Message = forms.CharField(
        max_length=500,
        widget=forms.Textarea(attrs={'rows': 3, 'cols': 30, 'class': 'form-control'})
    )

class TeacherSalaryForm(forms.Form):
    salary = forms.IntegerField(widget=forms.NumberInput(attrs={'class': 'form-control'}))

class CourseForm(forms.ModelForm):
    class Meta:
        model = models.Course
        fields = ['course_name', 'question_number', 'total_marks', 'total_time']  # Added total_time field
        widgets = {
            'course_name': forms.TextInput(attrs={'class': 'form-control'}),
            'question_number': forms.NumberInput(attrs={'class': 'form-control'}),
            'total_marks': forms.NumberInput(attrs={'class': 'form-control'}),
            'total_time': forms.NumberInput(attrs={'class': 'form-control', 'placeholder': 'Time in minutes'}),  # New field
        }

class QuestionForm(forms.ModelForm):
    # This will show a dropdown where the __str__ method of the Course model is displayed
    courseID = forms.ModelChoiceField(
        queryset=models.Course.objects.all(),
        empty_label="Select Course",
        to_field_name="id",
        widget=forms.Select(attrs={'class': 'form-control'})
    )

    class Meta:
        model = models.Question
        fields = ['marks', 'question', 'option1', 'option2', 'option3', 'option4', 'answer']
        widgets = {
            'marks': forms.NumberInput(attrs={'class': 'form-control'}),
            'question': forms.Textarea(attrs={'rows': 3, 'cols': 50, 'class': 'form-control'}),
            'option1': forms.TextInput(attrs={'class': 'form-control'}),
            'option2': forms.TextInput(attrs={'class': 'form-control'}),
            'option3': forms.TextInput(attrs={'class': 'form-control'}),
            'option4': forms.TextInput(attrs={'class': 'form-control'}),
            'answer': forms.Select(attrs={'class': 'form-control'}),
        }
