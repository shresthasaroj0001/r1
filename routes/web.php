<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('front/welcome')->with('activevar','');
});

Route::get('/about', function () {
    return view('front/about')->with('activevar','about');
});
Route::get('/faq', function () {
    return view('front/faq')->with('activevar','faq');
});
Route::get('/contact', function () {
    return view('front/contact')->with('activevar','contact');
});

Route::get('/enquiry', function () {
    return view('front/booking')->with('activevar','booking');
});
Route::post('/enquiry', 'bookingController@store')->name('enquirysubmit');

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/airport', function () {
    return view('front/services/airport')->with('activevar','airport');
});
Route::get('/cruise', function () {
    return view('front/services/cruise')->with('activevar','cruise');
});
Route::get('/wedding', function () {
    return view('front/services/wedding')->with('activevar','wedding');
});
Route::get('/hensparty', function () {
    return view('front/services/hensparty')->with('activevar','hensparty');
});
Route::get('/nighthire', function () {
    return view('front/services/nighthire')->with('activevar','nighthire');
});
Route::get('/privatehire', function () {
    return view('front/services/privatehire')->with('activevar','privatehire');
});

//send email

Route::post('/contactus', 'SendEnquiryController@store')->name('contactus');
