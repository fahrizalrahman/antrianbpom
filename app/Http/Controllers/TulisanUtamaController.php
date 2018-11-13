<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TulisanUtama;

class TulisanUtamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tulisanHome = TulisanUtama::all();
        return view('loket.inputTulisan.utama.index', compact('tulisanHome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loket.inputTulisan.utama.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tulisanUtama = new TulisanUtama;
        $tulisanUtama->judul = $request->judul;
        $tulisanUtama->isi = $request->isi;
        $tulisanUtama->float = $request->float;
        $tulisanUtama->lantai = $request->lantai;
        $tulisanUtama->save();

        return redirect()->route('inputTulisanUtama.index');
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
        $editUtama = TulisanUtama::findorfail($id);
        return view('loket.inputTulisan.utama.edit', compact('editUtama'));
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
        $tulisanUtama = TulisanUtama::find($id);
        $tulisanUtama->judul = $request->judul;
        $tulisanUtama->isi = $request->isi;
        $tulisanUtama->float = $request->float;
        $tulisanUtama->lantai = $request->lantai;
        $tulisanUtama->save();

        return redirect()->route('inputTulisanUtama.index');
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
