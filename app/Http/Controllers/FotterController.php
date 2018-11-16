<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Footer;
class FotterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $user ;
    function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->user = \Auth::user();
    }

    public function index()
    {
        $imgFooter = Footer::all();
        return view('loket.inputImg.footer.indexFooter',compact('imgFooter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loket.inputImg.footer.inputFooter');
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
            'title'     => 'nullable|min:5',
            'float'     => 'required',
            'lantai'    => 'required',
            'file'      => 'required|file|max:2000'
        ]);

        $upload = $request->file('file');
        $path   = $upload->store('public/files');
        $file   = Footer::create([
            'title'     => $request->title ?? $uploadFile->getClientOriginalName(),
            'float'     => $request->float,
            'lantai'    => $request->lantai,
            'filename'  => $path 
        ]);
        return redirect()->route('inputImgFoot.index');
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
        $editFoot = Footer::findorfail($id);
        return view('loket.inputImg.footer.editFooter', compact('editFoot'));
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
        $editFoot = Footer::findorfail($id);
        $editFoot->title = $request->title;
        $editFoot->float = $request->float;
        $editFoot->lantai = $request->lantai;
        $editFoot->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = Footer::findorfail($id);
        $value->delete();
        return redirect()->route('inputImgFoot.index');
    }
}
