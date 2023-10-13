<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nick;
use App\Models\Gallery;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get_images = $request->images;
        $nick_id = $request->nick_id;
        $nick = Nick::find($nick_id);
        if($get_images){
            foreach($get_images as $key => $img){
                $path = "uploads/gallery/";
                $get_name_images = $img->getClientOriginalName();
                $name_images = current(explode('.', $get_name_images));
                $new_images = $name_images . rand(0, 99) . '.' . $img->getClientOriginalExtension();
                $img->move($path, $new_images);
               $gallery = new Gallery();
               $gallery->title = $nick->title;
               $gallery->nick_id = $nick_id;
               $gallery->images = $new_images;
               $gallery->save();
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::where('nick_id', $id)->orderBy('id','DESC')->get();
        return view('admin.gallery.index', compact('gallery'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $path = 'uploaos/gallery/' . $gallery->images;
        if (file_exists($path)){
            unlink($path);
        }
        $gallery->delete();
        return redirect()->back();
    }
}
