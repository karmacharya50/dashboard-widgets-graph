import React, { useEffect, useState } from "react";
import Rankgraph from "./Rankgraph";

let data = document.querySelector('#rank_graph_root').getAttribute('data-url');
export default function Selectoption() {

    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [posts, setPosts] = useState(null);
    const [state, setState] = useState([]);
    useEffect(() => {
        const fetchData = function () {
            fetch(data)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(
                            `This is an HTTP error: The status is ${response.status}`
                        );
                    }
                    return response.json();
                })
                .then((actualData) => {
                    //console.log(actualData);
                    setPosts(actualData);
                    setState(actualData);
                    setError(null);
                })
                .catch((err) => {
                    //console.log(err.message);
                })
                .finally(() => {
                    setLoading(false);
                });
        };
        fetchData();
    }, []);
    const start = 0;
    const handleDataDays = (e) => {
        const idx = e.target.selectedIndex;
        const option = e.target.querySelectorAll('option')[idx];
        const days = option.getAttribute('value');
        let sliceData = posts.slice(start, days);
        setState(sliceData);
        return days
    }
    const options = [
        {
            label: "1 Month",
            value: "30",
        }, {
            label: "15 Days",
            value: "15",
        }, {
            label: "7 Days",
            value: "7",
        }

    ];

    return (
        <div className="rank-math-wrap">
            <div className="select-container">
                <select value={handleDataDays.days} onChange={handleDataDays}>
                    {options.map((option) => (
                        <option value={option.value} key={option.value}>{option.label}</option>
                    ))}
                </select>
            </div >
            <div className="rank-math-graph-">
                <Rankgraph rest_data={state} />
            </div>
        </div>
    );
}
