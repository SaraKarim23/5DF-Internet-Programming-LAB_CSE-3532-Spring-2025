import { useState } from "react";
import { Link } from "react-router-dom";
import { BarChart3, Menu } from "lucide-react";

const Navbar = () => {
  const [selected, setSelected] = useState("dashboard");
  const [isOpen, setIsOpen] = useState(false);

  return (
    <nav className="flex justify-between items-center mx-4 p-4 text-gray-300">
      {/* LEFT SIDE */}
      <div className="flex items-center gap-3">
        <BarChart3 className="w-7 h-7" />
        <span className="text-lg font-semibold">Finanseer</span>
      </div>

      {/* HAMBURGER MENU (MOBILE) */}
      <button
        className="md:hidden block text-gray-300"
        onClick={() => setIsOpen(!isOpen)}
      >
        <Menu className="w-6 h-6" />
      </button>

      {/* RIGHT SIDE (MENU) */}
      <div
        className={`md:flex gap-8 ${isOpen ? "flex flex-col absolute top-16 left-0 w-full bg-zinc-700 p-4 rounded-sm z-20" : "hidden"} md:static md:w-auto md:p-0`}
      >
        <div className="hover:text-primary">
          <Link
            to="/"
            onClick={() => {
              setSelected("dashboard");
              setIsOpen(false);
            }}
            className={`${
              selected === "dashboard" ? "text-gray-100" : "text-gray-500"
            } no-underline`}
          >
            Dashboard
          </Link>
        </div>
        <div className="hover:text-primary">
          <Link
            to="/predictions"
            onClick={() => {
              setSelected("predictions");
              setIsOpen(false);
            }}
            className={`${
              selected === "predictions" ? "text-gray-100" : "text-gray-500"
            } no-underline`}
          >
            Predictions
          </Link>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
