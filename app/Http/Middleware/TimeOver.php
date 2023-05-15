<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Fixture;
use Illuminate\Support\Carbon;

class TimeOver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::now();
        if($request->date < $now){
            return redirect('teams')->with('select-error','Time is over to select this team');
        }else{
            $diff = $now->diffInHours($request->date);
           if($diff == 12 || $diff < 12){
            return redirect('teams')->with('select-error','Team selection slot is close please wait for next week');
           }
        }
        return $next($request);
    }
}
