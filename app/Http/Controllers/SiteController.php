<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    //

    public $directions = array("N", "NNE","NE","ENE","E","ESE","SE", "SSE","S","SSW", "SW", "WSW", "W", "WNW", "NW", "NNW");
    public function store() {
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
//        dd(\request()->all());


        $beginIndex = \request()->integer('from');

        $endIndex = \request()->integer('to');
        $end = $directions[$endIndex];
        $begin = $directions[$beginIndex];
//        dd($begin);
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
            'to'   => request()->integer('to'),
            'end'   => $end,
            'begin'   => $begin,
            'updated_by'   => $userid,
        ]);
        return redirect('/auth/profile');
    }

    public function updateFromNotes() {
//        dd(request());
//        $updated_by = Auth()->id();


        $id = request('site_id');
        request()->validate([
            'site_name' => ['required', 'min:3'],
            'site_description' => ['required'],
            'site_access' => ['required'],
//            'site_wind_directions' => ['required'],
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric']
        ]);

        $directions = $this->directions;
//    update site in DB
        $user = Auth::user();
        $userid = $user->id;
        $site = Site::findOrFail($id);

        $dirs = $directions[request('from')] . " to " . $directions[request('to')];


        $beginIndex = \request()->integer('from');
        $endIndex = \request()->integer('to');
        $end = $directions[$endIndex];
        $begin = $directions[$beginIndex];

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
            'to'   => request()->integer('to'),
            'end'   => $end,
            'begin'   => $begin,
            'site_wind_directions'   => $dirs,
            'updated_by'   => $userid,
        ]);

//        Update notes in DB
        $completed = \request()->completed;
        $accepted = \request()->accepted;

        if($completed) {
            foreach ($completed as $noteID) {
                DB::table('notes')->where('id', $noteID)->update(['completed' => 1, 'updated_at' => NOW()]);
            }
        }

        if($accepted) {
            foreach ($accepted as $noteID) {
                DB::table('notes')->where('id', $noteID)->update(['accepted' => 1, 'updated_at' => NOW()]);
            }
        }

        return redirect('/notes');
    }


}