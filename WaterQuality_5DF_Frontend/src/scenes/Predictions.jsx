import { Card } from "@/components/ui/card";
import React, { useMemo, useState } from "react";
import {
  ResponsiveContainer,
  LineChart,
  CartesianGrid,
  XAxis,
  YAxis,
  Tooltip,
  Legend,
  Line,
  Label,
} from "recharts";
import regression from "regression";
import { useGetKpisQuery } from "@/state/api";

const Predictions = () => {
  const [isPredictions, setIsPredictions] = useState(false);
  const { data: kpiData } = useGetKpisQuery();

  const formattedData = useMemo(() => {
    if (!kpiData || !kpiData.length || !kpiData[0].monthlyData) return [];

    const monthData = kpiData[0].monthlyData;
    const formatted = monthData
      .map(({ revenue }, i) => {
         // If “revenue” is a string (like "$5,000"), strip “$” and “,” and turn it into 5000.
         // Otherwise, use it as-is if it’s already a number.
        const revenueNum =
          typeof revenue === "string"
            ? parseFloat(revenue.replace("$", "").replace(",", ""))
            : revenue;
        return !isNaN(revenueNum) ? [i, revenueNum] : null;
      })
      .filter((point) => point !== null);  //.filter(point => point !== null);

    if (!formatted.length) return [];

    const regressionLine = regression.linear(formatted);

    return monthData
      .map(({ month, revenue }, i) => {
        const revenueNum =
          typeof revenue === "string"
            ? parseFloat(revenue.replace("$", "").replace(",", ""))
            : revenue;
        return {
          name: month.substring(0, 3),
          "Actual Revenue": revenueNum,
          "Regression Line": regressionLine.points[i]?.[1] ?? null,
          "Predicted Revenue": regressionLine.predict(i + 12)?.[1] ?? null,
        };
      })
      .filter((data) => data["Actual Revenue"] !== null);
  }, [kpiData]);

  return (
    <div className="px-6">
      <Card className="w-full h-full bg-zinc-800 p-4 border-0 shadow-xl shadow-black/70 drop-shadow-2xl">
      <div className="flex justify-between items-center mb-4">
        <div>
          <h1 className="text-white text-2xl font-bold">
            Revenue and Predictions
          </h1>
          <p className="text-gray-400 text-sm">
            Charted revenue and predicted revenue based on a simple linear
            regression model
          </p>
        </div>
        <button
          onClick={() => setIsPredictions(!isPredictions)}
          className="bg-zinc-700 text-gray-300 px-4 py-2 rounded-lg shadow-md"
        >
          {isPredictions ? "Hide Predictions" : "Show Predicted Revenue"}
        </button>
      </div>
      <ResponsiveContainer width="100%" height={350}>
        <LineChart
          data={formattedData}
          margin={{ top: 20, right: 30, left: 20, bottom: 30 }}
        >
          <CartesianGrid strokeDasharray="3 3" stroke="#4B5563" />
          <XAxis
            dataKey="name"
            tickLine={false}
            className="text-gray-400 text-xs"
          >
            <Label
              value="Month"
              offset={-5}
              position="insideBottom"
              fill="white"
            />
          </XAxis>
          <YAxis
            tickFormatter={(v) => `$${v}`}
            className="text-gray-400 text-xs"
          >
            <Label
              value="Revenue in USD"
              angle={-90}
              offset={-5}
              position="insideLeft"
              fill="white"
            />
          </YAxis>
          <Tooltip
            contentStyle={{
              borderRadius: "8px",
              backgroundColor: "#1F2937",
              borderColor: "#4B5563",
            }}
          />
          <Legend verticalAlign="top" wrapperStyle={{ color: "white" }} />
          <Line
            type="monotone"
            dataKey="Actual Revenue"
            stroke="transparent"
            dot={{ strokeWidth: 5, fill: "#F59E0B" }}
          />
          <Line
            type="monotone"
            dataKey="Regression Line"
            stroke="#8884d8"
            dot={false}
          />
          {isPredictions && (
            <Line
              strokeDasharray="5 5"
              dataKey="Predicted Revenue"
              stroke="#F59E0B"
            />
          )}
        </LineChart>
      </ResponsiveContainer>
    </Card>
    </div>
  );
};

export default Predictions;
