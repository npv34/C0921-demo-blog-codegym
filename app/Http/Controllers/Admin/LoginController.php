<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function showFormLogin() {
        return view('admin.pages.login');
    }

    function login(Request $request) {

        $email = $request->email;
        $password = $request->password;

        $data = [
            'email' => $email,
            'password' => $password
        ];

        if (!Auth::attempt($data)) {
            session()->flash('error-login', 'Tài khoản không đúng!');
            return redirect()->route('admin.showFormLogin');
        }

        return redirect()->route('admin.showDashboard');
    }

    function logout() {
        Auth::logout();
        return redirect()->route('admin.showFormLogin');
    }
}
