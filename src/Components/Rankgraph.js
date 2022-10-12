import React from "react";
import {
  LineChart,
  Line,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  Legend
} from "recharts";

export default function Rankgraph({ rest_data }) {

  return (
    <div>
      <LineChart width={380} height={310} data={rest_data} margin={{ top: 5, right: 10, left: 0, bottom: 5 }} >
        <CartesianGrid strokeDasharray="3 3" />
        <XAxis dataKey="Name" />
        <YAxis />
        <Tooltip />
        <Legend />
        <Line
          type="monotone"
          dataKey="PV"
          stroke="#0000FF"
          activeDot={{ r: 5 }}
        />
        <Line type="monotone" dataKey="UV" stroke="#00FF00" />
      </LineChart>
    </div>
  );
}
