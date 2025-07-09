import express from 'express';
import { transactionController } from '../controllers/transactions_controller.js';

const router = express.Router();

router.route("/transactions").get(transactionController);

export default router;