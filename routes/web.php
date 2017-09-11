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

Route::get('/', function ()
{
	$ads = App\Advert::all();

    return view('home', compact('ads'));
});

Route::get('/reports/{year}/{month}/{day}', function ($year, $month, $day)
{
	$from = \Carbon\Carbon::create($year, $month, $day, 0);
	$to = \Carbon\Carbon::create($year, $month, $day, 23, 59);

	$ads = App\Advert::whereBetween('created_at', [$from, $to])->get();

	return view('home', ['ads' => $ads, 'link' => $year . '/' . $month . '/' . $day]);
});

Route::get('/reports/download/{year}/{month}/{day}', function ($year, $month, $day)
{
	$from = \Carbon\Carbon::create($year, $month, $day, 0);
	$to = \Carbon\Carbon::create($year, $month, $day, 23, 59);

	$ads = App\Advert::whereBetween('created_at', [$from, $to])->get();

	Excel::create('Report', function($excel) use($ads) {

	    $excel->sheet('Report', function($sheet) use($ads) {

	        $sheet->fromArray($ads);

	    });

	})->export('xlsx');
});
