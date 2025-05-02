from django.db import models
from student.models import Student

class Course(models.Model):
    course_name = models.CharField(max_length=50)
    question_number = models.PositiveIntegerField()
    total_marks = models.PositiveIntegerField()
    total_time = models.PositiveIntegerField(default=30)  # New field added for exam duration

    def __str__(self):
        return f"{self.course_name} ({self.total_marks} Marks)"

class Question(models.Model):
    course = models.ForeignKey(Course, on_delete=models.CASCADE)
    marks = models.PositiveIntegerField()
    question = models.CharField(max_length=600)
    option1 = models.CharField(max_length=200)
    option2 = models.CharField(max_length=200)
    option3 = models.CharField(max_length=200)
    option4 = models.CharField(max_length=200)

    cat = (
        ('Option1', 'Option1'),
        ('Option2', 'Option2'),
        ('Option3', 'Option3'),
        ('Option4', 'Option4'),
    )
    answer = models.CharField(max_length=200, choices=cat)

    def __str__(self):
        return f"Q: {self.question[:50]}... ({self.marks} Marks)"

class Result(models.Model):
    student = models.ForeignKey(Student, on_delete=models.CASCADE)
    exam = models.ForeignKey(Course, on_delete=models.CASCADE)
    marks = models.PositiveIntegerField()
    date = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"{self.student.get_name} - {self.exam.course_name}: {self.marks}/{self.exam.total_marks}"

    @property
    def percentage(self):
        return (self.marks / self.exam.total_marks) * 100 if self.exam.total_marks else 0
