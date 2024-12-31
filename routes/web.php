<?php

use App\Models\Club;
use App\Models\Site;
use App\Models\User;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


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



Route::get('test', function () {
    $job = Job::first();
    \App\Jobs\WelcomeUser::dispatch($job);

    return 'Done';
});
//  User registration
Route::get('/register', [RegisteredUserController::class, 'create']) ;
Route::post('/register', [RegisteredUserController::class, 'store']) ;

//  User login
Route::get('/login', [SessionController::class, 'create']) ;
Route::post('/login', [SessionController::class, 'store']) ;
Route::post('/logout', [SessionController::class, 'destroy']);

//User profile
Route::get('auth/profile', function () {
//    $clubs = Auth()->id()->clubs();

    $userID = Auth()->id();
    $userDetails = User::find($userID);

    dd($userDetails);
    return view('auth.profile');
}) ;

Route::get('/club/register', [\App\Http\Controllers\ClubController::class, 'create']) ;
Route::post('/club/register', [\App\Http\Controllers\ClubController::class, 'registerClub']) ;

// Display all sites with pagination
Route::get('/sitelist', function () {

//    $sites = Site::latest()->simplePaginate(25);
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
    $site = Site::findOrFail($id);
    $site->update([
        'site_name' => request('site_name'),
        'near' => request('near'),
        'site_description' => request('site_description'),
        'site_access' => request('site_access'),
        'site_wind_directions' => request('site_wind_directions'),
        'lat'   => request('lat'),
        'lng'   => request('lng'),
        'w3w'   => request('w3w')
    ]);
    return redirect('/sitedetail/' . $site->id);
});

// Destroy
Route::delete('/sitedetail/{id}', function($id) {
    $site = Site::findOrFail($id);
    $site->delete();

    return redirect('/sitelist');
});
