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

            private $user ;
    function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->user = \Auth::user();
    }
    
    public function index()
    {
        $Lt1 = File::where('lantai','1')->whereNotIn('type', ['background'])->orderby('id','desc')->get();
        return view('loket.inputImg.indexImg', compact('Lt1'));
    }

    public function Lt2()
    {
        $Lt2 = File::where('lantai','2')->whereNotIn('type', ['background'])->orderby('id','desc')->get();
        return view('loket.inputImg.indexImgLt2', compact('Lt2'));
    }

    public function Lt3()
    {
        $Lt3 = File::where('lantai','3')->whereNotIn('type', ['background'])->orderby('id','desc')->get();
        return view('loket.inputImg.indexImgLt3', compact('Lt3'));
    }

    public function Lt4()
    {
        $Lt4 = File::where('lantai','4')->whereNotIn('type', ['background'])->orderby('id','desc')->get();
        return view('loket.inputImg.indexImgLt4', compact('Lt4'));
    }

    public function Lt5()
    {
        $Lt5 = File::where('lantai','5')->whereNotIn('type', ['background'])->orderby('id','desc')->get();
        return view('loket.inputImg.indexImgLt5', compact('Lt5'));
    }

    public function Lt6()
    {
        $Lt6 = File::where('lantai','6')->whereNotIn('type', ['background'])->orderby('id','desc')->get();
        return view('loket.inputImg.indexImgLt6', compact('Lt6'));
    }

    public function ImageBg()
    {
        $ImageBg = File::where('type','background')->orderby('id','desc')->get();
        return view('loket.inputImg.indexImgBg', compact('ImageBg'));
    }

    public function ImageBgUnit()
    {
        $ImageBgUnit = File::where('type','background')->orderby('id','desc')->get();
        return view('unit.image.background.index', compact('ImageBgUnit'));
    }

    public function ImgHome()
    {
        $ImgHome = File::where('type','ImgHome')->orderby('id','desc')->get();
        return view('loket.inputImg.indexImgHome', compact('ImgHome'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBg()
    {
        return view('loket.inputImg.inputImgBg');
    }

    public function createBgUnit()
    {
        return view('unit.image.background.inputImgBg');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createImgHome()
    {
        return view('loket.inputImg.createImgHome');
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
            'status'    => 'required',
            'file'      => 'required|file|max:2000'
        ]);
        
        $uploadFile = $request->file('file');
        $path       = $uploadFile->store('public/files');
        $file       = File::create([
            'title' => $request->title ?? $uploadFile->getClientOriginalName(),
            'lantai'    => $request->lantai,
            'type'      => $request->type,
            'status'    => $request->status,
            'filename'  => $path
        ]);
        return redirect()->route('inputImg.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBg(Request $request)
    {
        $this->validate($request,[
            'title'     => 'nullable|min:5',
            'lantai'    => 'required',
            'type'      => 'required',
            'file'      => 'required|file|max:3000'
        ]);
        
        $uploadFile = $request->file('file');
        $path       = $uploadFile->store('public/files');
        $file       = File::create([
            'title' => $request->title ?? $uploadFile->getClientOriginalName(),
            'lantai'    => $request->lantai,
            'type'      => $request->type,
            'filename'  => $path
        ]);
        return redirect()->route('imagebg.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBgUnit(Request $request)
    {
        $this->validate($request,[
            'title'     => 'nullable|min:5',
            'lantai'    => 'required',
            'type'      => 'required',
            'file'      => 'required|file|max:3000'
        ]);
        
        $uploadFile = $request->file('file');
        $path       = $uploadFile->store('public/files');
        $file       = File::create([
            'title' => $request->title ?? $uploadFile->getClientOriginalName(),
            'lantai'    => $request->lantai,
            'type'      => $request->type,
            'filename'  => $path
        ]);
        return redirect()->route('bgunit.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeHome(Request $request)
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
        return redirect()->route('imgHome.view');
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

        return redirect()->route('inputImg.index')->with('message', 'Data Berhasil diubah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = File::findorfail($id);
        $value->delete();
        return redirect()->route('imagebg.view');
    } 
        

    public function destroy2($id)
    {
        $value = File::findorfail($id);
        $value->delete();
        return redirect()->route('loket.inputImg.indexImgLt2');
    }

    public function destroy3($id)
    {
        $value = File::findorfail($id);
        $value->delete();
        return redirect()->route('loket.inputImg.indexImgLt3');
    }

    public function destroy4($id)
    {
        $value = File::findorfail($id);
        $value->delete();
        return redirect()->route('loket.inputImg.indexImgLt5');
    }

    public function destroy6($id)
    {
        $value = File::findorfail($id);
        $value->delete();
        return redirect()->route('loket.inputImg.indexImgLt6');
    }
}
