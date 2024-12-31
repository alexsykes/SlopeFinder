<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{
    //
    public function create() {
        return view('club.register');
    }

    public function registerClub() {
        $user = Auth::user();

        $attrs = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'contact_name' => 'required',
            'contact_email' =>  ['required', 'email', 'max:254'],
        ]);
        $attrs['user_id'] = $user->id;

        Club::create($attrs);
        return redirect( '/');
    }
}
