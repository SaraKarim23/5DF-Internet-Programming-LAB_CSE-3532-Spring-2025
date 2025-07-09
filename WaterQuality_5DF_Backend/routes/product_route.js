import express from 'express';
import { productController } from '../controllers/products_controller.js';

const router = express.Router();

router.route("/products").get(productController);

export default router;