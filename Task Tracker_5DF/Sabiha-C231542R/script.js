let currentUser = null;
let users = JSON.parse(localStorage.getItem('users')) || [];

// Save updated users to localStorage
function saveUsers() {
  localStorage.setItem('users', JSON.stringify(users));
}

// Show login page
function showLoginPage() {
  document.getElementById('taskPage').style.display = 'none';
  document.getElementById('loginSection').style.display = 'block';
  document.getElementById('registerSection').style.display = 'none';
}

// Login
document.getElementById('loginForm').addEventListener('submit', function (e) {
  e.preventDefault();
  const loginEmail = document.getElementById('loginEmail').value;
  const loginPassword = document.getElementById('loginPassword').value;

  const user = users.find(u => u.email === loginEmail && u.password === loginPassword);
  if (user) {
    currentUser = user.email;
    showTaskPage();
  } else {
    alert('Invalid email or password');
  }
});

// Register
document.getElementById('registerForm').addEventListener('submit', function (e) {
  e.preventDefault();
  const registerEmail = document.getElementById('registerEmail').value;
  const registerPassword = document.getElementById('registerPassword').value;
  const confirmPassword = document.getElementById('confirmPassword').value;

  if (registerPassword !== confirmPassword) {
    alert('Passwords do not match');
    return;
  }

  const userExists = users.some(u => u.email === registerEmail);
  if (userExists) {
    alert('This email is already registered');
    return;
  }

  users.push({ email: registerEmail, password: registerPassword, tasks: [] });
  saveUsers();
  alert('Registration successful! You can now log in.');
  showLoginPage();
});

// Switch forms
document.getElementById('showRegisterButton').addEventListener('click', function () {
  document.getElementById('loginSection').style.display = 'none';
  document.getElementById('registerSection').style.display = 'block';
  document.getElementById('showRegisterButton').style.display = 'none';
  document.getElementById('showLoginButton').style.display = 'inline-block';
});

document.getElementById('showLoginButton').addEventListener('click', function () {
  showLoginPage();
  document.getElementById('showRegisterButton').style.display = 'inline-block';
  document.getElementById('showLoginButton').style.display = 'none';
});

// Task form toggle
document.getElementById('addTaskButton').addEventListener('click', function () {
  document.getElementById('taskForm').style.display = 'block';
});

// Save task
document.getElementById('saveTaskButton').addEventListener('click', function () {
  const taskInput = document.getElementById('taskInput');
  const taskText = taskInput.value.trim();
  if (!taskText) {
    alert('Please enter a task');
    return;
  }

  const now = new Date();
  const date = now.toLocaleDateString();
  const day = now.toLocaleDateString(undefined, { weekday: 'long' });

  const task = { text: taskText, date, day };

  const userIndex = users.findIndex(u => u.email === currentUser);
  if (userIndex !== -1) {
    users[userIndex].tasks.push(task);
    saveUsers();
  }

  addTaskToUI(task);
  taskInput.value = '';
  document.getElementById('taskForm').style.display = 'none';
});

// Display tasks on login
function showTaskPage() {
  document.getElementById('loginPage').style.display = 'none';
  document.getElementById('taskPage').style.display = 'block';

  const user = users.find(u => u.email === currentUser);
  const taskList = document.getElementById('taskList');
  taskList.innerHTML = '';

  if (user && user.tasks) {
    user.tasks.forEach(addTaskToUI);
  }
}

// Add task to UI
function addTaskToUI(task) {
  const li = document.createElement('li');
  li.innerHTML = `
    <strong>${task.text}</strong><br>
    <small>${task.day}, ${task.date}</small>
    <button onclick="deleteTask(this)">Delete</button>
  `;
  document.getElementById('taskList').appendChild(li);
}

// Delete task
function deleteTask(button) {
  const taskItem = button.parentElement;
  const text = taskItem.querySelector('strong').innerText;

  const userIndex = users.findIndex(u => u.email === currentUser);
  if (userIndex !== -1) {
    users[userIndex].tasks = users[userIndex].tasks.filter(t => t.text !== text);
    saveUsers();
  }

  taskItem.remove();
}
