<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phukien;
use App\Models\Category;
class PhukienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phukien = Phukien::orderBy('id','DESC')->paginate(20);
        return view('admin.phukien.index',compact('phukien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category = Category::with('category_id')->orderBy('id', 'DESC')->get();
        // return view('admin.phukien.create',compact('category'));
      $category = Category::orderBY('id', 'DESC')->get();
      return view('admin.phukien.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->all();
        $phukien = new Phukien();
        $phukien->title = $data['title'];
        $phukien->category_id = $data['category_id'];
        $phukien->title = $data['title'];
        $phukien->status = $data['status'];

        $phukien->save();
        return redirect()->route('phukien.index');
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
        $category = Category::with('category')->orderBy('id', 'DESC')->get();
        $phukien = Phukien::find($id);
        return view('admin.phukien.edit',compact('category','phukien'));
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
        $data = request()->all();
        $phukien = Phukien::find($id);
        $phukien->title = $data['title'];
        $phukien->category_id = $data['category_id'];
       
        $phukien->title = $data['title'];
        $phukien->status = $data['status'];
        $phukien->save();
        return redirect()->route('phukien.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phukien = Phukien::find($id)->delete();
        return redirect()->route('phukien.index');
    }
}
