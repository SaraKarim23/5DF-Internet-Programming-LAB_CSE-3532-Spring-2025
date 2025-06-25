// elements
const radioViewOptions = document.querySelectorAll("input[name='view-option']");
const listView = document.getElementById("list-view");
const boardView = document.getElementById("board-view");
const addTaskCTA = document.getElementById("add-task-cta");
const setTaskOverlay = document.getElementById("set-task-overlay");
const closeButtons = document.querySelectorAll(".close-button");
const statusSelect = document.getElementById("status-select");
const statusDropdown = document.getElementById("status-dropdown");
const viewTaskOverlay = document.getElementById("view-task-overlay");
const deleteTaskCTA = document.getElementById("delete-task-cta");
const notification = document.getElementById("notification");

// current active overlay
let activeOverlay = null;

// track currently viewed task (for delete)
let currentViewedTask = null;

// ========== Overlay show/hide ==========
function showOverlay(overlay) {
  overlay.classList.remove("hide");
  activeOverlay = overlay;
  document.body.classList.add("overflow-hidden");
}

function hideOverlay() {
  if (activeOverlay) {
    activeOverlay.classList.add("hide");
    activeOverlay = null;
    document.body.classList.remove("overflow-hidden");
  }
}

// ========== Toggle between list and board view ==========
radioViewOptions.forEach((radio) => {
  radio.addEventListener("change", (e) => {
    if (e.target.value === "list") {
      boardView.classList.add("hide");
      listView.classList.remove("hide");
    } else {
      listView.classList.add("hide");
      boardView.classList.remove("hide");
    }
  });
});

// ========== Open add task overlay ==========
addTaskCTA.addEventListener("click", () => {
  showOverlay(setTaskOverlay);
});

// ========== Close overlays ==========
closeButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    hideOverlay();
  });
});

// ========== Status dropdown toggle ==========
statusSelect.addEventListener("click", () => {
  statusDropdown.classList.toggle("hide");
});

// When status option changes, update the select label text
statusDropdown.querySelectorAll("input[name='status-option']").forEach((input) => {
  input.addEventListener("change", () => {
    statusSelect.querySelector("span").textContent = input.value;
    statusDropdown.classList.add("hide");
  });
});

// ========== Add Task Form ==========
const addTaskForm = setTaskOverlay.querySelector("form");

addTaskForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const name = addTaskForm.name.value.trim();
  const description = addTaskForm.description.value.trim();
  const day = addTaskForm["due-date-day"].value.trim();
  const month = addTaskForm["due-date-month"].value.trim();
  const year = addTaskForm["due-date-year"].value.trim();

  if (!name || !description || !day || !month || !year) {
    alert("Please fill all fields");
    return;
  }

  const dueDateStr = `${month} ${day}, ${year}`;

  // Get selected status
  const selectedStatusInput = statusDropdown.querySelector(
    "input[name='status-option']:checked"
  );
  const status = selectedStatusInput ? selectedStatusInput.value : "To do";

  // Create task element
  const li = document.createElement("li");
  li.className = "task-item";

  const btn = document.createElement("button");
  btn.className = "task-button";

  const pName = document.createElement("p");
  pName.className = "task-name";
  pName.textContent = name;

  const pDue = document.createElement("p");
  pDue.className = "task-due-date";
  pDue.textContent = `Due on ${dueDateStr}`;

  btn.appendChild(pName);
  btn.appendChild(pDue);

  // arrow icon
  const icon = document.createElement("iconify-icon");
  icon.setAttribute("icon", "material-symbols:arrow-back-ios-rounded");
  icon.style.color = "black";
  icon.width = 18;
  icon.height = 18;
  icon.className = "arrow-icon";

  btn.appendChild(icon);
  li.appendChild(btn);

  // Append to all lists (list and board)
  appendTaskToLists(li, name, description, dueDateStr, status);

  // Reset form and close overlay
  addTaskForm.reset();
  statusDropdown.classList.add("hide");
  statusSelect.querySelector("span").textContent = "To do"; // reset label
  hideOverlay();
});

// Function to append a task item to list and board views with click listener
function appendTaskToLists(taskLi, name, description, dueDateStr, status) {
  // Clone for board view since DOM nodes cannot exist in two places
  const boardClone = taskLi.cloneNode(true);

  // Append to list view container
  let listContainer = document.querySelector(`.list-container.${getStatusClass(status)} .tasks-list`);
  if (listContainer) listContainer.appendChild(taskLi);

  // Append to board view container
  let boardContainer = document.querySelector(`.tasks-list.${getStatusClass(status)}`);
  if (boardContainer) boardContainer.appendChild(boardClone);

  // Add click listener to both (list and board)
  [taskLi, boardClone].forEach((el) => {
    el.addEventListener("click", () => {
      currentViewedTask = el;
      fillViewTaskOverlay(name, description, dueDateStr, status);
      showOverlay(viewTaskOverlay);
    });
  });
}

// Helper to get CSS class name based on status
function getStatusClass(status) {
  if (status === "Doing") return "blue";
  if (status === "Done") return "green";
  return "pink"; // To do or default
}

// ========== Setup initial click listeners for existing tasks ==========
function setupTaskClickListeners() {
  const tasks = document.querySelectorAll(".task-item");
  tasks.forEach((task) => {
    task.onclick = null; // remove old handlers if any
    task.addEventListener("click", () => {
      currentViewedTask = task;

      const taskButton = task.querySelector(".task-button");
      const name = taskButton.querySelector(".task-name")?.textContent || "No name";
      const dueDate = taskButton.querySelector(".task-due-date")?.textContent || "No due date";

      // Because description is not stored in DOM for pre-existing tasks, show placeholder
      fillViewTaskOverlay(name, "Description not available", dueDate, getStatusFromTask(task));
      showOverlay(viewTaskOverlay);
    });
  });
}

// Infer status from the parent container
function getStatusFromTask(task) {
  if (task.closest(".list-container.pink")) return "To do";
  if (task.closest(".list-container.blue")) return "Doing";
  if (task.closest(".list-container.green")) return "Done";
  return "To do";
}

// ========== Fill view task overlay ==========
function fillViewTaskOverlay(name, description, dueDateStr, status) {
  const nameEl = viewTaskOverlay.querySelector("h1.header.no-margin + p.value");
  const descEl = viewTaskOverlay.querySelector("h1.header + p.value");
  const dueDateEl = viewTaskOverlay.querySelector("div.flex.items-center p.value");
  const statusEl = viewTaskOverlay.querySelector("p.value.status-value span:last-child");
  const circleEl = viewTaskOverlay.querySelector("p.value.status-value span.circle");

  nameEl.textContent = name;
  descEl.textContent = description;
  dueDateEl.textContent = dueDateStr;
  statusEl.textContent = status;

  // Reset circle classes and set background color
  circleEl.className = "circle";
  if (status === "Doing") circleEl.classList.add("blue-background");
  else if (status === "Done") circleEl.classList.add("green-background");
  else circleEl.classList.add("pink-background");
}

// ========== Delete task ==========
deleteTaskCTA.addEventListener("click", () => {
  if (!currentViewedTask) return;

  // Remove from DOM both list and board copies
  // The clicked overlay task relates to one DOM task-item (either list or board)
  // To delete the other copy, find its sibling

  // Find task name from current viewed task
  const taskName = currentViewedTask.querySelector(".task-name")?.textContent;

  // Remove both tasks from list and board views by matching task name
  const allTasks = document.querySelectorAll(".task-item");
  allTasks.forEach((task) => {
    const name = task.querySelector(".task-name")?.textContent;
    if (name === taskName) {
      task.remove();
    }
  });

  // Hide overlay and clear currentViewedTask
  hideOverlay();
  currentViewedTask = null;

  // Show notification
  showNotification("The task was deleted");
});

// ========== Notification function ==========
function showNotification(text) {
  notification.querySelector("p").textContent = text;
  notification.classList.add("show");

  setTimeout(() => {
    notification.classList.remove("show");
  }, 3000);
}

// ========== Initial setup ==========
setupTaskClickListeners();
// Wait for the page to load
document.addEventListener("DOMContentLoaded", () => {
    // Find the sign out button
    const signOutBtn = document.querySelector(".sign-out-cta");
  
    // If the button exists, add click event listener
    if (signOutBtn) {
      signOutBtn.addEventListener("click", () => {
        // Redirect to login page when clicked
        window.location.href = "login.html";  // Change path if needed
      });
    }
  });
  