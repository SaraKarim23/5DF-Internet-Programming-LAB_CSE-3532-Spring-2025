import { Navigate, useLocation } from "react-router-dom";
import useAuth from "../hook/useAuth";
import ai from '../assets/images/Animation - 1715709373669.json'
import Lottie from "lottie-react";

const PrivateRoutes = ({children}) => {
    const {user,loading}=useAuth()
    const location=useLocation()

    if(loading){
        return <Lottie className="mx-auto w-[500px] h-[500px]" animationData={ai}></Lottie>
    }
    if(user){
        return children;
    }
    return (
        <div>
            <Navigate to={'/login'} state={location.pathname} replace={true}></Navigate>
        </div>
    );
};

export default PrivateRoutes;