const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('./db.sqlite');

db.serialize(() => {
  // Drop existing tables
  db.run("DROP TABLE IF EXISTS users");
  db.run("DROP TABLE IF EXISTS courses");
  db.run("DROP TABLE IF EXISTS purchases");

  // Create users table
  db.run(`CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT UNIQUE,
    password TEXT
  )`);

  // Create courses table
  db.run(`CREATE TABLE courses (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    description TEXT,
    pdf TEXT
  )`);

  // Create purchases table
  db.run(`CREATE TABLE purchases (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    course_id INTEGER
  )`);

  // Insert sample courses
  const courses = [
    ["HTML Basics", "Learn HTML from scratch", "html.pdf"],
    ["CSS Advanced", "Master advanced CSS", "css.pdf"],
    ["JavaScript Fun", "JS for beginners", "js.pdf"]
  ];

  const stmt = db.prepare("INSERT INTO courses (title, description, pdf) VALUES (?, ?, ?)");
  for (const [title, desc, pdf] of courses) {
    stmt.run(title, desc, pdf);
  }
  stmt.finalize();

  console.log("✅ Database setup complete.");
});

db.close();