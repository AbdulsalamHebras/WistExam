<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\CommantController;
use Illuminate\Support\Facades\Route;
use App\Models\Package;
use App\Models\Activity;
use App\Models\Deal;
use App\Models\Commant;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $allPackages = Package::all();
    $alldeals = deal::all();
    $allActivities = Activity::all();
    $allCommant = Commant::orderBy('created_at', 'desc')->take(3)->get();
    return view(
        'dashboard',
        ['allPackages' => $allPackages, 'alldeals' => $alldeals, 'allActivities' => $allActivities, 'allCommant' => $allCommant]
    );
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/package/add', [PackageController::class, 'create'])->name('package.add');
    Route::post('/package/add', [PackageController::class, 'store'])->name('package.store');
    Route::get('/package/edit/{id}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('/package/edit/{id}', [PackageController::class, 'update'])->name('package.update');
    Route::get('/package/delete/{id}', [PackageController::class, 'delete'])->name('package.delete');
    Route::get('/activity/add', [ActivityController::class, 'create'])->name('activity.add');
    Route::post('/activity/add', [ActivityController::class, 'store'])->name('activity.store');
    Route::get('/activity/edit/{id}', [ActivityController::class, 'edit'])->name('activity.edit');
    Route::post('/activity/edit/{id}', [ActivityController::class, 'update'])->name('activity.update');
    Route::get('/activity/delete/{id}', [ActivityController::class, 'delete'])->name('activity.delete');
    Route::get('/deal/add', [DealController::class, 'create'])->name('deal.add');
    Route::post('/deal/add', [DealController::class, 'store'])->name('deal.store');
    Route::get('/deal/edit/{id}', [DealController::class, 'edit'])->name('deal.edit');
    Route::post('/deal/edit/{id}', [DealController::class, 'update'])->name('deal.update');
    Route::get('/deal/delete/{id}', [DealController::class, 'delete'])->name('deal.delete');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/about', function () {
        return view('about');
    });
    Route::get('/packages', function () {
        $allPackages = Package::all();
        return view('packages', ['allPackages' => $allPackages]);
    });
    Route::get('/contact', function () {
        return view('contact');
    });
});
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/commant/add', [CommantController::class, 'create'])->name('commant.add');
    Route::post('/commant/add', [CommantController::class, 'store'])->name('commant.store');

});
require __DIR__ . '/auth.php';
