@extends('layouts.AdminPanel.page')

@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">
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
                        <h3 class="title-2 m-b-40">Yearly Sales</h3>
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
        $( document ).ready(function() {
            var x,y;
            var a,b;
            var m,n;
            $.get("/chartData", function (data) {
                var array = data.type.original
                for (let i = 0; i < array.length; i++) {
                    if (i == 1) {
                        x = array[i][1];
                    } else if (i == 2) {
                        y = array[i][1];
                    }
                }
                getChart("pieChart",x,y,"number of found reports","number of lost reports");
            })
            $.get("/chartData1", function (data) {
                console.log(data);
                var array1 = data
                // console.log((data.is_found.original)[1])
                for (let i = 0; i < array1.length; i++) {
                    if (i == 1) {
                        a = array1[i][1];
                    } else if (i == 2) {
                        b = array1[i][1];
                    }
                }
                getChart("pieChart1",a,b,"Percentage Of Found People","Percentage Of Lost People");
            })
                $.get("/chartData2", function (data) {
                    console.log(data);
                    var array2 = data
                    // console.log((data.is_found.original)[1])
                    for (let i = 0; i < array2.length; i++) {
                        if (i == 1) {
                            m = array2[i][1];
                        } else if (i == 2) {
                            n = array2[i][1];
                        }
                    }
                    getChart("pieChart2",m,n,"Percentage Of Found items","Percentage Of lost items");

                });
            function getChart(id,value1,value2,x,y) {
                try {
                    var ctx = document.getElementById(id);
                    if (ctx) {
                        ctx.height = 300; //hena kanet 200 w ana zawedtaha
                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                datasets: [{
                                    data: [value1,value2],
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
    </script>

    @endsection
