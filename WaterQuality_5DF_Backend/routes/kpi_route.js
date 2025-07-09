import express from 'express';
import { kpiController } from '../controllers/kpi_controller.js';

const router = express.Router();

router.route("/kpis").get(kpiController);

export default router;