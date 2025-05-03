import { Link } from "react-router-dom";

const ErrorPage = () => {
  return (
    <div className="flex flex-col items-center justify-center">
      <img
        src="https://i.ibb.co/s1wWWb2/404.jpg"
        className="max-h-[400px]"
        alt=""
      />
      <Link className="btn bg-red-500 text-white" to={"/"}>
        Go Back Home
      </Link>
    </div>
  );
};

export default ErrorPage;
