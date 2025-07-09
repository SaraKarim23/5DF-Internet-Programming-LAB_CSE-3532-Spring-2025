import { Card } from "@/components/ui/card";
import React, { useMemo } from "react";
import { useGetKpisQuery, useGetProductsQuery } from "@/state/api";
import {
  ResponsiveContainer,
  LineChart,
  CartesianGrid,
  XAxis,
  YAxis,
  Line,
  Tooltip,
  PieChart,
  Pie,
  Cell,
  ScatterChart,
  Scatter,
  ZAxis,
  Legend,
} from "recharts";

const pieData = [
  { name: "Group A", value: 600 },
  { name: "Group B", value: 400 },
];

const Row2 = () => {
  const { data: operationalData } = useGetKpisQuery();
  const { data: productData } = useGetProductsQuery();

  const operationalExpenses = useMemo(() => {
    return operationalData?.[0]?.monthlyData?.map(
      ({ month, operationalExpenses, nonOperationalExpenses }) => ({
        name: month.substring(0, 3),
        "Operational Expenses": parseFloat(
          operationalExpenses?.toString().replace("$", "").replace(",", "")
        ),
        "Non Operational Expenses": parseFloat(
          nonOperationalExpenses?.toString().replace("$", "").replace(",", "")
        ),
      })
    );
  }, [operationalData]);

  const productExpenseData = useMemo(() => {
    return productData?.map(({ _id, price, expense }) => ({
      id: _id,
      price: parseFloat(price?.toString().replace("$", "").replace(",", "")),
      expense: parseFloat(
        expense?.toString().replace("$", "").replace(",", "")
      ),
    }));
  }, [productData]);

  return (
    <>
      {/* Operational vs Non-Operational Expenses */}
      <Card
        className="bg-zinc-800 p-4 border-0 shadow-xl shadow-black/70 drop-shadow-2xl"
        style={{ gridArea: "d" }}
      >
        <div className="pt-5">
          <h1 className="text-white text-md font-semibold">
            Operational vs Non-Operational Expenses
          </h1>
        </div>
        <div className="text-zinc-400 text-sm">
          Top line represents operational expenses,bottom line represents
          non-operational expenses
        </div>
        <ResponsiveContainer width="100%" height="100%">
          <LineChart
            data={operationalExpenses}
            margin={{ top: 8, right: 0, left: -10, bottom: 30 }}
          >
            <CartesianGrid
              stroke="#ffffff33"
              strokeDasharray="3 3"
              vertical={false}
            />
            <XAxis
              dataKey="name"
              tickLine={false}
              style={{ fontSize: "12px", fontWeight: 500 }}
            />
            <YAxis
              tickLine={false}
              style={{ fontSize: "12px", fontWeight: 500 }}
            />
            <Tooltip
              contentStyle={{
                backgroundColor: "#333",
                borderRadius: "8px",
                border: "none",
                boxShadow: "0 0 10px rgba(0,0,0,0.3)",
              }}
              labelStyle={{ color: "#fff", fontWeight: "bold" }}
            />
            <Legend
              height={20}
              wrapperStyle={{
                margin: "0 0 10px 0",
                color: "#fff",
                fontSize: "10px",
              }}
            />
            <Line
              type="monotone"
              dataKey="Non Operational Expenses"
              stroke="#f43f5e"
              strokeWidth={2}
              dot={{ stroke: "#f43f5e", strokeWidth: 2, r: 2 }}
            />
            <Line
              type="monotone"
              dataKey="Operational Expenses"
              stroke="#3b82f6"
              strokeWidth={2}
              dot={{ stroke: "#3b82f6", strokeWidth: 2, r: 2 }}
            />
          </LineChart>
        </ResponsiveContainer>
      </Card>

      {/* Campaigns and Targets */}
      <Card
        className="bg-zinc-800 p-4 border-0 shadow-xl drop-shadow-2xl"
        style={{ gridArea: "e" }}
      >
        <div className="pt-5">
          <h1 className="text-white text-md font-semibold">
          Campaigns and Targets
          </h1>
        </div>
        <ResponsiveContainer width="100%" height="100%">
          <div className="flex justify-between mb-2">
            <PieChart width={70} height={70}>
              <Pie
                stroke="none"
                data={pieData}
                innerRadius={20}
                outerRadius={32}
                dataKey="value"
              >
                {pieData.map((entry, index) => (
                  <Cell
                    key={`cell-${index}`}
                    fill={index === 0 ? "#3b82f6" : "#f43f5e"}
                  />
                ))}
              </Pie>
            </PieChart>
            <div className="text-white text-center">
              <p className="text-sm">Target Sales</p>
              <p className="text-2xl text-blue-400 font-bold">83</p>
              <p className="text-sm">Finance goals of the campaign</p>
            </div>
          </div>
        </ResponsiveContainer>
      </Card>

      {/* Product Prices vs Expenses */}
      <Card
        className="bg-zinc-800 p-4 border-0 shadow-xl drop-shadow-2xl"
        style={{ gridArea: "f" }}
      >
        <div className="pt-5">
          <h1 className="text-white text-md font-semibold">
          Product Prices vs Expenses
          </h1>
        </div>
        <ResponsiveContainer width="100%" height="100%">
          <ScatterChart margin={{ top: 8, right: 0, left: -10, bottom: 30 }}>
            <CartesianGrid stroke="#374151" />
            <XAxis
              type="number"
              dataKey="price"
              style={{ fontSize: "12px", fontWeight: 500 }}
              tickFormatter={(v) => `$${v}`}
            />
            <YAxis
              type="number"
              dataKey="expense"
              style={{ fontSize: "12px", fontWeight: 500 }}
              tickFormatter={(v) => `$${v}`}
            />
            <ZAxis type="number" range={[20]} />
            <Tooltip
              contentStyle={{
                backgroundColor: "#333",
                borderRadius: "8px",
                border: "none",
                boxShadow: "0 0 10px rgba(0,0,0,0.3)",
              }}
              labelStyle={{ color: "#fff", fontWeight: "bold" }}
            />
            <Scatter
              name="Product Expense Ratio"
              data={productExpenseData}
              fill="#f43f5e"
            />
          </ScatterChart>
        </ResponsiveContainer>
      </Card>
    </>
  );
};

export default Row2;
