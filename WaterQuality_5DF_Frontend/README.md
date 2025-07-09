
![wq1](https://github.com/user-attachments/assets/cb023415-ac4a-4284-be11-5bc2a5ea12bd)
![wq2](https://github.com/user-attachments/assets/897d0e64-2ba9-4a4e-8b48-017bd29a3202)

# Finance Dashboard with Predictive Analytics

A responsive React dashboard for monitoring the water quality. This Project is done by C223201,C223220,C231524 

---



## 🛠 Tech Stack

- **Frontend:** React, Vite, Tailwind CSS, shadcn/ui
- **State Management & Data Fetching:** Redux Toolkit Query (@reduxjs/toolkit/query)
- **Charts:** Recharts
- **Regression:** regression.js
- **Backend:** Static controllers serving JSON at `http://localhost:1338`

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
