<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $return_url=urlencode($_SERVER['HTTP_REFERER']);
        $member=$request->session()->get('member','');
        if($member==''){
            return redirect('/login?return_url='.$return_url);
        }

        return $next($request);
    }
}
