<?php

namespace App\Http\Middleware;

use Closure;

class OnlyHttps
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

        //return $next($request);
        // if(auth()->check() && auth()->user()->role === 'admin') {

        //     return $next($request);
    
        // }

        //本番かつsecure()ではなかったら->https://ではなかったら
        // 

        // if(!$request->secure() && env('APP_ENV') === 'production') {//production

        //     //https://にリダイレクト
        //     return redirect()->secure($request->getRequestUri(), 301);
            
        // }
        // 
        
        //もう一つの書き方
        // if (!$request->secure() && !str_contains($request->getRequestUri(), '/podcasts/rss')) {
        //     return redirect()->secure($request->getRequestUri(), 301);
        // }
        // //もう一つの書き方
        // if (preg_match('/.+\\/$/', $request->getRequestUri())) {
        //     return Redirect::to(rtrim($request->getRequestUri()), 301);
        // }
    
        //abort(403, '管理者権限がありません。');
        //return redirect('/');
        return $next($request);

        ///////////////////////////////

        // $onlyHttpsDomain = env("ONLY_HTTPS_DOMAIN");
        //  //.envにパスワードがなかったら
        //  if(!$onlyHttpsDomain){
        //     return $next($request);
        // }

        // //password check
        // $only_https = $request->input("only_https");
        // if($only_https && $only_https == $onlyHttpsDomain){
        //     $request->session()->put("only_https_domain", $onlyHttpsDomain);
        //     return back();
        // }

        // //block
        // if($onlyHttpsDomain != $request->session()->get("only_https_domain")){
		// 	return abort(403, "This page is protected.");
		// }

        // return $next($request);
    }
}
