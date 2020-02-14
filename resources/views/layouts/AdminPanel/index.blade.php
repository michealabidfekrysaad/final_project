@extends('layouts.AdminPanel.page')

@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row m-t-25">
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c1">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                            <div class="text">
                                <h2>{{$members}}</h2>
                                <span>members</span>
                            </div>
                        </div>
                        <div class="overview-chart"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                            <canvas id="widgetChart1" height="54" width="114" class="chartjs-render-monitor" style="display: block; height: 73px; width: 152px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c2">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="text">
                                <h2>{{$reports}}</h2>
                                <span>Reports</span>
                            </div>
                        </div>
                        <div class="overview-chart"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                            <canvas id="widgetChart2" height="86" width="114" class="chartjs-render-monitor" style="display: block; height: 115px; width: 152px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c3">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="text">
                                <h2>{{$items}}</h2>
                                <span>Items</span>
                            </div>
                        </div>
                        <div class="overview-chart"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                            <canvas id="widgetChart3" height="86" width="114" class="chartjs-render-monitor" style="display: block; height: 115px; width: 152px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c4">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="fas fa-calendar"></i>                            </div>
                            <div class="text">
                                <h2>{{$difference}}</h2>
                                <span>Website launch</span>
                            </div>
                        </div>
                        <div class="overview-chart"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                            <canvas id="widgetChart4" height="48" width="114" class="chartjs-render-monitor" style="display: block; height: 64px; width: 152px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="au-card m-b-30">
                    <div class="au-card-inner">
                        <div class="chartjs-size-monitor"
                            style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <h3 class="title-2 m-b-40">Pie Chart</h3>
                        <canvas id="pieChart" height="422" width="634" class="chartjs-render-monitor"
                            style="display: block; width: 634px; height: 422px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="au-card m-b-30">
                    <div class="au-card-inner">
                        <div class="chartjs-size-monitor"
                            style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <h3 class="title-2 m-b-40">Pie Chart</h3>
                        <canvas id="pieChart1" height="422" width="634" class="chartjs-render-monitor"
                            style="display: block; width: 634px; height: 422px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="au-card m-b-30">
                    <div class="au-card-inner">
                        <div class="chartjs-size-monitor"
                             style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <h3 class="title-2 m-b-40">Pie Chart</h3>
                        <canvas id="pieChart2" height="422" width="634" class="chartjs-render-monitor"
                                style="display: block; width: 634px; height: 422px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="au-card m-b-30">
                    <div class="au-card-inner">
                        <div class="chartjs-size-monitor"
                             style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <h3 class="title-2 m-b-40">Clicks And Views</h3>
                        <canvas id="sales-chart" height="317" width="634" class="chartjs-render-monitor"
                                style="display: block; width: 634px; height: 317px;"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var x, y;
        var a, b;
        var m, n;
        $.get("/chartData", function (data) {
            var array = data.type.original;
            for (let i = 0; i < array.length; i++) {
                if (i == 1) {
                    x = array[i][1];
                } else if (i == 2) {
                    y = array[i][1];
                }
            }
            getChart("pieChart", x, y, "number of found reports", "number of lost reports");
        });
        $.get("/chartData1", function (data) {
            console.log(data);
            var array1 = data;
            // console.log((data.is_found.original)[1])
            for (let i = 0; i < array1.length; i++) {
                if (i == 1) {
                    a = array1[i][1];
                } else if (i == 2) {
                    b = array1[i][1];
                }
            }
            getChart("pieChart1", a, b, "Percentage Of Found People", "Percentage Of Lost People");
        });
        $.get("/chartData2", function (data) {
            console.log(data);
            var array2 = data;
            // console.log((data.is_found.original)[1])
            for (let i = 0; i < array2.length; i++) {
                if (i == 1) {
                    m = array2[i][1];
                } else if (i == 2) {
                    n = array2[i][1];
                }
            }
            getChart("pieChart2", m, n, "Percentage Of lost items", "Percentage Of found items");

        });
        $.get("/twoline", function (data) {
            console.log(data);
            drawTwoLine(data)

        });

        function getChart(id, value1, value2, x, y) {
            try {
                var ctx = document.getElementById(id);
                if (ctx) {
                    ctx.height = 300; //hena kanet 200 w ana zawedtaha
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: [value1, value2],
                                backgroundColor: [
                                    "rgba(0, 123, 255,0.9)",
                                    "rgba(0, 123, 255,0.7)",
                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ],
                                hoverBackgroundColor: [
                                    "rgba(0, 123, 255,0.9)",
                                    "rgba(0, 123, 255,0.7)",
                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ]

                            }],
                            labels: [
                                x,
                                y
                            ]
                        },
                        options: {
                            legend: {
                                position: 'top',
                                labels: {
                                    fontFamily: 'Poppins'
                                }

                            },
                            responsive: true
                        }
                    });
                }


            } catch (error) {
                console.log(error);
            }
        }
    });

    function drawTwoLine(res) {
        try {
            //Sales chart
            var ctx = document.getElementById("sales-chart");
            if (ctx) {
                ctx.height = 300; //kanet 150 w ana mezawedha
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: res.times,
                        type: 'line',
                        defaultFontFamily: 'Poppins',
                        datasets: [{
                            label: "views",
                            data: res.views,
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(220,53,69,0.75)',
                            borderWidth: 3,
                            pointStyle: 'circle',
                            pointRadius: 5,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'rgba(220,53,69,0.75)',
                        }, {
                            label: "clicks",
                            data: res.clicks,
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(40,167,69,0.75)',
                            borderWidth: 3,
                            pointStyle: 'circle',
                            pointRadius: 5,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'rgba(40,167,69,0.75)',
                        }]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            titleFontSize: 12,
                            titleFontColor: '#000',
                            bodyFontColor: '#000',
                            backgroundColor: '#fff',
                            titleFontFamily: 'Poppins',
                            bodyFontFamily: 'Poppins',
                            cornerRadius: 3,
                            intersect: false,
                        },
                        legend: {
                            display: false,
                            labels: {
                                usePointStyle: true,
                                fontFamily: 'Poppins',
                            },
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Month'
                                },
                                ticks: {
                                    fontFamily: "Poppins"
                                }
                            }],
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Value',
                                    fontFamily: "Poppins"

                                },
                                ticks: {
                                    fontFamily: "Poppins"
                                }
                            }]
                        },
                        title: {
                            display: false,
                            text: 'Normal Legend'
                        }
                    }
                });
            }


        } catch (error) {
            console.log(error);
        }

    }
</script>

@endsection
