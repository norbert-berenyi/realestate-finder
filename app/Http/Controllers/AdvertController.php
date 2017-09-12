<?php

namespace App\Http\Controllers;

use App\Advert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Advert::all();

        return view('home', compact('ads'));
    }

    public function report($year, $month, $day)
    {
        $from = Carbon::create($year, $month, $day, 0);
        $to = Carbon::create($year, $month, $day, 23, 59);

        $ads = Advert::whereBetween('created_at', [$from, $to])->get()->reverse();

        return view('home', ['ads' => $ads, 'link' => $year . '/' . $month . '/' . $day]);
    }

    public function download($year, $month, $day)
    {
        $from = Carbon::create($year, $month, $day, 0);
        $to = Carbon::create($year, $month, $day, 23, 59);

        $ads = Advert::whereBetween('created_at', [$from, $to])->get();

        \Excel::create('Report', function($excel) use($ads) {

            $excel->sheet('Report', function($sheet) use($ads) {

                $sheet->fromArray($ads);

            });

        })->export('xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
