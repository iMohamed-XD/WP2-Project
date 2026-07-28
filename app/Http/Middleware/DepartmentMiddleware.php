<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DepartmentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // dd([
        //     'url_department' => $request->segment(1),
        //     'user_department_id' => $user->department_id,
        //     'user_department_name' => $user->department->department,
        // ]);
        if (!$user) {
            abort(403, "Yor are not Logged in.");
        }
        $requiredDepartment = $request->segment(1);
        if ($user->department->department !== $requiredDepartment) {
            abort(403, 'You do not have access to this department.');
        }
        return $next($request);
    }
}
