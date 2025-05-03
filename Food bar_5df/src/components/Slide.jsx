import { Link } from "react-router-dom";
import { motion } from "framer-motion";

const Slide = ({ image, text }) => {
  return (
    <div
      className="w-full bg-center bg-cover h-[32rem] rounded-lg"
      style={{
        backgroundImage: `url(${image})`,
      }}
    >
      <div className="flex items-center justify-center w-full h-full bg-gray-900/70">
        <div className="text-center w-[70%] mx-auto">
          <motion.h1
            initial={{ x: -100, opacity: 0 }}
            whileInView={{ x: 0, opacity: 1 }}
            transition={{
              delay: 0.2,
              x: { type: "spring", stiffness: 60 },
              opacity: { duration: 1 },
              ease: "easeIn",
              duration: 1,
            }}
            className="text-3xl font-semibold text-white lg:text-5xl"
          >
            {text}
          </motion.h1>
          <br />
          <Link
            to={"/available-food"}
            className="btn btn-outline btn-error text-center px-5 py-4 mt-4 font-medium rounded-md"
          >
            <motion.h1
              initial={{ x: 100, opacity: 0 }}
              whileInView={{ x: 0, opacity: 1 }}
              transition={{delay:0.2, x:{type:"spring",stiffness:60},opacity:{duration:1},ease:"easeIn", duration:1}}
            >Buy Now</motion.h1>
          </Link>
        </div>
      </div>
    </div>
  );
};

export default Slide;
