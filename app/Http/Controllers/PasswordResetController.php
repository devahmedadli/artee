<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{
    public function forgotPasswordPage()
    {
        return view('auth.customer.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordPage($token)
    {
        // check if token is valid
        $token = DB::table('password_reset_tokens')->where('token', $token)->first();
        if (!$token) {
            return redirect()->route('forgot-password')->with('error', __('Invalid token'));
        }
        // check if token is expired
        if ($token->created_at->diffInMinutes(now()) > 15) {
            return redirect()->route('forgot-password')->with('error', __('Token expired'));
        }
        // check if email is valid
        $user = User::where('email', $token->email)->first();
        if (!$user) {
            return redirect()->route('forgot-password')->with('error', __('Invalid email'));
        }
        // check user role
        // return reset password page depending on user role
        if ($user->role === 'customer') {
            return view('auth.customer.reset-password', compact('token'));
        }
        if ($user->role === 'admin') {
            return view('auth.admin.reset-password', compact('token'));
        }
        if ($user->role === 'freelancer') {
            return view('auth.freelancer.reset-password', compact('token'));
        }
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return back()->withErrors(['email' => [__($status)]]);
        }

        $loginRoutes = [
            'customer'      => 'customer.login',
            'admin'         => 'admin.login',
            'freelancer'    => 'freelancer.login',
        ];

        $user = User::where('email', $request->email)->first();
        $loginRoute = $loginRoutes[$user->role] ?? 'login';

        return redirect()->route($loginRoute)->with('success', __($status));
    }
}
