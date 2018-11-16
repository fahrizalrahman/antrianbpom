<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BannerMobile;
use Image;
use Session;
use File;

class BannerMobileController extends Controller
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
        $banner_mobile = BannerMobile::select()->orderby('id','desc');
        return view('banner_mobile.index', compact('banner_mobile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner_mobile.create');
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
            'gambar_banner' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
         ]);

        $create_banner  = BannerMobile::create([
            'judul_banner'    => $request->judul_banner
        ]);   


            if ($request->hasFile('gambar_banner')) {
                // Mengambil file yang diupload
                $gambar_banner          = $request->file('gambar_banner');
                $uploaded_gambar_banner = $gambar_banner;
                // mengambil extension file
                $extension = $uploaded_gambar_banner->getClientOriginalExtension();
                // membuat nama file random berikut extension
                $filename     = str_random(40) . '.' . $extension;
                $image_resize = Image::make($gambar_banner->getRealPath());
                $image_resize->fit(450,150);
                $image_resize->save(public_path('gambar_banner/' . $filename));
                // hapus gambar_banner_home lama, jika ada
                if ($create_banner->gambar_banner) {
                    $old_gambar_banner = $create_banner->gambar_banner;
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'gambar_banner_produk'
                    . DIRECTORY_SEPARATOR . $create_banner->gambar_banner;
                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                    }
                }
                $create_banner->gambar_banner = $filename;
                $create_banner->save();
            }

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil Menambah Banner"
            ]); 

            return redirect()->route('banner-mobile.index');     
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
        $edit_banner = BannerMobile::findorfail($id);
        return view('banner_mobile.edit', compact('edit_banner'));
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
            'gambar_banner' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
         ]);

        $update_banner = BannerMobile::find($id);
        $update_banner->update([
            'judul_banner'      => $request->judul_banner
        ]);

        if ($request->hasFile('gambar_banner')) {
                // Mengambil file yang diupload
                $gambar_banner          = $request->file('gambar_banner');
                $uploaded_gambar_banner = $gambar_banner;
                // mengambil extension file
                $extension = $uploaded_gambar_banner->getClientOriginalExtension();
                // membuat nama file random berikut extension
                $filename     = str_random(40) . '.' . $extension;
                $image_resize = Image::make($gambar_banner->getRealPath());
                $image_resize->fit(450,150);
                $image_resize->save(public_path('gambar_banner/' . $filename));
                // hapus gambar_banner_home lama, jika ada
                if ($update_banner->gambar_banner) {
                    $old_gambar_banner = $update_banner->gambar_banner;
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'gambar_banner'
                    . DIRECTORY_SEPARATOR . $update_banner->gambar_banner;
                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                    }
                }
                $update_banner->gambar_banner = $filename;
                $update_banner->save();
            }


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Banner"
        ]);
            
            return redirect()->route('banner-mobile.index'); 
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
