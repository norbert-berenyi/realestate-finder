<?php

namespace App\Http\Controllers;

use App\Advert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdvertController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = auth()->user()->adverts;

        return view('adverts', compact('ads'));
    }

    public function unseen()
    {
        $ads = auth()->user()->adverts()->where('seen', false)->get();

        return view('adverts', compact('ads'));
    }

    public function seen()
    {
        $ads = auth()->user()->adverts()->where('seen', true)->get();

        return view('adverts', compact('ads'));
    }

    public function promising()
    {
        $ads = auth()->user()->adverts()->where([['promising', true], ['seen', true]])->get();

        return view('adverts', compact('ads'));
    }

    public function superPromising()
    {
        foreach (auth()->user()->adverts as $ad)
        {
            if ($ad->superPromising()) $ads[] = $ad;
        }

        if (!isset($ads))
        {
            $ads = [];
        }

        return view('adverts', ['ads' => collect($ads)]);
    }

    public function download()
    {
        $ads = auth()->user()->adverts()->where([['promising', true], ['seen', true]])->get();

        \Excel::create('Report', function($excel) use($ads) {

            $excel->sheet('Report', function($sheet) use($ads) {

                $sheet->fromArray($ads);

            });

        })->export('xlsx');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $advert = Advert::findOrFail($request->id);

        $advert->users()->updateExistingPivot(auth()->user()->id, $request->only(['seen', 'promising']));
        
        return 200;
    }
}
