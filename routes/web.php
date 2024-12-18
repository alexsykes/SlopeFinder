<?php

use Illuminate\Support\Facades\Route;
use App\Models\Site;

Route::get('/', function () {
	return view('home');
}
);
Route::get('/sitelist', function () {

    $sites = Site::simplePaginate(25);
    return view('sitelist', ['sites' => $sites]);
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/addsite', function () {
    return view('addsite');
});

Route::get('/sitedetail/{id}', function($id) {
    $site = Site::find($id);
    return view('sitedetail', ['site' => $site]);
});
