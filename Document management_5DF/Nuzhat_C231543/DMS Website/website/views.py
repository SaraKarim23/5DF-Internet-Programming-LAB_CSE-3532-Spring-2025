from flask import Blueprint, render_template, request, flash, jsonify, redirect, url_for, send_from_directory
from flask_login import login_required, current_user
from werkzeug.security import generate_password_hash, check_password_hash
from .models import Note
from . import db
import json
import os
from werkzeug.utils import secure_filename

views = Blueprint('views', __name__)

UPLOAD_FOLDER = os.path.join(os.getcwd(), "uploads")

ALLOWED_EXTENSIONS = {"png", "jpg", "jpeg", "gif", "pdf", "doc", "docx"}

if not os.path.exists(UPLOAD_FOLDER):
    os.makedirs(UPLOAD_FOLDER)

def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

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

        if note and len(note) < 1:
            flash('Note is too short!', category='error')
        elif note:
            new_note = Note(data=note, user_id=current_user.id)
            db.session.add(new_note)
            db.session.commit()
            flash('Note added!', category='success')

    files = os.listdir(UPLOAD_FOLDER)
    
    # Add summary stats
    notes_count = len(current_user.notes)
    uploads_count = len(files)  # Since files are listed from the folder

    return render_template("home.html", user=current_user, files=files, 
                           notes_count=notes_count, uploads_count=uploads_count)

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

@views.route('/upload', methods=['POST'])
@login_required
def upload_file():
    if "file" not in request.files:
        flash("No file part", category='error')
        return redirect(url_for('views.home'))
    
    file = request.files["file"]
    if file.filename == "":
        flash("No selected file", category='error')
        return redirect(url_for('views.home'))
    
    if file and allowed_file(file.filename):
        filename = secure_filename(file.filename)
        filepath = os.path.join(UPLOAD_FOLDER, filename)
        file.save(filepath)
        flash("File uploaded successfully!", category='success')

    return redirect(url_for("views.home"))

@views.route('/upload-files', methods=['GET', 'POST'])
@login_required
def upload_files_page():
    if request.method == 'POST':
        if "file" not in request.files:
            flash("No file part", category='error')
            return redirect(request.url)
        
        file = request.files["file"]
        if file.filename == "":
            flash("No selected file", category='error')
            return redirect(request.url)
        
        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)
            filepath = os.path.join(UPLOAD_FOLDER, filename)
            file.save(filepath)
            flash("File uploaded successfully!", category='success')
    
    return render_template("upload_form.html", user=current_user)

@views.route('/uploads/<path:filename>')
@login_required
def uploaded_file(filename):
    return send_from_directory(UPLOAD_FOLDER, filename, as_attachment=False)

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
@views.route('/delete-file', methods=['POST'])
@login_required
def delete_file():
    data = json.loads(request.data)
    filename = data.get('filename')
    filepath = os.path.join(UPLOAD_FOLDER, filename)

    if os.path.exists(filepath):
        os.remove(filepath)
        return jsonify({"success": True})
    else:
        return jsonify({"success": False, "error": "File not found"}), 404
@views.route('/profile', methods=['GET', 'POST'])
@login_required
def profile():
    if request.method == 'POST':
        current_password = request.form.get('current_password')
        new_password = request.form.get('new_password')
        confirm_password = request.form.get('confirm_password')

        if not check_password_hash(current_user.password, current_password):
            flash("Current password is incorrect.", category="error")
        elif new_password != confirm_password:
            flash("New passwords do not match.", category="error")
        elif len(new_password) < 6:
            flash("New password must be at least 6 characters.", category="error")
        else:
            current_user.password = generate_password_hash(new_password, method='sha256')
            db.session.commit()
            flash("Password changed successfully!", category="success")

    return render_template("profile.html", user=current_user)
@views.route('/uploads')
@login_required
def uploads_page():
    files = os.listdir(UPLOAD_FOLDER)
    return render_template("uploads.html", user=current_user, files=files)

