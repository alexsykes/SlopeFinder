<?php

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
    return view('home', ['sites' => $sites]);
}
);

// Display about page
Route::get('/about', function () {
    return view('components/about');
}
);


// Display privacy page
Route::get('/privacy', function () {
    return view('components/privacy');
}
);

// Display contact page
Route::get('/contact', function () {
    return view('components/contact');
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
    return view('sitelist', ['sites' => $sites]);
});

//  Process new site data
Route::post('/sites', function() {
//    validate
    request()->validate([
        'site_name' => ['required', 'min:3'],
        'site_description' => ['required'],
        'site_access' => ['required'],
        'site_wind_directions' => ['required'],
        'lat' => ['required', 'numeric', 'decimal:4,8'],
        'lng' => ['required', 'numeric', 'decimal:4,8']
    ]);

    Site::create([
        'site_name' => request('site_name'),
        'near' => request('near'),
        'site_description' => request('site_description'),
        'site_access' => request('site_access'),
        'site_wind_directions' => request('site_wind_directions'),
        'lat'   => request('lat'),
        'lng'   => request('lng'),
        'w3w'   => request('w3w')
    ]);

    return redirect('/');
});

//  Form for site editing
Route::get('sites/create', function () {
    return view('sites.create');
});

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
Route::patch('/sitedetail/{id}', function($id) {
//  Validate
    request()->validate([
        'site_name' => ['required', 'min:3'],
        'site_description' => ['required'],
        'site_access' => ['required'],
        'site_wind_directions' => ['required'],
        'lat' => ['required', 'numeric', 'decimal:4,8'],
        'lng' => ['required', 'numeric', 'decimal:4,8']
    ]);
//    Authorise
//    update
    $user = Auth::user();
    $userid = $user->id;
    $site = Site::findOrFail($id);
    $site->update([
        'site_name' => request('site_name'),
        'near' => request('near'),
        'site_description' => request('site_description'),
        'site_access' => request('site_access'),
        'site_wind_directions' => request('site_wind_directions'),
        'lat'   => request('lat'),
        'lng'   => request('lng'),
        'w3w'   => request('w3w'),
        'updated_by'   => $userid,
    ]);
    return redirect('/auth/profile');
});

// Destroy
Route::delete('/sitedetail/{id}', function($id) {
    $site = Site::findOrFail($id);
    $site->delete();

    return redirect('/sitelist');
});
