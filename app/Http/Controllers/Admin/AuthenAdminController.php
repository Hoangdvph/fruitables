<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenAdminController extends Controller
{
    //

    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function handleLogin()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();


            //chỉ định biến này là một đối tượng của user

            /**
             * @var User $user
             */

            $user = Auth::user();

            if($user->isAdmin()){
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('client.index');

            
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showFormRegister()
    {
        return view('auth.register');
    }
    public function handleregister()
    {
        $data = request()->validate([
            'name'       => 'required',
            'email'       => 'required|email|unique:users',
            'password'       => 'required|confirmed',
        ]);

        // dd($data);

        $user = User::query()->create($data);

        Auth::login($user);

        request()->session()->regenerate();

        return redirect()->route('client.index');
    }
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();


        return redirect()->route('client.index');
    }
    

    public function logoutAdmin()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();


        return redirect()->route('auth.login');
    }
}
