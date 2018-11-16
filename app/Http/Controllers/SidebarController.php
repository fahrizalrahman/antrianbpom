<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sidebar;
use storage;

class SidebarController extends Controller
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
        $sidebar = Sidebar::all();
        return view('loket.inputImg.sidebar.indexSid',compact('sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loket.inputImg.sidebar.inputSidebar');
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
            'lantai'    => 'required',
            'file'      => 'required|file|max:2000'
        ]);

        $upload = $request->file('file');
        $path   = $upload->store('public/files');
        $file   = Sidebar::create([
            'title'     => $request->title ?? $uploadFile->getClientOriginalName(),
            'lantai'    => $request->lantai,
            'filename'  => $path
        ]);

        return redirect()->route('inputImgSid.index');
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
        $editSid = Sidebar::findorfail($id);
        return view('loket.inputImg.sidebar.editSidebar', compact('editSid'));
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
        $editSid = Sidebar::findorfail($id);
        $editSid->title = $request->title;
        $editSid->lantai = $request->lantai;
        // $editSid->file = $request->file;
        $editSid->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = Sidebar::findorfail($id);
        $value->delete();
        return redirect()->route('inputImgSid.index');
    }
}
