import "./bootstrap";
import "flowbite";
import "apexcharts";

$("#all_btn").on("click", function () {
    var url = $(this).data("value");
    window.location.href = url;
});

const today = new Date().getDay();
const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
const data = [];
for (let i = 0; i < 7; i++) {
    // Calculate the index of the day of the week
    const index = (today - i + 7) % 7;
    // Add a data point with the day of the week and a random y value
    data.push({ x: daysOfWeek[index], y: 250 });
}

// console.log(count_member_log);
// console.log(count_daily_log);
const options = {
    colors: ["#1A56DB", "#FDBA8C"],
    series: [
        {
            name: "Member",
            color: "#1A56DB",
            data: [
                { x: data[6].x, y: count_member_log.days.D1 },
                { x: data[5].x, y: count_member_log.days.D2 },
                { x: data[4].x, y: count_member_log.days.D3 },
                { x: data[3].x, y: count_member_log.days.D4 },
                { x: data[2].x, y: count_member_log.days.D5 },
                { x: data[1].x, y: count_member_log.days.D6 },
                { x: data[0].x, y: count_member_log.days.D7 },
            ],
        },
        {
            name: "Daily",
            color: "#FDBA8C",
            data: [
                { x: data[6].x, y: count_daily_log.days.D1 },
                { x: data[5].x, y: count_daily_log.days.D2 },
                { x: data[4].x, y: count_daily_log.days.D3 },
                { x: data[3].x, y: count_daily_log.days.D4 },
                { x: data[2].x, y: count_daily_log.days.D5 },
                { x: data[1].x, y: count_daily_log.days.D6 },
                { x: data[0].x, y: count_daily_log.days.D7 },
            ],
        },
    ],
    chart: {
        type: "bar",
        height: "320px",
        fontFamily: "Inter, sans-serif",
        toolbar: {
            show: false,
        },
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "70%",
            borderRadiusApplication: "end",
            borderRadius: 8,
        },
    },
    tooltip: {
        shared: true,
        intersect: false,
        style: {
            fontFamily: "Inter, sans-serif",
        },
    },
    states: {
        hover: {
            filter: {
                type: "darken",
                value: 1,
            },
        },
    },
    stroke: {
        show: true,
        width: 0,
        colors: ["transparent"],
    },
    grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: -14,
        },
    },
    dataLabels: {
        enabled: false,
    },
    legend: {
        show: false,
    },
    xaxis: {
        floating: false,
        labels: {
            show: true,
            style: {
                fontFamily: "Inter, sans-serif",
                cssClass:
                    "text-xs font-normal fill-gray-500 dark:fill-gray-400",
            },
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: false,
    },
    fill: {
        opacity: 1,
    },
};

if (
    document.getElementById("column-chart") &&
    typeof ApexCharts !== "undefined"
) {
    const chart = new ApexCharts(
        document.getElementById("column-chart"),
        options
    );
    chart.render();
}

//=========DAILY CHARTS==============//
function getFormattedDate(date) {
    // Array of month names
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    // Get the day and month
    const day = date.getDate();
    const month = date.getMonth() + 1; // Month is zero-indexed, so add 1

    // Format the date as "DD Month"
    return (day < 10 ? "0" : "") + day + " " + months[month - 1];
}

// Get the current date
const currentDate = new Date();
const categoryLabels = [];

// Loop to get the previous 7 days
for (let i = 6; i >= 0; i--) {
    // Create a new Date object for each day by subtracting the number of days
    const date = new Date(currentDate);
    date.setDate(currentDate.getDate() - i);

    // Format the date and add it to the categoryLabels array
    categoryLabels.push(getFormattedDate(date));
}

console.log(categoryLabels)

const daily_charts = {
    chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"],
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 6,
    },
    grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: 0,
        },
    },
    series: [
        {
            name: "Daily Traffic",
            data: [count_daily_log.days.D1, count_daily_log.days.D2, count_daily_log.days.D3, count_daily_log.days.D4, count_daily_log.days.D5, count_daily_log.days.D6,count_daily_log.days.D7],
            color: "#1A56DB",
        },
    ],
    xaxis: {
        categories: [
            categoryLabels[0],
            categoryLabels[1],
            categoryLabels[2],
            categoryLabels[3],
            categoryLabels[4],
            categoryLabels[5],
            categoryLabels[6],
        ],
        labels: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: false,
    },
};

if (
    document.getElementById("area-chart") &&
    typeof ApexCharts !== "undefined"
) {
    const chart = new ApexCharts(
        document.getElementById("area-chart"),
        daily_charts
    );
    chart.render();
}

const getChartOptions = () => {
    return {
        series: [52.8, 26.8, 20.4],
        colors: ["#1C64F2", "#16BDCA", "#9061F9"],
        chart: {
            height: 420,
            width: "100%",
            type: "pie",
        },
        stroke: {
            colors: ["white"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                labels: {
                    show: true,
                },
                size: "100%",
                dataLabels: {
                    offset: -25,
                },
            },
        },
        labels: ["Body Building", "Yoga", "Weight Loss"],
        dataLabels: {
            enabled: true,
            style: {
                fontFamily: "Inter, sans-serif",
            },
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value + "%";
                },
            },
        },
        xaxis: {
            labels: {
                formatter: function (value) {
                    return value + "%";
                },
            },
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
    };
};

if (document.getElementById("pie-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(
        document.getElementById("pie-chart"),
        getChartOptions()
    );
    chart.render();
}
