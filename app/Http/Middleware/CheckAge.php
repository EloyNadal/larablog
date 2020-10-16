<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $age = 17)
    {
        /**
         * Para llamar al middleware con parametros
         * Se le llama añadiendo :paramvaule
         *
         * ejemplo
         * $this->middleware('check_age:20');
         */

        if($age < 18){
            redirect()->route('home');
        }

        return $next($request);
    }
}
