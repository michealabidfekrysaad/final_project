<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Support\Facades\DB;

class MapsController extends Controller
{
    public function gmaps()
    {
        $results = Report::with('city')
            ->where('type', '=', 'lost')
            ->where('is_found', '=', '0')
            ->select('city_id', DB::raw('count(*) as total'))
            ->groupBy('city_id')
            ->get();
        return view('gmaps', ['results' => $results]);
    }
}
