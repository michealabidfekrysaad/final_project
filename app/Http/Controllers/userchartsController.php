<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Spatie\Analytics\Period;
use Analytics;

class userchartsController extends Controller
{
    public function index(){
    $chart_options = [
        'chart_title' => 'Users by months',
        'report_type' => 'group_by_date',
        'model' => 'App\User',
        'group_by_field' => 'created_at',
        'group_by_period' => 'month',
        'chart_type' => 'bar',
    
    ];

    $chart1 = new LaravelChart($chart_options);
    
    return view('/usercharts', compact('chart1'));
}
function lineChart(){
    $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
    dd($analyticsData);
}
// header( "Refresh:5; url=''");
