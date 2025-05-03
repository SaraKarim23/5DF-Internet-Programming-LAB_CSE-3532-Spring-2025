function deleteNote(noteId) {
    fetch("/delete-note", {
      method: "POST",
      body: JSON.stringify({ noteId: noteId }),
    }).then((_res) => {
      window.location.href = "/";
    });
  }
  function editNote(noteId) {
    var noteElement = document.getElementById("note-" + noteId);
    var noteText = noteElement.querySelector(".note-text").innerText;

    var newNote = prompt("Edit your note:", noteText);
    if (newNote === null || newNote.trim() === "") {
        return; // Cancelled or empty
    }

    fetch("/edit-note", {
        method: "POST",
        body: JSON.stringify({ noteId: noteId, newData: newNote }),
        headers: {
          "Content-Type": "application/json"
        }
    }).then((_res) => {
        window.location.reload(); // Refresh the page to see updated note
    });
}
