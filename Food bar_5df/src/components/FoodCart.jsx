import { Link } from "react-router-dom";
import { motion } from "framer-motion";

const FoodCart = ({ food,layout }) => {
  const {
    _id,
    food_name,
    quantity,
    notes,
    location,
    expired_date,
    photo,
    status,
    donar
  } = food;

  return (
    <motion.div
    initial={{ y: 100, opacity: 0 }}
    whileInView={{ y: 0, opacity: 1 }}
    transition={{delay:0.2, x:{type:"spring",stiffness:60},opacity:{duration:1},ease:"easeIn", duration:1}}
     className="p-4 rounded-xl hover:scale-105 hover:border-red-500 border-opacity-3 border-2 border-gray-100 space-y-3">
      <div className="flex justify-center items-center rounded-2xl">
        <img src={photo} className={`w-full rounded-lg ${layout=== true ? 'h-[300px]':'h-[200px]'}`} alt="" />
      </div>
      <div className="space-y-3">
        <div className="flex gap-2" title={notes}>{notes.substring(0,40)}.....</div>
        <h2 className="text-xl lg:text-2xl font-semibold">{food_name}</h2>
        <div className="flex justify-between">
          <p className="flex gap-1 items-center">Quantity : {quantity}</p>
          <p className="flex gap-1 items-center">
            {/* {expired_date} */}
            Location: {location}
          </p>
        </div>
        <p className="border-t border border-gray-300"></p>
        <div className="flex justify-between">
          <div className="avatar">
            <div className="w-10 rounded-full">
              <img src={donar.photo} />
            </div>
          </div>
          <p className="flex gap-1 items-center">
            Donar Name: {donar.name}
          </p>
        </div>
        <div className="flex items-center justify-center">
          <Link to={`/food/${_id}`} className="btn w-full text-white btn-outline bg-red-500">
            View Details
          </Link>
        </div>
      </div>
    </motion.div>
  );
};

export default FoodCart;
