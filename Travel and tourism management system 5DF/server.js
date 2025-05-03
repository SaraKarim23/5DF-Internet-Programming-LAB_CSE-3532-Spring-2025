const express = require("express");
const mysql = require("mysql");
const cors = require("cors");

const app = express();
app.use(cors());

const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "12345678",
    database: "travelmanagementsystem"
});

db.connect(err => {
    if (err) {
        console.error("Database connection failed: " + err.stack);
        return;
    }
    console.log("Connected to MySQL database.");
});

app.get("/data", (req, res) => {
    db.query("SELECT * FROM appointments", (err, result) => {
        if (err) throw err;
        res.json(result);
    });
});

app.listen(3306, () => {
    console.log("Server running on http://localhost:3306");
});
