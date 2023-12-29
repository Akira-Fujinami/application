<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewlyRegistered
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('newly_registered') === true) {
            $request->session()->forget('newly_registered'); // セッションからフラグを削除
            return $next($request);
        }

        return redirect('/loginview'); // アクセス不可の場合はホームにリダイレクト
    }
}
