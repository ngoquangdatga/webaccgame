<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videos;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Videos::orderBy('id', 'DESC')->paginate(15);
        return view('admin.videos.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $videos = new Videos();
        $videos->title = $data['title'];
        $videos->link = $data['link'];
        $videos->slug = $data['slug'];
        $videos->description= $data['description'];
        $videos->status = $data['status'];
        

        $get_images = $request->images;
        
        if($get_images){
            
            $path = "uploads/videos/";
            $get_name_images = $get_images->getClientOriginalName();
            $name_images = current(explode('.', $get_name_images));
            $new_images = $name_images . rand(0, 99) . '.' . $get_images->getClientOriginalExtension();
            $get_images->move($path, $new_images);
            $videos->images = $new_images;
        }

        $videos->save();
        //  return redirect()->route('videos.index');
        return redirect()->route('videos.index');
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
        $videos = Videos::find($id);
        return view('admin.videos.edit',compact('videos'));
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
        $data = $request->all();
        $videos = Videos::find($id);
        $videos->title = $data['title'];
        $videos->link = $data['link'];
        $videos->slug = $data['slug'];
        $videos->description= $data['description'];
        $videos->status = $data['status'];
        

        $get_images = $request->images;
        
        if($get_images){
            
            $path = "uploads/videos/";
            $get_name_images = $get_images->getClientOriginalName();
            $name_images = current(explode('.', $get_name_images));
            $new_images = $name_images . rand(0, 99) . '.' . $get_images->getClientOriginalExtension();
            $get_images->move($path, $new_images);
            $videos->images = $new_images;
        }

        $videos->save();
        return redirect()->route('videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $videos = Videos::find($id)->delete();
        return redirect()->route('videos.index');
    }
}
