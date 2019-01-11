<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GambarUtama;
use File;
use Image;
use Session;

class GambarUtamaController extends Controller
{
    private $user ;
    function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->user = \Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gambar_utama = GambarUtama::orderby('id','desc')->get();
        return view('loket.inputImg.indexImg', compact('gambar_utama'));
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
        $this->validate($request, [
            'gambar' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
         ]);

        $create_banner  = GambarUtama::create([
            'judul_gambar'    => $request->judul_gambar,
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

            return redirect()->route('gambar-utama.index');  
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
        $edit_gambar = GambarUtama::findorfail($id);
        return view('loket.inputImg.edit', compact('edit_gambar'));
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

        $update_gambar = GambarUtama::find($id);
        $update_gambar->update([
            'judul_gambar'    => $request->judul_gambar,
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
                "message"=>"Berhasil Mengupdate Gambar"
            ]); 

            return redirect()->route('gambar-utama.index'); 
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
