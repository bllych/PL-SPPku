<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if ($user === null) {
            return redirect()->route('login');
        }

        if ($user->role !== 'admin' && ! in_array($user->role, $roles, true)) {
            abort(403);
        }

        if ($user->role === 'student' && in_array('student', $roles, true)) {
            $student = $user->student;

            if ($student === null) {
                abort(403);
            }

            $requestedStudentId = $request->route('id');

            if ($requestedStudentId !== null && (int) $requestedStudentId !== $student->id) {
                abort(403);
            }
        }

        return $next($request);
    }
}
