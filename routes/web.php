<?php

use Illuminate\Support\Facades\Route;
use App\Models\Site;

Route::get('/', function () {
	return view('home');
}
);
Route::get('/sitelist', function () {

    $sites = Site::latest()->simplePaginate(25);
    return view('sitelist', ['sites' => $sites]);
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/sites', function() {
//    validate

    Site::create([
        'site_name' => request('site_name'),
        'near' => request('near'),
        'site_description' => request('site_description'),
        'site_access' => request('site_access'),
        'site_wind_directions' => request('site_wind_directions'),
        'lat'   => request('lat'),
        'lng'   => request('lng')
    ]);

    return redirect('/sitelist');
});


Route::get('sites/create', function () {
    return view('sites.create');
});

Route::get('/sitedetail/{id}', function($id) {
    $site = Site::find($id);
    return view('sitedetail', ['site' => $site]);
});