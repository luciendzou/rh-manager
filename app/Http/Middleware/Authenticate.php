<?php

namespace App\Http\Middleware;

use App\Models\Utilisateurs;
use Illuminate\Http\Request;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('role') && ($request->path() !='/')) {

            return redirect()->route('login')->with('error', 'Vous devez être connecté !');
        }

        if (session()->has('role') && ($request->path() =='/')) {
            $route = session('role');
            return redirect('/'.$route);
        }

        // User is authenticated, allow the request to proceed
        return $next($request)->header('cache-control','no-store, max-age=0, must-revalidate',)
                            ->header('Pragma','no-cache')
                            ->header('Expires','Sat 01 Jan 1990 00:00:00 GMT');
    }
}
