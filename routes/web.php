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

Route::get('/', [ListingController::class, 'index']);

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
