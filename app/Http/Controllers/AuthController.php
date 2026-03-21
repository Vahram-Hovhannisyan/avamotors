<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // ═══════════════════════════════════════════════════
    //  LOGIN
    // ═══════════════════════════════════════════════════

    public function loginForm()
    {
        if (Auth::check()) return redirect()->route('home');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return Auth::user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->intended(route('home'));
        }

        return back()
            ->withErrors(['email' => 'Неверный e-mail или пароль.'])
            ->onlyInput('email');
    }

    // ═══════════════════════════════════════════════════
    //  REGISTER
    // ═══════════════════════════════════════════════════

    public function registerForm()
    {
        if (Auth::check()) return redirect()->route('home');
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'min:8', 'confirmed'],
            'agree'    => ['accepted'],
        ], [
            'name.required'      => 'Введите ваше имя.',
            'name.max'           => 'Имя не должно превышать 100 символов.',
            'email.required'     => 'Введите e-mail адрес.',
            'email.email'        => 'Введите корректный e-mail адрес.',
            'email.unique'       => 'Этот e-mail уже зарегистрирован. Попробуйте войти.',
            'password.required'  => 'Введите пароль.',
            'password.min'       => 'Пароль должен содержать минимум 8 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
            'agree.accepted'     => 'Необходимо принять условия использования.',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role'     => 'customer',
        ]);

        Auth::login($user);
        event(new Registered($user));

        return redirect()->route('verification.notice');
    }

    // ═══════════════════════════════════════════════════
    //  LOGOUT
    // ═══════════════════════════════════════════════════

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    // ═══════════════════════════════════════════════════
    //  FORGOT PASSWORD
    // ═══════════════════════════════════════════════════

    public function forgotForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotSend(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        $status = Password::sendResetLink(
            $request->only('email'),
            function (User $user, string $token) {
                $resetUrl = route('password.reset', [
                    'token' => $token,
                    'email' => $user->email,
                ]);
                Mail::to($user->email)->send(
                    new ResetPasswordMail($resetUrl, $user->name)
                );
            }
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Ссылка для сброса пароля отправлена на ваш e-mail.')
            : back()->withErrors(['email' => __($status)]);
    }

    // ═══════════════════════════════════════════════════
    //  RESET PASSWORD
    // ═══════════════════════════════════════════════════

    public function resetForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Пароль успешно изменён. Войдите в аккаунт.')
            : back()->withErrors(['email' => __($status)]);
    }

    // ═══════════════════════════════════════════════════
    //  ACCOUNT / PROFILE
    // ═══════════════════════════════════════════════════

    public function profile()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'phone'   => ['nullable', 'string', 'max:20'],
            'city'    => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'email'   => ['required', 'email', 'unique:users,email,' . $user->id],
        ], [
            'name.required'  => 'Введите ваше имя.',
            'email.required' => 'Введите e-mail адрес.',
            'email.email'    => 'Введите корректный e-mail адрес.',
            'email.unique'   => 'Этот e-mail уже используется.',
        ]);

        $user->update($data);

        return back()->with('success', 'Профиль обновлён.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'min:8', 'confirmed'],
        ], [
            'password.min'       => 'Пароль должен содержать минимум 8 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Текущий пароль неверен.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Пароль изменён.');
    }
}
