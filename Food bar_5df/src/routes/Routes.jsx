import { createBrowserRouter } from "react-router-dom";
import Root from "../layout/Root";
import Home from "../Pages/Home";
import Login from "../Pages/Login";
import Register from "../Pages/Register";
import AddFood from "../Pages/AddFood";
import PrivateRoutes from "./PrivateRoutes";
import FoodDetails from "../Pages/FoodDetails";
import ManageMyFood from "../Pages/ManageMyFood";
import UpdateFood from "../Pages/UpdateFood";
import FoodReq from "../Pages/FoodReq";
import ErrorPage from "../Pages/ErrorPage";



const router = createBrowserRouter([
  {
    path: "/",
    element: <Root></Root>,
    errorElement:<ErrorPage></ErrorPage>,
    children: [
      {
        path: "/",
        element: <Home></Home>,
      },
      {
        path: "/login",
        element: <Login></Login>,
      },
      {
        path: "/register",
        element: <Register></Register>,
      },
      {
        path: "/add-food",
        element:<PrivateRoutes><AddFood></AddFood></PrivateRoutes>
      },
      {
        path: "/food/:id",
        element:<PrivateRoutes><FoodDetails></FoodDetails></PrivateRoutes>,
      },
      {
        path: "/update/:id",
        element:<PrivateRoutes><UpdateFood></UpdateFood></PrivateRoutes>,
      },
      {
        path: "/manage-myFood",
        element:<PrivateRoutes><ManageMyFood></ManageMyFood></PrivateRoutes>
      },
      {
        path: "/myFood-req",
        element:<PrivateRoutes><FoodReq></FoodReq></PrivateRoutes>
      },
    ],
  },
]);

export default router;
