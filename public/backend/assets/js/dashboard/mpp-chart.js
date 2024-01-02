$(function () {
    "use strict"
    $.getJSON('/appointmentChart', function (response) {
        var options3 = {
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: 'rounded',
                    columnWidth: '55%',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'Appointments',
                data: [response.aps[11].acount, response.aps[10].acount, response.aps[9].acount, response.aps[8].acount, response.aps[7].acount, response.aps[6].acount, response.aps[5].acount, response.aps[4].acount, response.aps[3].acount, response.aps[2].acount, response.aps[1].acount, response.aps[0].acount]
            }, {
                name: 'Registrations',
                data: [response.pat[11].acount, response.pat[10].acount, response.pat[9].acount, response.pat[8].acount, response.pat[7].acount, response.pat[6].acount, response.pat[5].acount, response.pat[4].acount, response.pat[3].acount, response.pat[2].acount, response.pat[1].acount, response.pat[0].acount]
            }, {
                name: 'Consultations',
                data: [response.con[11].acount, response.con[10].acount, response.con[9].acount, response.con[8].acount, response.con[7].acount, response.con[6].acount, response.con[5].acount, response.con[4].acount, response.con[3].acount, response.con[2].acount, response.con[1].acount, response.con[0].acount]
            }],
            xaxis: {
                categories: [response.aps[11].month, response.aps[10].month, response.aps[9].month, response.aps[8].month, response.aps[7].month, response.aps[6].month, response.aps[5].month, response.aps[4].month, response.aps[3].month, response.aps[2].month, response.aps[1].month, response.aps[0].month],
            },
            yaxis: {
                title: {
                    text: '# (Count)'
                }
            },
            fill: {
                opacity: 1

            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "# " + val + " Nos"
                    }
                }
            },
            colors: ['#24695c', '#e2c636', '#ff0000']
        }

        var chart3 = new ApexCharts(
            document.querySelector("#columnChart"),
            options3
        );

        chart3.render();
    });
});