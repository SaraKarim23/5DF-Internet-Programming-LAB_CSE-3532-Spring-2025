import { MdAddIcCall } from "react-icons/md";
import { FaRocketchat } from "react-icons/fa";
import { IoChatbubbleEllipsesSharp } from "react-icons/io5";
import { BsChatQuoteFill } from "react-icons/bs";
import { motion } from "framer-motion";

const Contact = () => {
    return (
        <div className="md:flex justify-center items-center gap-4 my-4 lg:my-12">
            <div className="space-y-3 md:w-1/2">
                <h4 className="text-3xl font-semibold text-red-500">You Contact Us</h4>
                <h2 className="text-5xl font-semibold">Easy to contact us</h2>
                <p>We always ready to help by providing the best services for you. We beleive a good blace to live can make your life better</p>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-3 rounded-lg">
                    <motion.div
                     initial={{ x: -100, opacity: 0 }}
                     whileInView={{ x: 0, opacity: 1 }}
                     transition={{delay:0.2, x:{type:"spring",stiffness:60},opacity:{duration:1},ease:"easeIn", duration:1}}
                     className="border p-4 rounded-lg ">
                        <div className="flex space-x-7">
                            <div className="p-4 bg-red-100 rounded-lg">
                                <MdAddIcCall className="text-black text-3xl"/>
                            </div>
                            <div>
                                <p className="text-2xl font-semibold">Call</p>
                                <p>018100000</p>
                            </div>
                        </div>
                        <button className="btn w-full my-2 text-blue-600">Call Now</button>
                    </motion.div>
                    <motion.div
                     initial={{ x: -100, opacity: 0 }}
                     whileInView={{ x: 0, opacity: 1 }}
                     transition={{delay:0.2, x:{type:"spring",stiffness:60},opacity:{duration:1},ease:"easeIn", duration:1}}
                     className="border p-4 rounded-lg">
                        <div className="flex space-x-7">
                            <div className="p-4 bg-red-100 rounded-lg">
                                <FaRocketchat className="text-3xl text-black"/>
                            </div>
                            <div>
                                <p className="text-2xl font-semibold">Chat</p>
                                <p>0181000000</p>
                            </div>
                        </div>
                        <button className="btn w-full my-2 text-blue-600">Call Now</button>
                    </motion.div>
                    <motion.div
                     initial={{ x: -100, opacity: 0 }}
                     whileInView={{ x: 0, opacity: 1 }}
                     transition={{delay:0.2, x:{type:"spring",stiffness:60},opacity:{duration:1},ease:"easeIn", duration:1}}
                     className="border p-4 rounded-lg">
                        <div className="flex space-x-7">
                            <div className="p-4 bg-red-100 rounded-lg">
                                <IoChatbubbleEllipsesSharp className="text-black text-3xl"/>
                            </div>
                            <div>
                                <p className="text-2xl font-semibold">Video call</p>
                                <p>0181000000</p>
                            </div>
                        </div>
                        <button className="btn w-full my-2 text-blue-600">Call Now</button>
                    </motion.div>
                    <motion.div
                     initial={{ x: -100, opacity: 0 }}
                     whileInView={{ x: 0, opacity: 1 }}
                     transition={{delay:0.2, x:{type:"spring",stiffness:60},opacity:{duration:1},ease:"easeIn", duration:1}}
                     className="border p-4 rounded-lg">
                        <div className="flex space-x-7">
                            <div className="p-4 bg-red-100 rounded-lg">
                                <BsChatQuoteFill className="text-3xl text-black"/>
                            </div>
                            <div>
                                <p className="text-2xl font-semibold">What's app</p>
                                <p>0181000000</p>
                            </div>
                        </div>
                        <button className="btn w-full my-2 text-blue-600">Call Now</button>
                    </motion.div>
                </div>
            </div>
            <motion.div 
             initial={{ x: 100, opacity: 0 }}
             whileInView={{ x: 0, opacity: 1 }}
             transition={{delay:0.2, x:{type:"spring",stiffness:60},opacity:{duration:1},ease:"easeIn", duration:1}}
             className="md:w-1/2">
                <img className="h-200px md:h-[500px] rounded-tr-[60px] rounded-bl-[60px]" src="https://i.ibb.co/dD1x7Yv/pexels-mike-468229-1192056.jpg" alt="" />
            </motion.div>
        </div>
    );
};

export default Contact;

