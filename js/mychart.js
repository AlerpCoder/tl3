$(document).ready(function () {

    console.log(all_data);
    let converseToVelocity = (data) => (data[3] / (data[2] / 60));

    let maxVelocity = Math.max(... all_data.map(data => converseToVelocity(data)));
    let maxDistance = Math.max(... all_data.map(data => data[3]));

    let sortDate = (date1, date2) => {
        date1 = new Date(date1.dateModified);
        date2 = new Date(date2.dateModified);
        return date1 - date2;
    };

    let dateList = (all_data.map((data) => data[1])).sort(sortDate);


    // draw coordinate system
    let svg = d3.select('#chart');

    let margin = {top: 15, left: 40, bottom: 40, right: 15};

    let width = 500;
    let height = 500;

    let xAxisScale = d3.scaleLinear().domain([0, maxDistance]).range([0, width - margin.left - margin.right]);
    let yAxisScale = d3.scaleLinear().domain([0, maxVelocity]).range([height - margin.top - margin.bottom, 0]);

    let xAxis = d3.axisBottom().scale(xAxisScale);
    let yAxis = d3.axisLeft().scale(yAxisScale);

    svg.append("g")
        .attr("transform", "translate(" + [margin.left, height - margin.bottom] + ")")
        .call(xAxis);

    svg.append("g")
        .attr("transform", "translate(" + [margin.left, margin.top] + ")")
        .call(yAxis);

    // text labels for axes
    svg.append("text")
        .attr("transform",
            "translate(" + (width / 2) + " ," +
            (height - margin.top + 10) + ")")
        .style("text-anchor", "middle")
        .text("Distanz in km");

    svg.append("text")
        .attr("transform",
            "translate(" + 15 + " ," +
            (height / 2) + "), rotate(-90)")
        .style("text-anchor", "middle")
        .text("Geschwindigkeit in km/h");


    let calculateDifference = (date1, date2) => Math.round(Math.abs(new Date(date1).getTime() - new Date(date2).getTime()) / (24 * 60 * 60 * 1000));
    let dateRange = calculateDifference(dateList[0], dateList[dateList.length - 1]);
    let dateDistance = (data) => {
        let diff = calculateDifference(data[1], dateList[dateList.length - 1]) / dateRange;
        return diff <= 0.2 ? 0.2 : diff;
    };

    svg.selectAll("circle")
        .data(all_data)
        .enter()
        .append("circle")
        .attr("cx", (d) => xAxisScale(d[3]) + margin.left)
        .attr("cy", (d) => yAxisScale(converseToVelocity(d)) + margin.top)
        .attr("r", 10)
        .attr("fill", "blue")
        .style("opacity", dateDistance);


});

