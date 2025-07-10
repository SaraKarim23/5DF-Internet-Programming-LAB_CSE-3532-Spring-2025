from app import db, User  # adjust `app` if your main file has a different name
from getpass import getpass

def create_admin():
    print("🔐 Admin Account Creation")
    username = input("👤 Enter admin username: ")
    email = input("📧 Enter admin email: ")
    password = getpass("🔑 Enter admin password (hidden): ")
    confirm = getpass("🔁 Confirm password: ")

    if password != confirm:
        print("❌ Passwords do not match. Try again.")
        return

    existing = User.query.filter_by(username=username).first()
    if existing:
        print(f"⚠️ Username '{username}' already exists.")
        return

    admin = User(username=username, password=password, is_admin=True)
    setattr(admin, 'email', email)  # if email column exists
    db.session.add(admin)
    db.session.commit()

    print(f"✅ Admin '{username}' created successfully!")

if __name__ == '__main__':
    create_admin()
