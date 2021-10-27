<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $check = User::where('id',Auth::user()->id)->first();
            if ($check->level != 1) {
                 // return redirect()->route('dashboard.index');
                 return redirect()->back()->with('message_err','Bạn đã đăng nhập!');
            }else{
                 return redirect()->back()->with('message_err','Bạn đã đăng nhập!');
            }
        }
        return $next($request);
        
    }
}
