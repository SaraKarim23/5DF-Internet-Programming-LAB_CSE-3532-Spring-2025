<<<<<<< HEAD
![Screenshot (238)](https://github.com/user-attachments/assets/363e7041-1833-4bc9-94d0-1b0ee13e2c50)
# Finance Dashboard with Predictive Analytics

A responsive React dashboard for monitoring Key Performance Indicators (KPIs), products, transactions, and expense breakdowns — complete with data visualization and revenue prediction using linear regression.

---

## 🔍 Features

- **Real-time Data Fetching** via Redux Toolkit Query from the following endpoints:
  - `/kpi/kpis/`
  - `/product/products/`
  - `/transaction/transactions/`
- **KPI Visualizations**
  - Area Chart: Monthly revenue vs. expenses
  - Line Chart: Revenue vs. profit (dual Y-axes)
  - Bar Chart: Month-by-month revenue
- **Tabular Views**
  - Products: Scrollable table listing ID, expense, and price
  - Transactions: Recent orders table with buyer and item count
- **Expense Breakdown**
  - Mini pie charts showing each category’s portion of total expenses
- **Revenue Predictions**
  - Linear regression to display trend line and forecast next year’s revenue
- **Responsive UI** with Tailwind CSS and shadcn-style components

---

## 🛠 Tech Stack

- **Frontend:** React, Vite, Tailwind CSS, shadcn/ui
- **State Management & Data Fetching:** Redux Toolkit Query (@reduxjs/toolkit/query)
- **Charts:** Recharts
- **Regression:** regression.js
- **Backend (Mock / Strapi):** Static controllers serving JSON at `http://localhost:1338`

---

## 🚀 Getting Started

1. **Clone the repo**
   ```bash
   git clone https://github.com/<your-username>/finance-dashboard.git
   cd finance-dashboard
   ```

2. **Install dependencies**
   ```bash
   cd client
   npm install
   npm install --save regression
   ```bash
   npm install
   ```

3. **Set Environment Variables**
   Create a `.env` file in the root:
   ```env
   VITE_BASE_URL=http://localhost:1338
   ```

4. **Start the Backend** 
   ```bash
   cd backend
   npm run dev
   ```

5. **Start the Frontend**
   ```bash
   npm run dev
   ```

6. **Open in Browser**
   Navigate to `http://localhost:5173` (Vite default) to view the dashboard.

---

## 📁 Project Structure

```
├── src/
│   ├── components/       # Reusable UI components (Card, Table, etc.)
│   ├── pages/            # Page layouts or grouped dashboard rows
│   ├── state/            # Redux Toolkit Query API slice
│   ├── App.jsx           # Main application entry
│   ├── index.jsx         # React DOM render
│   └── styles/           # Global and utility styles
├── .env                  # Environment variables
├── package.json          # Frontend dependencies & scripts
└── README.md             # Project overview and instructions
```

---

## 📐 API Endpoints & Data Format

### GET `/kpi/kpis/`
```json
[
  {
    "monthlyData": [
      { "month": "January",   "revenue": "$12,000", "expenses": "$5,000" },
      { "month": "February",  "revenue": "$10,000", "expenses": "$4,500" },
      …
    ],
    "totalExpenses": "$71,000",
    "expensesByCategory": {
      "salaries": "$38,000.00",
      "supplies": "$13,000.00",
      "services": "$10,000.00"
    }
  }
]
```

### GET `/product/products/`
```json
[
  { "_id": "63bf7ac9f03239e002001600", "price": "$43.41", "expense": "$5.97", … },
  …
]
```

### GET `/transaction/transactions/`
```json
[
  { "_id": "…", "buyer": "Alice", "amount": 120.50, "productIds": [ … ] },
  …
]
```

---

## 🔧 Available Scripts

- `npm run dev` — Start Vite development server
- `npm run build` — Build production bundle
- `npm run preview` — Preview production build locally

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -m "Add YourFeature"`)
4. Push to your branch (`git push origin feature/YourFeature`)
5. Open a Pull Request

Please follow the existing code style and include descriptive commit messages.

---

## 📜 License

This project is licensed under the MIT License. See [LICENSE](LICENSE) for details.

=======
# 5DF-Internet-Programming-LAB_CSE-3532-Spring-2025
📍 Project Origin This project is developed as part of the Tools and Technologies for Internet Programming course, for semester final work, under the Department of Computer Science and Engineering, International Islamic University Chittagong, Bangladesh.

# 🌐 Tools and Technologies for Internet Programming - Section 5DF 💻  
Welcome to the **Tools and Technologies for Internet Programming** course repository for **Section 5DF**! You'll submit your assignments, projects, and code related to modern WEB/APP development technologies in this repository.

> **From HTML to ReactJS – Build dynamic, responsive, and interactive web applications!** 🌐💡

---

## 📌 How to Use This Repository  

### 🏆 Step 1: Accept the GitHub Invitation  
- Check your email for an invite to this repository.  
- Click **"Accept"**, and you're officially part of the team! 🎉  

### 📂 Step 2: Create Your Project Folder  
- **Each team member** must create their folder for their project or individual assignment.  
- Name it in the following format:  
  ```bash
  ProjectName_SectionX
- Every student must include their student ID in their filenames for tracking.

### 🤝 Step 3: Ensure Everyone Contributes
- Every team member must commit their work themselves.
- Every student must include their student ID in their filenames for tracking.
- Use meaningful commit messages so we know who did what.
Example: 
  ```bash
  git commit -m "Initial HTML structure - Sara_C20...."

### 🚀 Step 4: Upload Your Work (Like a Pro)
- After completing your work:
  ```bash
  git add .
  git commit -m "Built homepage - Sara_C20...."
  git push origin main

### ⚠️ Repository Rules (a.k.a. The Internet Commandments)
- ✅ One folder per project – Keep it organized!
- ✅ Everyone must contribute – We track everything. No shortcuts!
- ✅ Follow best practices – Clean, structured code = Smooth functioning.
- ✅ No breaking the internet – Don't mess with others' work.
- ✅ If you break it, fix it – Or bring coffee for your team. ☕

🚀 Pro Tips for Success
- Commit often – No one likes losing their progress.
- Use GitHub Issues & Pull Requests to discuss changes with your team.
- If something breaks, don’t panic – Google, Stack Overflow, and I are here to help.

📢 Questions? Errors?
- Ask in class, message your team, or reach out to me.

### Instructor: Sara Karim
- 💡 "Code together, learn together, and let’s build something amazing!"
>>>>>>> 280790212824ddecd0face913facc41c93eb1c60
