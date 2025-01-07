<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    //
    public function store() {
//                dd(request()->all());
        $created_by = Auth()->id();
        request()->validate([
            'site_name' => ['required', 'min:3'],
            'site_description' => ['required'],
            'site_access' => ['required'],
            'site_wind_directions' => ['required'],
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric']
        ]);

        Site::create([
            'site_name' => request('site_name'),
            'near' => request('near'),
            'site_description' => request('site_description'),
            'site_access' => request('site_access'),
            'site_wind_directions' => request('site_wind_directions'),
            'lat'   => request('lat'),
            'lng'   => request('lng'),
            'w3w'   => request('w3w'),
            'created_by' => $created_by,
        ]);
        return redirect('/auth/profile');
    }

    public function update($id) {

        $directions = array("N", "NNE","NE","ENE","E","ESE","SE", "SSE","S","SSW", "SW", "WSW", "W", "WNW", "NW", "NNW");
        //  Validate
        request()->validate([
            'site_name' => ['required', 'min:3'],
            'site_description' => ['required'],
            'site_access' => ['required'],
            'lat' => ['required', 'numeric', 'decimal:4,8'],
            'lng' => ['required', 'numeric', 'decimal:4,8'],
        ]);

//    Authorise
//    update
        $user = Auth::user();
        $userid = $user->id;
        $site = Site::findOrFail($id);

        $dirs = $directions[request('from')] . " to " . $directions[request('to')];
        $site->update([
            'site_name' => request('site_name'),
            'near' => request('near'),
            'site_description' => request('site_description'),
            'site_access' => request('site_access'),
//        'site_wind_directions' => $dirs,
            'lat'   => request('lat'),
            'lng'   => request('lng'),
            'w3w'   => request('w3w'),
            'from'   => request('from'),
            'to'   => request('to'),
            'site_wind_directions'   => $dirs,
            'updated_by'   => $userid,
        ]);
        return redirect('/auth/profile');
    }
}