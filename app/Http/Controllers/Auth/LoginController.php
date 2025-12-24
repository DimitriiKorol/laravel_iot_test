<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Показываем форму логина
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Обрабатываем логин
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Пытаемся залогиниться по полю 'login'
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            return redirect()->intended('/products');
        }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль.',
        ]);
    }

    // Выход
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
