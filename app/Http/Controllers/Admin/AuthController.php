<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect()->back()->with(['success' => 'Anda sudah login']);
        }
        return view('admin.auth.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home')->withSuccess('Anda berhasil login.');
        }

        return back()->withErrors([
            'email' => 'Email or password do not match our records.',
        ])->onlyInput('email');
    }

    public function registerForm()
    {
        return view('admin.auth.register');
    }

    public function registerAction(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ], [
            'name.required' => "Input nama diperlukan.",
            'email.required' => "Input email diperlukan.",
            'email.email' => "Email tida berupa alamat email.",
            'email.unique' => "Email sudah terdaftar..",
            'password.required' => "Password diperlukan.",
            'password.confirmed' => "Password dan confirmation tidak match."
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        event(new Registered($user));

        $credentials = $request->only('email', 'password');

        Auth::attempt($credentials);

        $request->session()->regenerate();

        return redirect()->route('verification.notice');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home.index')->withSuccess('Anda berhasil logout.');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['success' => $status])
                    : back()->withErrors(['email' => $status]);
    }

    public function resetPasswordForm(string $token)
    {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
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

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', $status)
                    : back()->withErrors(['email' => [$status]]);
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->password = $request->input('password');
            $user->save();

            return redirect()->back()->withSuccess('Password berhasil diganti.');
        }

        return redirect()->back()->withErrors(['current_password' => 'Password yang anda berikan salah.'])->withInput();
    }
}
