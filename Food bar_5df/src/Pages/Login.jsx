import { useState } from "react";
import { AiFillEye, AiFillEyeInvisible } from "react-icons/ai";
import { Link, useLocation, useNavigate } from "react-router-dom";
import lgImg from "../assets/images/login/login.svg";
import useAuth from "../hook/useAuth";
import toast from "react-hot-toast";
import useAxiosSecure from "../hook/useAxiosSecure";
import { Helmet } from "react-helmet-async";

const Login = () => {
  const [showPassword, setShowPassword] = useState(false);
  const { signIn, googleLogin, githubLogin } = useAuth();
  const location = useLocation();
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();
    const form = e.target;
    const email = form.email.value;
    const password = form.password.value;

    try {
      const result = await signIn(email, password);    
      navigate(location.state || "/", { replace: true });
      toast.success("User login successfully");
    } catch (err) {
      toast.error(err.message.split("/")[1].split(")")[0]);
    }
  };

  const handleGoogleSignIn = async () => {
    try {
      const result = await googleLogin();
      toast.success("User login successfully");
      navigate(location.state || "/", { replace: true });
    } catch (err) {
      toast.error(err.message.split("/")[1].split(")")[0]);
    }
  };

  const handleGithubSignIn = async () => {
    try {
      const result = await githubLogin();
      toast.success("User login successfully");
      navigate(location.state || "/", { replace: true });
    } catch (err) {
      toast.error(err.message.split("/")[1].split(")")[0]);
    }
  };

  return (
    <div className="hero my-4">

       <Helmet>
          <title>YumHub | Login</title>
       </Helmet>

      <div className="hero-content lg:gap-20 flex-col lg:flex-row">
        <div className="md:w-1/2">
          <img src={lgImg} alt="" />
        </div>
        <div className="card md:w-1/2 shrink-0 w-full shadow-lg border bg-base-100">
          <div className="card-body">
            <h2 className="text-3xl font-semibold text-center">Login</h2>
            <form onSubmit={handleLogin}>
              <div className="form-control">
                <label className="label">
                  <span className="label-text">Email</span>
                </label>
                <input
                  type="text"
                  name="email"
                  placeholder="email"
                  className="input input-bordered"
                  required
                />
              </div>
              <div className="form-control">
                <label className="label">
                  <span className="label-text">Password</span>
                </label>
                <div className="relative">
                  <input
                    className="w-full input input-bordered"
                    type={showPassword ? "text" : "password"}
                    name="password"
                    placeholder="Password"
                    required
                  />
                  <span
                    className="absolute top-4 right-3"
                    onClick={() => setShowPassword(!showPassword)}
                  >
                    {showPassword ? <AiFillEyeInvisible /> : <AiFillEye />}
                  </span>
                </div>
              </div>
              <br />
              <input
                className="btn text-white bg-red-500 w-full"
                type="submit"
                value="Login"
              />
            </form>
            <div>
              <p className="text-lg">
                Have an account?{" "}
                <Link className="font-semibold text-primary" to={"/register"}>
                  Sign In
                </Link>
              </p>
            </div>
            <div className="divider">Continue With</div>
            <div className="flex justify-center gap-4">
              <button
                onClick={handleGoogleSignIn}
                className="btn btn-outline btn-error"
              >
                Google{" "}
              </button>
              <button
                onClick={handleGithubSignIn}
                className="btn btn-outline btn-secondary"
              >
                Github{" "}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Login;
