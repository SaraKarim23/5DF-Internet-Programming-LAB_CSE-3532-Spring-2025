from flask import Flask, render_template, request, redirect, session, flash, url_for
from flask_sqlalchemy import SQLAlchemy
from datetime import datetime
from collections import defaultdict

app = Flask(__name__)
app.config['SECRET_KEY'] = 'your_secret_key_here'
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///mood_journal.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)

# Models

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    password = db.Column(db.String(200), nullable=False)
    is_admin = db.Column(db.Boolean, default=False)

@app.route('/admin/user/add', methods=['GET', 'POST'])
def add_user():
    if not session.get('is_admin'):
        flash('Admin access required.')
        return redirect(url_for('dashboard'))

    if request.method == 'POST':
        username = request.form['username']
        email = request.form['email']
        password = request.form['password']
        is_admin = 'is_admin' in request.form

        if User.query.filter((User.username == username) | (User.email == email)).first():
            flash('Username or Email already exists.')
        else:
            new_user = User(username=username, email=email, password=password, is_admin=is_admin)
            db.session.add(new_user)
            db.session.commit()
            flash('New user added!')
            return redirect(url_for('admin_panel'))

    return render_template('admin_add_user.html')

@app.route('/admin/user/edit/<int:user_id>', methods=['GET', 'POST'])
def edit_user(user_id):
    if not session.get('is_admin'):
        flash('Admin access required.')
        return redirect(url_for('dashboard'))

    user = User.query.get_or_404(user_id)

    if request.method == 'POST':
        user.username = request.form['username']
        user.email = request.form['email']
        user.is_admin = 'is_admin' in request.form
        db.session.commit()
        flash('User updated!')
        return redirect(url_for('admin_panel'))

    return render_template('admin_edit_user.html', user=user)

@app.route('/admin/user/delete/<int:user_id>')
def delete_user(user_id):
    if not session.get('is_admin'):
        flash('Admin access required.')
        return redirect(url_for('dashboard'))

    user = User.query.get_or_404(user_id)
    db.session.delete(user)
    db.session.commit()
    flash('User deleted!')
    return redirect(url_for('admin_panel'))



class Mood(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    mood_type = db.Column(db.String(50), nullable=False)
    message = db.Column(db.Text, nullable=True)
    is_public = db.Column(db.Boolean, default=False)
    timestamp = db.Column(db.DateTime, default=datetime.utcnow)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)
    user = db.relationship('User', backref='moods')

class AnonymousMessage(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    content = db.Column(db.Text, nullable=False)
    timestamp = db.Column(db.DateTime, default=datetime.utcnow)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)
    user = db.relationship('User', backref='anonymous_messages')

# Reply model moved out as standalone
class Reply(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    reply_text = db.Column(db.Text, nullable=False)
    mood_type = db.Column(db.String(50), nullable=False)  # user feeling for reply
    timestamp = db.Column(db.DateTime, default=datetime.utcnow)
    anonymous_message_id = db.Column(db.Integer, db.ForeignKey('anonymous_message.id'), nullable=False)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)

    anonymous_message = db.relationship('AnonymousMessage', backref='replies')
    user = db.relationship('User')

# Helper: Get current logged-in user
def get_current_user():
    user_id = session.get('user_id')
    if not user_id:
        return None
    return User.query.get(user_id)

# Routes

@app.route('/')
def index():
    if get_current_user():
        return redirect(url_for('dashboard'))
    return redirect(url_for('login'))

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        user = User.query.filter_by(username=username, password=password).first()
        if user:
            session['user_id'] = user.id
            session['username'] = user.username
            session['is_admin'] = user.is_admin
            return redirect(url_for('dashboard'))
        else:
            flash('Invalid username or password')
    return render_template('login.html')

@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['username']
        email = request.form['email']  # ← NEW
        password = request.form['password']

        existing_user = User.query.filter((User.username == username) | (User.email == email)).first()
        if existing_user:
            flash('Username or Email already exists')
        else:
            new_user = User(username=username, email=email, password=password)  # ← UPDATED
            db.session.add(new_user)
            db.session.commit()
            flash('Registration successful! Please log in.')
            return redirect(url_for('login'))
    return render_template('register.html')

@app.route('/logout')
def logout():
    session.clear()
    return redirect(url_for('login'))

@app.route('/dashboard')
def dashboard():
    user = get_current_user()
    if not user:
        flash("Please log in to access the dashboard.")
        return redirect(url_for('login'))

    moods = Mood.query.filter_by(user_id=user.id).order_by(Mood.timestamp.desc()).all()
    moods_by_date = defaultdict(list)
    for mood in moods:
        date_str = mood.timestamp.strftime('%Y-%m-%d')
        moods_by_date[date_str].append({
            'mood_type': mood.mood_type,
            'message': mood.message,
            'time': mood.timestamp.strftime('%H:%M')
        })

    mood_options = ["Sad", "Happy", "Angry", "Motivated", "Depressed", "Romantic", "Heart Broken"]

    return render_template('dashboard.html', user=user, moods_by_date=dict(moods_by_date), mood_options=mood_options)

@app.route('/moods', methods=['GET', 'POST'])
def mood():
    user = get_current_user()
    if not user:
        flash("Please log in to add moods.")
        return redirect(url_for('login'))

    mood_options = ["Sad", "Happy", "Angry", "Motivated", "Depressed", "Romantic", "Heart Broken"]

    if request.method == 'POST':
        mood_type = request.form.get('mood_type')
        message = request.form.get('message')
        is_public = bool(request.form.get('is_public'))

        if mood_type:
            new_mood = Mood(mood_type=mood_type, message=message, is_public=is_public, user_id=user.id)
            db.session.add(new_mood)
            db.session.commit()
            flash('Mood recorded successfully!')
            return redirect(url_for('mood'))
        else:
            flash('Please select a mood.')

    moods = Mood.query.filter_by(user_id=user.id).order_by(Mood.timestamp.desc()).all()
    return render_template('moods.html', user=user, moods=moods, mood_options=mood_options)

@app.route('/anonymous_messages', methods=['GET', 'POST'])
def anonymous_messages():
    user = get_current_user()
    if not user:
        flash("Please log in to view anonymous messages.")
        return redirect(url_for('login'))

    if request.method == 'POST':
        content = request.form.get('content')
        user_id = request.form.get('user_id')
        if content and user_id:
            new_msg = AnonymousMessage(content=content, user_id=int(user_id))
            db.session.add(new_msg)
            db.session.commit()
            flash('Anonymous message sent!')
            return redirect(url_for('anonymous_messages'))
        else:
            flash('Please enter a message and select a user.')

    users = User.query.all()
    messages = AnonymousMessage.query.filter_by(user_id=user.id).order_by(AnonymousMessage.timestamp.desc()).all()
    return render_template('anonymous_messages.html', users=users, messages=messages, user=user)

@app.route('/public')
def public_feed():
    user = get_current_user()  # ✅ This retrieves the logged-in user

    moods = Mood.query.filter_by(is_public=True).all()
    replies = Reply.query.all()

    feed_items = []

    for m in moods:
        feed_items.append({
            'type': 'mood',
            'timestamp': m.timestamp,
            'mood_type': m.mood_type,
            'message': m.message,
            'user': m.user  # Needed for {{ item.user.username }}
        })

    for r in replies:
        feed_items.append({
            'type': 'reply',
            'timestamp': r.timestamp,
            'mood_type': r.mood_type,
            'reply_text': r.reply_text,
            'anonymous_message': r.anonymous_message.content,
            'user': r.user  # Needed for {{ item.user.username }}
        })

    feed_items.sort(key=lambda x: x['timestamp'], reverse=True)

    return render_template('public.html', feed_items=feed_items, user=user)  # ✅ pass `user`


@app.route('/admin')
def admin_panel():
    user = get_current_user()
    if not user or not user.is_admin:
        flash('Admin access required.')
        return redirect(url_for('login'))

    users = User.query.all()
    return render_template('admin.html', users=users)

@app.route('/anonymous_messages/send/<int:user_id>', methods=['GET', 'POST'])
def anonymous_messages_send(user_id):
    if request.method == 'POST':
        content = request.form.get('content')
        if content:
            new_msg = AnonymousMessage(content=content, user_id=user_id)
            db.session.add(new_msg)
            db.session.commit()
            flash('Anonymous message sent!')
            return redirect(url_for('anonymous_messages'))
        else:
            flash('Please enter a message.')

    user = User.query.get(user_id)
    if not user:
        flash('User not found.')
        return redirect(url_for('dashboard'))

    return render_template('send_anonymous_message.html', user=user)

@app.route('/sendmsg/<int:user_id>', methods=['GET', 'POST'])
def sendmsg(user_id):
    user = User.query.get(user_id)
    if not user:
        flash("User not found.")
        return redirect(url_for('index'))

    if request.method == 'POST':
        content = request.form.get('content')
        if content:
            new_msg = AnonymousMessage(content=content, user_id=user.id)
            db.session.add(new_msg)
            db.session.commit()
            flash('Your anonymous message has been sent!')
            return redirect(url_for('index'))
        else:
            flash('Please enter a message before sending.')

    return render_template('sendmsg.html', user=user)

# Renamed function to avoid conflict with /public route
@app.route('/feed/<int:user_id>')
def user_public_feed(user_id):
    user = User.query.get_or_404(user_id)

    # Public moods by user
    public_moods = Mood.query.filter_by(user_id=user.id, is_public=True).all()

    # Public replies by user (all replies considered public here)
    public_replies = Reply.query.filter_by(user_id=user.id).all()

    feed_items = []

    for mood in public_moods:
        feed_items.append({
            'type': 'mood',
            'timestamp': mood.timestamp,
            'mood_type': mood.mood_type,
            'message': mood.message,
        })

    for reply in public_replies:
        feed_items.append({
            'type': 'reply',
            'timestamp': reply.timestamp,
            'mood_type': reply.mood_type,
            'reply_text': reply.reply_text,
            'anonymous_message': reply.anonymous_message.content,
        })

    # Sort descending by timestamp
    feed_items.sort(key=lambda x: x['timestamp'], reverse=True)

    return render_template('public_feed.html', user=user, feed_items=feed_items)

@app.route('/reply/<int:msg_id>', methods=['GET', 'POST'])
def reply(msg_id):
    user = get_current_user()
    if not user:
        flash('Login required to reply.')
        return redirect(url_for('login'))

    msg = AnonymousMessage.query.get_or_404(msg_id)
    mood_options = ["Sad", "Happy", "Angry", "Motivated", "Depressed", "Romantic", "Heart Broken"]

    if request.method == 'POST':
        mood_type = request.form.get('mood_type')
        reply_text = request.form.get('reply_text')

        if not mood_type or not reply_text:
            flash('Please select a mood and write your reply.')
            return redirect(url_for('reply', msg_id=msg_id))

        new_reply = Reply(
            reply_text=reply_text,
            mood_type=mood_type,
            anonymous_message_id=msg.id,
            user_id=user.id
        )
        db.session.add(new_reply)
        db.session.commit()
        flash('Reply posted publicly!')
        return redirect(url_for('user_public_feed', user_id=user.id))

    return render_template('reply_form.html', message=msg, mood_options=mood_options)

if __name__ == '__main__':
    db.create_all()
    app.run(debug=True)
