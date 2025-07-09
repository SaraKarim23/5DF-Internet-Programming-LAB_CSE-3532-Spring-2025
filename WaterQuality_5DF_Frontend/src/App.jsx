import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Navbar from "./scenes/Navbar";
import Dashboard from "./scenes/dashboard/Dashboard";
import Predictions from "./scenes/Predictions";

const App = () => {
  return (
    <div>
      <BrowserRouter>
      <Navbar/>
        <Routes>
          <Route path="/" element={<Dashboard />} />
          <Route path="/predictions" element={<Predictions/>}/>
        </Routes>
      </BrowserRouter>
    </div>
  );
};

export default App;
