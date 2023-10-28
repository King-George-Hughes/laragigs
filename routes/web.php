<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Listing Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing 
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::patch('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Show Mange Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Users
Route::get('/login', [UserController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Store User
Route::post('/users', [UserController::class, 'store']);

// Login User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Logout User
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// //  OR
// Route::get('/listings/{id}', function($id){
//     $listing = Listing::find($id);
//     if ($listing) {
//         return view('listing', ['listing' => $listing]);
//     }else{
//         abort('404');
//     }
// });

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/hello', function () {
//     return 'Another Funny Page';
// });

// Route::get('/post/{id}', function ($id) {
//     return 'Post: ' . $id;
// });