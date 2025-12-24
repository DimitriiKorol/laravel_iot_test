<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

class BasicController extends Controller
{
    public function home() {
        return view('home');
    }

    public function authpage() {
        return view('authpage');
    }

    public function submit(AuthRequest $request) {
        //$request->validate();

        $user_auth = new User();
        $user_auth->login = $request->input('login');
        $user_auth->password = $request->input('passwd');
        $user_auth->is_admin = $request->input('is_admin') ?? false;
        $user_auth->save();

        return redirect()->route('home');
    }
}
