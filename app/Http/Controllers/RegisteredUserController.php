<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store() {
        $attrs = request()->validate([
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);

        if(request()->has('accept_terms')) {
            $attrs['accept_terms'] = true;
        }
//
//        dd($attrs);

        $user = User::create($attrs);
        Auth::login($user);
        return redirect('/sitelist');
    }

}
