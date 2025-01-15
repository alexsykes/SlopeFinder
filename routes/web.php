<?php

use App\Http\Controllers\SiteController;
use App\Models\Club;
use App\Models\Site;
use App\Models\Note;
use App\Models\User;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ClubController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;



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

//  Lost password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);

})->middleware('guest')->name('password.email');



Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user,string $password) use ($request) {  // is 'use' necessary>
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect('login')->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);

}) ->middleware('guest')->name('password.update') ;




//  User login
Route::get('/login', [SessionController::class, 'create']) ;
Route::post('/login', [SessionController::class, 'store']) ;
Route::post('/logout', [SessionController::class, 'destroy']);

//User profile
Route::get('auth/profile', function () {
    return view('auth.profile');
})->middleware(['auth', 'verified']);

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

//  Notes
Route::get('notes',  [NoteController::class, 'list']) ;
Route::post('notes/store', [NoteController::class, 'store']) ;
Route::get('notes.suggest/{id}', function ($id) {
    $site = Site::find($id);
    return view('notes.sitesuggest', ['site' => $site]);
})->middleware(['auth', 'verified']);


//  Form for site editing
Route::get('sites/create', function () {
    return view('sites.create');
});
Route::post('sites/create', [SiteController::class, 'store']);
Route::post('/site/updateFromNotes', [SiteController::class, 'updateFromNotes']);
//Route::post('/site/updateFromNotes', function() {
//    dd(request());
//});

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

// Display data for a single site
Route::get('/site/processnotes/{id}', function($id) {

    $site = Site::find($id);
    return view('sites.processnotes', ['site' => $site]);
});

// Update
Route::patch('/sitedetail/{id}', [SiteController::class, 'update'] );

// Destroy
Route::delete('/sitedetail/{id}', function($id) {
    $site = Site::findOrFail($id);
    $site->delete();

    return redirect('/sitelist');
});



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


// Display contact page
Route::get('/auth/verified', function () {
    return view('auth/verified');
}
);
// Display contact page
Route::get('/auth/verify-email', function () {
    return view('auth/verify-email');
}
);


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');