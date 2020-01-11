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

Route::get('/tours', function () {
    return view('front/tour/tours')->with('activevar','tours')->with('email',"");
});
Route::post('/tours','HomeController@index');

Route::get('/tours/{tourname}', [
    'as' => 'admin.fix-departure.add', 'uses' => 'HomeController@gettourdetail',
 ]);
Route::post('/tour/getmonthsdetail', 'HomeController@getMonthChange');
Route::post('/tour/updaterate', 'HomeController@onDateSelected');
Route::post('/book-now', 'HomeController@booknowRedirect');
Route::get('/book-now', function () {
    return redirect('/tours')->with('email',"");
});
Route::post('/bookConfirm', 'HomeController@store')->name('bookSubmit');


// Route::get('/sydney', function () {
//     return view('front/tour/sydney123')->with('activevar','tours');
// });


// Route::get('/booknow', function () {
//     return view('front/tour/booknow')->with('activevar','tours');
// });

// Route::get('/booking', function () {
//     return view('front/booking')->with('activevar','tours');
// });

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

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
Route::get('/admin/dashboard', [
   'as' => 'admin.dashboard', 'uses' => 'admin\dashboardController@index',
]);

Route::resource('/admin/trip','admin\menuController');
//Route::resource('/admin/trip/{id}/fix-departure','admin\menuController');

Route::get('/admin/departure', [
    'as' => 'admin.fix-departures', 'uses' => 'admin\fixdepartureController@showalltours']);

Route::get('/admin/departure/{id}', [
    'as' => 'admin.fix-departure', 'uses' => 'admin\fixdepartureController@index',
 ]);
 Route::post('/admin/departure/{id}', 'admin\fixdepartureController@getcalenderData');

 Route::get('/admin/departure/{id}/add', [
    'as' => 'admin.fix-departure.add', 'uses' => 'admin\fixdepartureController@index_add',
 ]);
 Route::post('/admin/departure/{id}/add', 'admin\fixdepartureController@updateEventInfo');

 Route::resource('/admin/departure/{id}/gallery','admin\galleryController');
 Route::post('/admin/departure/{id}/gallerys', 'admin\galleryController@getPicsForAjax');
 
//Route::middleware('auth')->group(function () {