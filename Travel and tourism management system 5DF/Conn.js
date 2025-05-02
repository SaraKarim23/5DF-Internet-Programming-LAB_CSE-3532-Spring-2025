const express = require("express");
const cors = require("cors");

const app = express();
const PORT = 3306;

app.use(cors()); // Allows frontend to access the backend

// Sample travel management data
app.get("/data", (req, res) => {
    const travelData = [
        { id: 1, destination: "Paris", price: 1200, date: "2025-04-15" },
        { id: 2, destination: "New York", price: 900, date: "2025-05-20" },
        { id: 3, destination: "Tokyo", price: 1500, date: "2025-06-10" }
    ];
    res.json(travelData);
});

app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
