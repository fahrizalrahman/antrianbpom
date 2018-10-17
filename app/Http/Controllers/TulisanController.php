<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tulisan;
use Auth;
class TulisanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tampilTulisan = Tulisan::all();
        return view('loket.inputTulisan.index', compact('tampilTulisan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loket.inputTulisan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'isi'   => 'required',
            'lantai'   => 'required',
            'float'   => 'required'
        ]);

        $Tulisan = new Tulisan;
        $Tulisan->judul = $request->judul;
        $Tulisan->isi = $request->isi;
        $Tulisan->lantai = $request->lantai;
        $Tulisan->float = $request->float;
        $Tulisan->save();
        return redirect()->route('inputTulisan.index');
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
        $editTulisan = Tulisan::findorfail($id);
        return view('loket.inputTulisan.edit', compact('editTulisan'));
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
        $editTulisan = Tulisan::findorfail($id);
        $editTulisan->judul = $request->judul;
        $editTulisan->isi = $request->isi;
        $editTulisan->save();
        return redirect()->route('inputTulisan.index');
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
