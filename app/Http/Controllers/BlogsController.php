<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::orderBy('id', 'DESC')->paginate(5);
        return view('admin.blogs.index', compact('blogs'));

    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
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
        $blogs = new Blogs();
        $blogs->title = $data['title'];
        $blogs->description= $data['description'];
        $blogs->status = $data['status'];
        $blogs->images = $data['images'];
        $blogs->content = $data['content'];

        $get_images = $request->images;
        if($get_images){
            $path = '/uploads/blogs';
            $get_name_images = $get_images->getClientOriginalName();
            $name_images = current(explode('.', $get_name_images));
            $new_images = $name_images. rand(0, 999). '.'. $get_images->getClientOriginalExtension();
            $get_images->move($path, $new_images);
            $blogs->images = $new_images;
        }

        $blogs->save();
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
        $blogs = Blogs::find($id);
        return view('admin.blogs.edit', compact('blogs'));
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
    
        $blogs = Blogs::find($id)->delete();
        return redirect()->route('blogs.index');
    }
}
