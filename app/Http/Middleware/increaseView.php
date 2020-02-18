<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class increaseView
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
        $row = DB::table('visitors')->whereMonth("created_at", "=", now()->month)->whereYear("created_at", "=", now()->year)->first();
        if ($row) {
            $value = $row->viewer + 1;
            DB::table('visitors')->whereMonth("created_at", "=", now()->month)->whereYear("created_at", "=", now()->year)
                ->update(['viewer' => $value]);
        } else {
            DB::table('visitors')->insert([
                'click' => 0,
                'viewer' => 0,
                'created_at' => now()
            ]);
            $row = DB::table('visitors')->whereMonth("created_at", "=", now()->month)->whereYear("created_at", "=", now()->year)->first();
            if ($row) {
                $value = $row->viewer + 1;
                DB::table('visitors')->whereMonth("created_at", "=", now()->month)->whereYear("created_at", "=", now()->year)
                    ->update(['viewer' => $value]);
            }
        }
        return $next($request);
    }
}
