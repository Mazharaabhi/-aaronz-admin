<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $operation, $name)
    {

        if(CheckCompanyPermission($name, $operation) == 1)
        {
            return $next($request);
        }
        // else
        // {
        //     return redirect()->back();
        // }
        abort(404);
    }
}
