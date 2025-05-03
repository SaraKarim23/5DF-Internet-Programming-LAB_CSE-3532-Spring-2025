
import { Helmet } from "react-helmet-async";
import "react-datepicker/dist/react-datepicker.css";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";

const FoodDetails = () => {
  const [availableFoods, setAvailableFoods] = useState({});
  const { id } = useParams();

  useEffect(() => {
    fetch("/foods.json")
      .then(res => res.json())
      .then(data => {
        const selected = data.find(item => item._id === id);
        setAvailableFoods(selected || {});
      });
  }, [id]);
   

  return (
    <div>

      <Helmet>
          <title>YumHub | Food Details</title>
      </Helmet>

      <div className="lg:flex justify-center items-center gap-8 my-4 lg:my-10">
        <div className="flex justify-center items-center rounded-2xl lg:w-[50%]">
          <img className="rounded-2xl lg:h-[450px]" src={availableFoods?.photo} alt="" />
        </div>
        <div className="space-y-4 lg:w-[50%]">
          <h1 className="text-2xl lg:text-4xl font-semibold">{availableFoods?.food_name}</h1>
          <p className="text-xl">Status : {availableFoods?.status}</p>
          <p className="border-t-2 border-gray-300"></p>
          <p>
            <span className="font-semibold">Additional Notes : {availableFoods?.notes}</span>
          </p>
          <p className="border-t-2 border-gray-300"></p>
          <div className="space-y-2">
            <p className="flex items-center">
              <span className="w-[30%]">Quantity: </span>
              <span className="font-semibold">{availableFoods?.quantity}</span>
            </p>
            <p className="flex items-center">
              <span className="w-[30%]">Expire Date: </span>
              <span className="font-semibold">{new Date(availableFoods?.expired_date).toLocaleDateString()}</span>
            </p>
            <p className="flex items-center">
              <span className="w-[30%]">location: </span>
              <span className="font-semibold">{availableFoods?.location}</span>
            </p>
          </div>
          <p className="border-t-2 border-gray-300"></p>
          <div className="flex justify-between items-center">
            <div className="avatar">
              <div className="w-12 rounded-full">
                <img src={availableFoods?.donar?.photo} />
              </div>
            </div>
            <div>
              <p>Donar Name: {availableFoods?.donar?.name}</p>
              <p>Donar Email: {availableFoods?.donar?.email}</p>
            </div>
          </div>
          <div className="text-center">
            <button
              className="btn px-6 text-white btn-outline bg-red-500"
            >
              Request
            </button>
          </div>
        </div>
      </div>

      
    </div>
  );
};

export default FoodDetails;


