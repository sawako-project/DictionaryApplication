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
        $simple_auth = $request->input("simple_auth");//
        if($simple_auth && $simple_auth == $password){
            $request->session()->put("simple_password_auth", $password);
            return back();
        }

        //block
        if($password != $request->session()->get("simple_password_auth")){//
			return abort(403, "This page is protected.");
		}

        return $next($request);
/////////////////////////////////////////////

        //  $password = env("SIMPLE_PASSWORD_AUTH");//SIMPLE_PASSWORD_AUTH="inko"
        // //$password = "1234";
        // // $password = "innko";

        // //.envにパスワードがなかったら
        // if(!$password){
        //     return $next($request);
        // }

        // //password check
        // $simple_auth = $request->input("simple_auth");//?simple_auth=1234 simple_auth
        // if($simple_auth && $simple_auth == $password){// 
        //      $request->session()->input("simple_password_auth", $password);//true
        //      return back();
        //     //return redirect("/");
        //     //dd("ok");
        // }
        // // if(false == $request->session()->get("admin_auth")){
		// // 	return redirect("admin/login");
		// // }
        // //return $next($request);

        // //block
        // if($password != $request->session()->get("simple_password_auth")){
		// 	return abort(403, "This page is protected.");
        //     // return redirect("/");
		// }

        // return $next($request);
    }
    
}
