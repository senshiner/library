<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Demo showcase: bila DEMO_AUTO_LOGIN=true (hanya di hosting demo),
 * pengunjung langsung masuk sebagai akun demo tanpa form login.
 *
 * - Hanya untuk request GET (POST login/logout tidak disentuh).
 * - Route auth (login, register, reset password, verifikasi email,
 *   konfirmasi password) dikecualikan supaya logout mendarat di
 *   form login dan tidak langsung login lagi.
 * - Bila user demo belum ada di database (mis. seed belum jalan),
 *   middleware diam saja dan alur login normal yang berlaku.
 */
class AutoLoginDemo
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            config('app.demo_auto_login')
            && ! Auth::check()
            && $request->isMethod('get')
            && ! $request->routeIs([
                'login',
                'logout',
                'register',
                'password.request',
                'password.email',
                'password.reset',
                'password.store',
                'verification.notice',
                'verification.verify',
                'verification.send',
                'password.confirm',
            ])
        ) {
            $demo = User::where('email', 'demo@example.com')->first();

            if ($demo) {
                Auth::login($demo);
            }
        }

        return $next($request);
    }
}
