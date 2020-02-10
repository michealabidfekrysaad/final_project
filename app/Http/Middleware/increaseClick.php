<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class increaseClick
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $value = 0;
        $row = DB::table('visitor')->whereMonth("created_at", "=", now()->month)->whereYear("created_at", "=", now()->year)->first();
        if ($row) {
            $value = $row->click + 1;
            DB::table('visitor')->whereMonth("created_at", "=", now()->month)->whereYear("created_at", "=", now()->year)
                ->update(['click' => $value]);
        } else {
            DB::table('visitor')->insert([
                'click' => 0,
                'viewer' => 0,
                'created_at' => now()
            ]);
            $row = DB::table('visitor')->whereMonth("created_at", "=", now()->month)->whereYear("created_at", "=", now()->year)->first();
            if ($row) {
                $value = $row->click + 1;
                DB::table('visitor')->whereMonth("created_at", "=", now()->month)->whereYear("created_at", "=", now()->year)
                    ->update(['click' => $value]);
            }
        }
        return $next($request);
    }
}
