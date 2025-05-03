import {  useEffect, useState } from "react";
import { Link, NavLink } from "react-router-dom";
import useAuth from "../hook/useAuth";
import { Tooltip } from "react-tooltip";


const Navbar = () => {
  const [theme, setTheme] = useState(["light"]);
  const {user,logOut}=useAuth()

  const handleToggle = (e) => {
    if (e.target.checked) {
      setTheme("synthwave");
    } else {
      setTheme("light");
    }
  };

  useEffect(() => {
    localStorage.setItem("theme", theme);
    const localTheme = localStorage.getItem("theme");
    document.querySelector("html").setAttribute("data-theme", localTheme);
  }, [theme]);

  const navLinks = (
    <>
      <li>
        <NavLink to={`/`}>Home</NavLink>
      </li>
      {
        user && <>
          <li>
            <NavLink to={`/add-food`}>Add Food</NavLink>
          </li>
          <li>
            <NavLink to={`/manage-myFood`}>Manage MyFood</NavLink>
         </li>
          <li>
            <NavLink to={`/myFood-req`}>MyFood Req</NavLink>
          </li>
        </>}
      <li>
        <NavLink to={`/login`}>Login</NavLink>
      </li>
    </>
  );

  return (
    <div className="navbar p-0 bg-base-100">
      <div className="navbar-start">
        <div className="dropdown">
          <div tabIndex={0} role="button" className="btn btn-ghost lg:hidden">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              className="h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="2"
                d="M4 6h16M4 12h8m-8 6h16"
              />
            </svg>
          </div>
          <ul
            tabIndex={0}
            className="menu menu-sm dropdown-content mt-3 z-10 p-2 shadow bg-base-100 rounded-box w-52"
          >
            {navLinks}
          </ul>
        </div>
         <Link to={`/`} className="text-2xl font-semibold">
          Yum<span className="text-red-400">Hub</span>
        </Link>
      </div>
      <div className="navbar-center hidden lg:flex">
        <ul className="menu menu-horizontal px-1">{navLinks}</ul>
      </div>
      <div className="navbar-end flex gap-3">
        <div>
          <label className="cursor-pointer grid place-items-center">
            <input
              onChange={handleToggle}
              type="checkbox"
              className="toggle theme-controller bg-base-content row-start-1 col-start-1 col-span-2"
            />
            <svg
              className="col-start-1 row-start-1 stroke-base-100 fill-base-100"
              xmlns="http://www.w3.org/2000/svg"
              width="14"
              height="14"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2"
              strokeLinecap="round"
              strokeLinejoin="round"
            >
              <circle cx="12" cy="12" r="5" />
              <path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
            </svg>
            <svg
              className="col-start-2 row-start-1 stroke-base-100 fill-base-100"
              xmlns="http://www.w3.org/2000/svg"
              width="14"
              height="14"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2"
              strokeLinecap="round"
              strokeLinejoin="round"
            >
              <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
          </label>
        </div>
        <div>
          {user ? (
            <div className="flex items-center gap-2 md:gap-5">
              <a id="clickable">
                <div className="avatar">
                  <div className="w-10 rounded-full">
                    <img
                      src={
                        user?.photoURL ||
                        "https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"
                      }
                    />
                  </div>
                </div>
              </a>
              <Tooltip className="z-10" anchorSelect="#clickable" clickable>
                <h2 className="font-semibold text-center">{user.displayName}</h2> <br />
                <button className="btn btn-sm text-white bg-red-500 w-full" onClick={logOut}>SignOut</button>
              </Tooltip>
            </div>
          ) : (
            <Link to={`/login`}>
              <button className="btn text-white bg-red-500">Login</button>
            </Link>
          )}
        </div>
      </div>
    </div>
  );
};

export default Navbar;
