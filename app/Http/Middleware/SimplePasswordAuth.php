<?php

namespace App\Http\Middleware;

use Closure;

class SimplePasswordAuth
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

        $password = env("SIMPLE_PASSWORD_AUTH");

        //.envにパスワードがなかったら
        if(!$password){
            return $next($request);

        }

        //password check
        $simple_auth = $request->input("simple_auth");
        if($simple_auth && $simple_auth == $password){
            $request->session()->put("simple_password_auth", $password);//input
            return back();
        }

        //block
        if($password != $request->session()->get("simple_password_auth")){
			return abort(403, "This page is protected.");
		}

        return $next($request);

    }
    
}
