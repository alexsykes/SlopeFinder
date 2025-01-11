<?php

namespace App\Http\Controllers;

use App\Mail\newMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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


        $attrs['accept_terms'] = request()->has('accept_terms');
        $attrs['user_id'] = 0;

        $user = User::create($attrs);

        Mail::to($user)->queue(
            new newMember($user)
        );

        Auth::login($user);
        return redirect('/sitelist');
    }





}
