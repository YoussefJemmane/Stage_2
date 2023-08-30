(function () {
    "use strict";

    // Chart
    if ($("#report-pie-chart").length) {
        let data = [window.pendingFrais,  window.unpaidFrais,window.paidFrais];


        let ctx = $("#report-pie-chart")[0].getContext("2d");
        let myPieChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: [
                    "Pending",

                    "Unpaid",
                    "Paid",
                ],
                datasets: [
                    {
                        data: data,
                        backgroundColor: [
                            getColor("pending", 0.9),
                            getColor("warning", 0.9),
                            getColor("primary", 0.9),
                            getColor("success", 0.9),
                            getColor("danger", 0.9),
                            getColor("info", 0.9),

                        ],
                        hoverBackgroundColor: [
                            getColor("pending", 0.9),
                            getColor("warning", 0.9),
                            getColor("primary", 0.9),
                            getColor("success", 0.9),
                            getColor("danger", 0.9),
                            getColor("info", 0.9),

                        ],
                        borderWidth: 5,
                        borderColor: $("html").hasClass("dark")
                            ? getColor("darkmode.700")
                            : getColor("white"),
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        });
    }
})();
