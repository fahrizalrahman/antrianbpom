<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sidebar;
use File;
use Image;
use Session;

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
            'gambar' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
         ]);

        $create_banner  = Sidebar::create([
            'title'    => $request->title,
            'lantai'    => $request->lantai
        ]);   


            if ($request->hasFile('gambar')) {
                // Mengambil file yang diupload
                $gambar          = $request->file('gambar');
                $uploaded_gambar_banner = $gambar;
                // mengambil extension file
                $extension = $uploaded_gambar_banner->getClientOriginalExtension();
                // membuat nama file random berikut extension
                $filename     = str_random(40) . '.' . $extension;
                $image_resize = Image::make($gambar->getRealPath());
                $image_resize->fit(450,150);
                $image_resize->save(public_path('img/' . $filename));
                // hapus gambar_banner_home lama, jika ada
                if ($create_banner->gambar) {
                    $old_gambar_banner = $create_banner->gambar;
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'gambar_banner_produk'
                    . DIRECTORY_SEPARATOR . $create_banner->gambar;
                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                    }
                }
                $create_banner->gambar = $filename;
                $create_banner->save();
            }

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil Menambah Gambar"
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
        $this->validate($request, [
            'gambar' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
         ]); 

        $update_gambar = Sidebar::find($id);
        $update_gambar->update([
            'title'    => $request->title,
            'lantai'    => $request->lantai
        ]);


            if ($request->hasFile('gambar')) {
                // Mengambil file yang diupload
                $gambar          = $request->file('gambar');
                $uploaded_gambar_banner = $gambar;
                // mengambil extension file
                $extension = $uploaded_gambar_banner->getClientOriginalExtension();
                // membuat nama file random berikut extension
                $filename     = str_random(40) . '.' . $extension;
                $image_resize = Image::make($gambar->getRealPath());
                $image_resize->fit(450,150);
                $image_resize->save(public_path('img/' . $filename));
                // hapus gambar_banner_home lama, jika ada
                if ($update_gambar->gambar) {
                    $old_gambar_banner = $update_gambar->gambar;
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'gambar_banner_produk'
                    . DIRECTORY_SEPARATOR . $update_gambar->gambar;
                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                    }
                }
                $update_gambar->gambar = $filename;
                $update_gambar->save();
            }

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil Menambah Gambar"
            ]); 
        return redirect()->route('inputImgSid.index');
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
