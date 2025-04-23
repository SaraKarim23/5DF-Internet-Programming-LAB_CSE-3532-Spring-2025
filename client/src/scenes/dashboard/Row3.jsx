import { Card } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { PieChart, Pie, Cell } from 'recharts';
import { useMemo } from 'react';
import { useGetKpisQuery, useGetProductsQuery, useGetTransactionsQuery } from '@/state/api';

const Row3 = () => {
  const { data: kpiData } = useGetKpisQuery();
  const { data: productData = [] } = useGetProductsQuery();
  const { data: transactionData = [] } = useGetTransactionsQuery();

  const pieChartData = useMemo(() => {
    if (!kpiData || kpiData.length === 0) return [];

    const totalExpenses = parseFloat(kpiData[0]?.totalExpenses?.toString().replace("$", "").replace(",", ""));
    const expensesByCategory = kpiData[0]?.expensesByCategory || {};

    return Object.entries(expensesByCategory).map(([key, value]) => [
      { name: key, value: totalExpenses - value },
      { name: `${key} of Total`, value: parseFloat(value?.toString().replace("$", "").replace(",", "")) },
    ]);
  }, [kpiData]);

  return (
    <>
      {/* Products Table */}
<Card className="bg-zinc-800 p-4 shadow-xl border-0 drop-shadow-2xl" style={{ gridArea: 'g', height: '300px' }}>
  <h2 className="text-white text-lg mb-2">List of Products ({productData.length} products)</h2>
  <div className="overflow-y-auto h-[200px]"> {/* Scrollable container for table body */}
    <Table className="text-white">
      <TableHeader>
        <TableRow>
          <TableHead className="text-white">ID</TableHead>
          <TableHead className="text-white">Expense</TableHead>
          <TableHead className="text-white">Price</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        {productData.slice(0, 10).map((item) => (  // Display all data, but only 4 visible at a time
          <TableRow key={item._id}>
            <TableCell>{item._id}</TableCell>
            <TableCell>{`$${item.expense || 0}`}</TableCell>
            <TableCell>{`$${item.price || 0}`}</TableCell>
          </TableRow>
        ))}
      </TableBody>
    </Table>
  </div>
</Card>


     {/* Transactions Table */}
<Card className="bg-zinc-800 p-4 shadow-xl border-0 drop-shadow-2xl" style={{ gridArea: 'h', height: '370px' }}>
  <h2 className="text-white text-lg mb-2">Recent Orders ({transactionData.length} latest transactions)</h2>
  <div className="overflow-y-auto h-[250px]"> {/* Scrollable container for table body */}
    <Table className="text-white">
      <TableHeader >
        <TableRow>
          <TableHead className="text-white">ID</TableHead>
          <TableHead className="text-white">Buyer</TableHead>
          <TableHead className="text-white">Amount</TableHead>
          <TableHead className="text-white">Count</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        {transactionData.map((item) => (
          <TableRow key={item._id}>
            <TableCell>{item._id}</TableCell>
            <TableCell>{item.buyer}</TableCell>
            <TableCell>{`$${item.amount || 0}`}</TableCell>
            <TableCell>{Array.isArray(item.productIds) ? item.productIds.length : 0}</TableCell>
          </TableRow>
        ))}
      </TableBody>
    </Table>
  </div>
</Card>


      {/* Pie Chart */}
      <Card className="bg-zinc-800 p-4 shadow-xl border-0 drop-shadow-2xl" style={{ gridArea: 'i' }}>
        <h2 className="text-white text-lg mb-2">Expense Breakdown By Category</h2>
        <div className="flex justify-between gap-3 text-center">
          {pieChartData?.map((data, i) => (
            <div key={`${data[0].name}-${i}`} className="flex flex-col items-center">
              <PieChart width={80} height={70}>
                <Pie
                  stroke="none"
                  data={data}
                  innerRadius={15}
                  outerRadius={30}
                  paddingAngle={5}
                  dataKey="value"
                >
                  {data.map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={index === 0 ? '#4B5563' : '#9CA3AF'} />
                  ))}
                </Pie>
              </PieChart>
              <span className="text-white">{data[0].name}</span>
            </div>
          ))}
        </div>
      </Card>

      {/* Summary Section */}
      <Card className="bg-zinc-800 p-4 shadow-xl border-0 drop-shadow-2xl" style={{ gridArea: 'j' }}>
        <h2 className="text-white text-sm mb-2">Overall Summary and Explanation Data</h2>
        <div className="h-3 bg-gray-600 mb-3 rounded-lg">
          <div className="h-3 bg-gray-500 rounded-lg" style={{ width: '40%' }}></div>
        </div>
        <p className="text-white text-[0.6rem]">
        Orci aliquam enim vel diam. Venenatis euismod id donec mus lorem etiam ullamcorper odio sed. Ipsum non sed gravida etiam urna egestas molestie volutpat et. Malesuada quis pretium aliquet lacinia ornare sed. In volutpat nullam at est id cum pulvinar nunc. 
        </p>
      </Card>
    </>
  );
};

export default Row3;
