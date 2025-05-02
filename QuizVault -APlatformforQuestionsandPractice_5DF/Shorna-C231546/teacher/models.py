from django.db import models
from django.contrib.auth.models import User

class Teacher(models.Model):
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    profile_pic = models.ImageField(upload_to='profile_pic/Teacher/', null=True, blank=True)
    address = models.CharField(max_length=40)
    mobile = models.CharField(max_length=20, null=False)
    status = models.BooleanField(default=False)
    salary = models.PositiveIntegerField(null=True)

    # Property to return the full name of the teacher
    @property
    def get_name(self):
        return f"{self.user.first_name} {self.user.last_name}"

    # Property to return the mobile number
    @property
    def get_mobile(self):
        return self.mobile

    # Property to return the salary
    @property
    def get_salary(self):
        return self.salary

    # Fallback string representation for teacher object
    def __str__(self):
        return f"{self.user.first_name} {self.user.last_name} ({self.mobile})"
