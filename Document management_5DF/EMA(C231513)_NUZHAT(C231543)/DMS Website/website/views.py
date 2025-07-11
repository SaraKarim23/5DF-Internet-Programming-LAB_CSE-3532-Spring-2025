from flask import Blueprint, render_template, request, flash, jsonify, redirect, url_for, send_from_directory
from flask_login import login_required, current_user
from werkzeug.security import generate_password_hash, check_password_hash
from .models import Note
from . import db
import json
import os
from werkzeug.utils import secure_filename

views = Blueprint('views', __name__)

BASE_UPLOAD_FOLDER = os.path.join(os.getcwd(), "uploads")
DOC_FOLDER = os.path.join(BASE_UPLOAD_FOLDER, "documents")
IMG_FOLDER = os.path.join(BASE_UPLOAD_FOLDER, "images")
AUDIO_FOLDER = os.path.join(BASE_UPLOAD_FOLDER, "audio")
VIDEO_FOLDER = os.path.join(BASE_UPLOAD_FOLDER, "videos")

CATEGORY_FOLDERS = {
    "documents": DOC_FOLDER,
    "images": IMG_FOLDER,
    "audio": AUDIO_FOLDER,
    "videos": VIDEO_FOLDER,
}

ALLOWED_IMAGE_EXTENSIONS = {"png", "jpg", "jpeg", "gif"}

ALLOWED_EXTENSIONS = {
    "documents": {"pdf", "doc", "docx"},
    "images": {"png", "jpg", "jpeg", "gif"},
    "audio": {"mp3", "wav"},
    "videos": {"mp4", "webm"}
}

# Create folders if they don't exist
for folder in CATEGORY_FOLDERS.values():
    os.makedirs(folder, exist_ok=True)

def allowed_file(filename, category):
    return '.' in filename and \
           filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS.get(category, set())
def allowed_image(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_IMAGE_EXTENSIONS
@views.route('/notes')
@login_required
def all_notes():
    return render_template("notes.html", user=current_user)

@views.route('/add-note', methods=['GET', 'POST'])
@login_required
def add_note_page():
    if request.method == 'POST':
        note = request.form.get('note')
        if note and len(note) < 1:
            flash('Note is too short!', category='error')
        elif note:
            new_note = Note(data=note, user_id=current_user.id)
            db.session.add(new_note)
            db.session.commit()
            flash('Note added successfully!', category='success')
    return render_template("add_note.html", user=current_user)

@views.route('/', methods=['GET', 'POST'])
@login_required
def home():
    if request.method == 'POST':
        note = request.form.get('note')
        if note and len(note) > 0:
            new_note = Note(data=note, user_id=current_user.id)
            db.session.add(new_note)
            db.session.commit()
            flash('Note added!', category='success')

    stats = {
        'documents': len(os.listdir(DOC_FOLDER)),
        'images': len(os.listdir(IMG_FOLDER)),
        'audio': len(os.listdir(AUDIO_FOLDER)),
        'videos': len(os.listdir(VIDEO_FOLDER)),
    }

    total_uploads = sum(stats.values())
    notes_count = len(current_user.notes)

    return render_template("home.html", user=current_user,
                           stats=stats,
                           notes_count=notes_count,
                           uploads_count=total_uploads)


@views.route('/delete-note', methods=['POST'])
@login_required
def delete_note():  
    note = json.loads(request.data)
    noteId = note.get('noteId')
    note = Note.query.get(noteId)
    if note and note.user_id == current_user.id:
        db.session.delete(note)
        db.session.commit()
    return jsonify({})

@views.route('/upload/<category>', methods=['GET', 'POST'])
@login_required
def upload_category(category):
    if category not in CATEGORY_FOLDERS:
        flash("Invalid category", category='error')
        return redirect(url_for('views.home'))

    folder = CATEGORY_FOLDERS[category]
    files = os.listdir(folder)

    if request.method == 'POST':
        if "file" not in request.files:
            flash("No file part", category='error')
            return redirect(request.url)

        file = request.files["file"]
        if file.filename == "":
            flash("No selected file", category='error')
            return redirect(request.url)

        if file and allowed_file(file.filename, category):
            filename = secure_filename(file.filename)
            filepath = os.path.join(folder, filename)
            file.save(filepath)
            flash("File uploaded successfully!", category='success')
            return redirect(url_for('views.upload_category', category=category))
        else:
            flash("Invalid file type", category='error')

    return render_template(f"upload_{category}.html", user=current_user, files=files)

@views.route('/uploads/<category>/<path:filename>')
@login_required
def uploaded_file(category, filename):
    folder = CATEGORY_FOLDERS.get(category)
    if folder:
        return send_from_directory(folder, filename, as_attachment=False)
    return "Invalid category", 404

@views.route('/delete-file/<category>', methods=['POST'])
@login_required
def delete_file(category):
    data = json.loads(request.data)
    filename = data.get('filename')
    folder = CATEGORY_FOLDERS.get(category)

    if not folder:
        return jsonify({"success": False, "error": "Invalid category"}), 400

    filepath = os.path.join(folder, filename)
    if os.path.exists(filepath):
        os.remove(filepath)
        return jsonify({"success": True})
    else:
        return jsonify({"success": False, "error": "File not found"}), 404

@views.route('/edit-note', methods=['POST'])
@login_required
def edit_note():
    data = json.loads(request.data)
    noteId = data.get('noteId')
    newData = data.get('newData')

    note = Note.query.get(noteId)
    if note and note.user_id == current_user.id:
        note.data = newData
        db.session.commit()
        return jsonify({"success": True})

    return jsonify({"success": False}), 400

@views.route('/profile', methods=['GET', 'POST'])
@login_required
def profile():
    if request.method == 'POST':
        # Name update
        new_name = request.form.get('name')
        if new_name:
            current_user.name = new_name.strip()

        # Profile picture upload
        if "profile_pic" in request.files:
            file = request.files["profile_pic"]
            if file and allowed_image(file.filename):
                filename = secure_filename(file.filename)
                filepath = os.path.join("website", "static", "profile_pics", filename)
                file.save(filepath)
                current_user.profile_picture = filename
            elif file.filename != "":
                flash("Invalid file type for profile picture.", category="error")

        db.session.commit()
        flash("Profile updated successfully!", category="success")
        return redirect(url_for('views.profile'))

    return render_template("profile.html", user=current_user)

@views.route('/uploads-summary')
@login_required
def uploads_summary():
    summary = {
        category: len(os.listdir(folder))
        for category, folder in CATEGORY_FOLDERS.items()
    }
    return render_template("uploads_summary.html", user=current_user, summary=summary)
@views.route('/uploads')
@login_required
def uploads_page():
    files_by_category = {
        category: os.listdir(folder)
        for category, folder in CATEGORY_FOLDERS.items()
    }
    return render_template("uploads_summary.html", user=current_user, files_by_category=files_by_category)

