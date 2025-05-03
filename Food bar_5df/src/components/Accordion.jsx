import { motion } from "framer-motion";
const Accordion = () => {
  return (
    <div className="my-4 lg:my-12 space-y-5">
      <h1 className="text-4xl font-semibold text-center">Clients Question</h1>
      <p className="lg:w-[55%] text-center mx-auto opacity-80">
        Explore the answers to all your questions with our client Q&A. Clear,
        concise, and comprehensive – your inquiries, our expertise.{" "}
      </p>
      <div className="md:flex items-center border-2 p-4 rounded-lg gap-6">
        <motion.div
         initial={{ x: -100, opacity: 0 }}
         whileInView={{ x: 0, opacity: 1 }}
         transition={{delay:0.2, x:{type:"spring",stiffness:60},opacity:{duration:1},ease:"easeIn", duration:1}}
        >
          <img
            className="rounded-2xl lg:h-[400px]"
            src="https://i.ibb.co/tJfnSbJ/pexels-suju-1132558.jpg"
          />
        </motion.div>
        <motion.div
         initial={{ x: 100, opacity: 0 }}
         whileInView={{ x: 0, opacity: 1 }}
         transition={{delay:0.2, x:{type:"spring",stiffness:60},opacity:{duration:1},ease:"easeIn", duration:1}}
         className="join join-vertical">
          <div className="collapse collapse-arrow join-item">
            <input type="radio" name="my-accordion-4" defaultChecked />
            <div className="collapse-title text-xl font-medium">
              How do I place an order?
            </div>
            <div className="collapse-content">
              <p>Browse menu, select items, and checkout.</p>
            </div>
          </div>
          <div className="collapse collapse-arrow join-item">
            <input type="radio" name="my-accordion-4" />
            <div className="collapse-title text-xl font-medium">
              What payment methods do you accept?
            </div>
            <div className="collapse-content">
              <p>Credit/debit cards, Bikash, Nagad or cash on delivery.</p>
            </div>
          </div>
          <div className="collapse collapse-arrow join-item">
            <input type="radio" name="my-accordion-4" />
            <div className="collapse-title text-xl font-medium">
             How do I know if my order is confirmed?
            </div>
            <div className="collapse-content">
              <p>
                {" "}
                Email confirmation after checkout.
              </p>
            </div>
          </div>
          <div className="collapse collapse-arrow join-item">
            <input type="radio" name="my-accordion-4" />
            <div className="collapse-title text-xl font-medium">What if there's an issue with my order?</div>
            <div className="collapse-content">
              <p>Contact customer support for assistance.</p>
            </div>
          </div>
          <div className="collapse collapse-arrow join-item">
            <input type="radio" name="my-accordion-4" />
            <div className="collapse-title text-xl font-medium"> Can I cancel/change my order?.</div>
            <div className="collapse-content">
              <p>
              Contact us immediately to try.
              </p>
            </div>
          </div>
          <div className="collapse collapse-arrow join-item">
            <input type="radio" name="my-accordion-4" />
            <div className="collapse-title text-xl font-medium">Pricing.</div>
            <div className="collapse-content">
              <p>Eye-catching discount and affordable price.</p>
            </div>
          </div>
        </motion.div>
      </div>
    </div>
  );
};

export default Accordion;
