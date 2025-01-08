<?php

use App\Http\Controllers\SiteController;
use App\Models\Club;
use App\Models\Site;
use App\Models\User;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ClubController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Display home page
Route::get('/', function () {
    $sites = Site::all();
    $randomSite = Site::inRandomOrder()->first();
    return view('home', ['sites' => $sites, 'randomSite' => $randomSite]);
}
);

// Display about page
Route::get('/about', function () {
    return view('static/about');
}
);
// Display about page
Route::get('/test', function () {
    return view('/components/newlayout');
}
);

// Display about page
Route::get('/terms', function () {
    return view('static/terms');
}
);


// Display privacy page
Route::get('/privacy', function () {
    return view('static/privacy');
}
);

// Display contact page
Route::get('/contact', function () {
    return view('static/contact');
}
);

// Display contact page
Route::get('/clublist', function () {
    $clubs = Club::orderBy('name')->get();
    return view('club.listing', ['clubs' => $clubs]);
});
Route::get('/register', [RegisteredUserController::class, 'create']) ;
Route::post('/register', [RegisteredUserController::class, 'store']) ;

//  User login
Route::get('/login', [SessionController::class, 'create']) ;
Route::post('/login', [SessionController::class, 'store']) ;
Route::post('/logout', [SessionController::class, 'destroy']);

//User profile
Route::get('auth/profile', function () {
    return view('auth.profile');
}) ;

Route::get('/club/register', [ClubController::class, 'create']) ;
Route::post('/club/register', [ClubController::class, 'registerClub']) ;
Route::get('/club/edit', [ClubController::class, 'update']) ;
Route::get('/club/update/{id}', function($id) {
    $club = Club::find($id);
    return view('club.update', ['club' => $club]);
});


Route::patch('/club/update/{id}', [ClubController::class, 'update']) ;

// Display all sites with pagination
Route::get('/sitelist', function () {
    $sites = Site::orderBy('site_name')->simplePaginate(30);
    $allSites = Site::all();
    return view('sitelist', ['sites' => $sites, 'allSites' => $allSites]);
});

//  Process new site data

//  Form for site editing
Route::get('sites/create', function () {
    return view('sites.create');
});
Route::post('sites/create', [SiteController::class, 'store']);

// Display data for a single site
Route::get('/sitedetail/{id}', function($id) {
    $site = Site::find($id);
    return view('sitedetail', ['site' => $site]);
});

// Display data for a single site
Route::get('/sites/{id}/edit', function($id) {
    $site = Site::find($id);
    return view('sites.edit', ['site' => $site]);
});

// Update
Route::patch('/sitedetail/{id}', [SiteController::class, 'update'] );

// Destroy
Route::delete('/sitedetail/{id}', function($id) {
    $site = Site::findOrFail($id);
    $site->delete();

    return redirect('/sitelist');
});
