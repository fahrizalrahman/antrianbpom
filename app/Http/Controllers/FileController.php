<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Storage;
class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::all();
        return view('loket.inputImg.indexImg', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loket.inputImg.inputImg');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'     => 'nullable|min:5',
            'lantai'    => 'required',
            'type'      => 'required',
            'file'      => 'required|file|max:2000'
        ]);
        
        $uploadFile = $request->file('file');
        $path       = $uploadFile->store('public/files');
        $file       = File::create([
            'title' => $request->title ?? $uploadFile->getClientOriginalName(),
            'lantai'    => $request->lantai,
            'type'      => $request->type,
            'filename'  => $path
        ]);
        return redirect()->route('inputImg.index');
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
        $updateFile = File::findorfail($id);
        return view('loket.inputImg.editImg', compact('updateFile'));
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
        $editImg = File::findorfail($id);
        $editImg->title = $request->title;
        $editImg->lantai = $request->lantai;
        $editImg->status = $request->status;
        $editImg->type = $request->type;
        $editImg->save();

        
        return redirect()->route('inputImg.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fileHapus = File::findorfail($id);
        $fileHapus->delete();
        dd($fileHapus);

        return redirect()->route('inputImg.index');
    }
}
