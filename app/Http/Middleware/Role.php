<?php

namespace App\Http\Middleware;

use Closure;


class Role
{

    protected $hierarchy = [
        'administrador' => 1,
        'usuario' => 2,

    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();

    

        if (isset($user->id_role))
        {
            if ($user->id_role == $this->hierarchy[$role])
            {
                return $next($request);
            }
            else
            {

                return redirect()->guest('login');

            }
        }
        else
        {

            return redirect()->guest('login');

        }
    }
}
