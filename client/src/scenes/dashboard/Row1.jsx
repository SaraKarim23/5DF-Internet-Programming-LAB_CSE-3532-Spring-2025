import { Card } from "@/components/ui/card";
import { useGetKpisQuery } from "@/state/api";
import { useMemo } from "react";
import {
  ResponsiveContainer,
  AreaChart,
  Area,
  XAxis,
  YAxis,
  Tooltip,
  LineChart,
  CartesianGrid,
  Legend,
  Line,
  BarChart,
  Bar,
} from "recharts";

const Row1 = () => {
  const { data } = useGetKpisQuery();

  const revenue = useMemo(() => {
    return (
      data &&
      data[0].monthlyData.map(({ month, revenue }) => ({
        name: month.substring(0, 3),
        revenue: parseFloat(revenue.replace("$", "").replace(",", "")),
      }))
    );
  }, [data]);

  const revenueExpenses = useMemo(() => {
    return (
      data &&
      data[0].monthlyData.map(({ month, revenue, expenses }) => ({
        name: month.substring(0, 3),
        revenue: parseFloat(revenue.replace("$", "").replace(",", "")),
        expenses: parseFloat(expenses.replace("$", "").replace(",", "")),
      }))
    );
  }, [data]);

  const revenueProfit = useMemo(() => {
    return (
      data &&
      data[0].monthlyData.map(({ month, revenue, expenses }) => {
        const revenueAmount = parseFloat(
          revenue.replace("$", "").replace(",", "")
        );
        const expensesAmount = parseFloat(
          expenses.replace("$", "").replace(",", "")
        );
        return {
          name: month.substring(0, 3),
          revenue: revenueAmount,
          profit: (revenueAmount - expensesAmount).toFixed(2),
        };
      })
    );
  }, [data]);

  if (!revenue || !revenueExpenses || !revenueProfit) {
    return <div>Loading...</div>;
  }

  return (
    <>
      <Card
        className="bg-zinc-800 p-4 border-0 shadow-xl shadow-black/70 drop-shadow-2xl"
        style={{ gridArea: "a" }}
      >
        <div className="pt-5">
          <h1 className="text-white text-md font-semibold">Revenue and Expenses</h1>
        </div>
        <div className="text-zinc-400 text-sm">
          Top line represents revenue, bottom line represents expenses
        </div>
        <ResponsiveContainer width="100%" height="100%">
          <AreaChart
            data={revenueExpenses}
            margin={{ top: 15, right: 25, left: -10, bottom: 40 }}
          >
            <defs>
              <linearGradient id="colorRevenue" x1="0" y1="0" x2="0" y2="1">
                <stop offset="5%" stopColor="#3B82F6" stopOpacity={0.5} />
                <stop offset="95%" stopColor="#3B82F6" stopOpacity={0} />
              </linearGradient>
              <linearGradient id="colorExpenses" x1="0" y1="0" x2="0" y2="1">
                <stop offset="5%" stopColor="#EF4444" stopOpacity={0.5} />
                <stop offset="95%" stopColor="#EF4444" stopOpacity={0} />
              </linearGradient>
            </defs>
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
              axisLine={{ strokeWidth: "0" }}
              style={{ fontSize: "12px", fontWeight: 500 }}
              domain={[8000, 23000]}
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
            <Area
              type="monotone"
              dataKey="revenue"
              dot
              stroke="#3B82F6"
              fillOpacity={1}
              fill="url(#colorRevenue)"
            />
            <Area
              type="monotone"
              dataKey="expenses"
              dot
              stroke="#EF4444"
              fillOpacity={1}
              fill="url(#colorExpenses)"
            />
          </AreaChart>
        </ResponsiveContainer>
      </Card>

      <Card
        className="bg-zinc-800 p-4 border-0 shadow-xl shadow-black/70 drop-shadow-2xl"
        style={{ gridArea: "b" }}
      >
        <div className="pt-5">
          <h1 className="text-white text-md font-semibold">Profit and Revenue</h1>
        </div>
        <div className="text-zinc-400 text-sm">
          Top line represents revenue, bottom line represents profit
        </div>
        <ResponsiveContainer width="100%" height="100%">
          <LineChart
            data={revenueProfit}
            margin={{ top: 20, right: 0, left: -10, bottom: 40 }}
          >
            <CartesianGrid vertical={true} stroke="#ffffff33" strokeDasharray="3 3" />
            <XAxis
              dataKey="name"
              tickLine={false}
              style={{ fontSize: "12px", fontWeight: 500 }}
            />
            <YAxis
              yAxisId="left"
              tickLine={false}
              axisLine={false}
              style={{ fontSize: "12px", fontWeight: 500 }}
            />
            <YAxis
              yAxisId="right"
              orientation="right"
              tickLine={false}
              axisLine={false}
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
              height={10}
              wrapperStyle={{ margin: "0 0 10px 0", color: "#fff" }}
            />
            <Line
              yAxisId="left"
              type="monotone"
              dataKey="profit"
              stroke="#10B981"
              strokeWidth={1}
              dot={{ stroke: "#10B981", strokeWidth: 2, r: 2 }}
            />
            <Line
              yAxisId="right"
              type="monotone"
              dataKey="revenue"
              stroke="#3B82F6"
              strokeWidth={1}
              dot={{ stroke: "#3B82F6", strokeWidth: 2, r: 2 }}
            />
          </LineChart>
        </ResponsiveContainer>
      </Card>

      <Card
        className="bg-zinc-800 p-4 border-0 shadow-xl shadow-black/70 drop-shadow-2xl"
        style={{ gridArea: "c" }}
      >
        <div className="pt-5">
          <h1 className="text-white text-md font-semibold">Revenue Month by Month</h1>
        </div>
        <div className="text-zinc-400 text-sm">
          Graph representing the revenue month by month
        </div>
        <ResponsiveContainer width="100%" height="100%">
          <BarChart
            data={revenue}
            margin={{ top:1, right: 10, left: -5, bottom: 50 }}
          >
            <defs>
              <linearGradient id="colorRevenue" x1="0" y1="0" x2="0" y2="1">
                <stop offset="5%" stopColor="#3B82F6" stopOpacity={0.8} />
                <stop offset="95%" stopColor="#3B82F6" stopOpacity={0} />
              </linearGradient>
            </defs>
            <CartesianGrid vertical={false} stroke="#1F2937" />
            <XAxis
              dataKey="name"
              axisLine={false}
              tickLine={false}
              style={{ fontSize: "12px" }}
            />
            <YAxis
              axisLine={false}
              tickLine={false}
              style={{ fontSize: "12px" }}
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
            <Bar dataKey="revenue" fill="url(#colorRevenue)" />
          </BarChart>
        </ResponsiveContainer>
      </Card>
    </>
  );
};

export default Row1;
