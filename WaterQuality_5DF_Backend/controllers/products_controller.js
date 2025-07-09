import { products } from "../data/data.js"; // Import the static data from data.js

export const productController = async (req, res) => {
    try {
        // Set headers to avoid caching
        res.setHeader("Cache-Control", "no-store, no-cache, must-revalidate, proxy-revalidate");
        res.setHeader("Expires", "0");
        res.setHeader("Pragma", "no-cache");

        // Return the static data from data.js
        res.status(200).json(products); // Return the static data as JSON response
    } catch (error) {
        return res.status(500).json({
            message: error.message, // Return error if something goes wrong
        });
    }
};
