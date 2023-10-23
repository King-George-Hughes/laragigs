<?php

use App\Http\Controllers\ListingController;
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
Route::get('/listings/create', [ListingController::class, 'create']);

// Store Listing 
Route::post('/listings', [ListingController::class, 'store']);

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

// Update Listing
Route::patch('/listings/{listing}', [ListingController::class, 'update']);

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

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