<?php

namespace App\Http\Middleware;

use Closure;

class cekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $hakakses)
    {

        if ($request->user()->hakAkses($hakakses)) {
            return $next($request);
        }
        return abort(503, 'Ooops, Anda tidak memiliki akses untuk membuka halaman ini!');
    }
}
