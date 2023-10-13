<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nick;
use App\Models\Category;
use App\Models\Phukien;
class NickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nicks = Nick::with('category')->withCount('gallery')->orderBy('id', 'DESC')->paginate(5);
        return view('admin.nick.index',compact('nicks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('id', 'desc')->get();
        return view('admin.nick.create',compact('category'));
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
        // $attribute =[];
        // foreach ($data['attribute'] as $key => $attri) {
        //     $attribute[] =$key.': '.$attri;
        // }
        // print_r($attribute);
        $nick = new Nick();
        $nick->title = $data['title'];
        $nick->ms = random_int(100000, 999999);
        $nick->description = $data['description'];
        $nick->category_id = $data['category_id'];
        $nick->price = $data['price'];
        $nick->status = $data['status'];

        $get_images = $request->images;
        $path = "uploads/nick/";
        $get_name_images = $get_images->getClientOriginalName();
        $name_images = current(explode('.', $get_name_images));
        $new_images = $name_images . rand(0, 99) . '.' . $get_images->getClientOriginalExtension();
        $get_images->move($path, $new_images);
        $nick->images = $new_images;
        $nick->save();
        return redirect()->route('nick.index')->with('status', 'Thêm nick game thành công');
    }
    public function choose_category(Request $request){
        $data = $request->all();
        $phukien = Phukien::where('category_id', $data['category_id'])->where('status',1)->get();       
        $output="";
        foreach($phukien as $key => $phukien){
            $output.='<div class="form-group">
            <label for="exampleFormControlSelect1">.$phukien->title.</label>
            <input type="hidden" value="'.$phukien->title.'"name="name_attribute">
            <input type="text" class="form-control" required name="attribute[]" placeholder="....">
            </div>';
        }
        echo $output;
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
        $nick = Nick::find($id);
        $category = Category::orderBy('id', 'desc')->get();
        return view('admin.nick.edit',compact('nick','category'));
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
        $nick = Nick::find($id);
        $nick->title = $data['title'];
        $nick->ms = $nick->ms;
        // $nick->attribute = $data['attribute'];
        $nick->description = $data['description'];
        $nick->category_id = $data['category_id'];
        $nick->price = $data['price'];
        $nick->status = $data['status'];

        $get_images = $request->images;
        if($get_images){
            $path = "uploads/nick/";
            $get_name_images = $get_images->getClientOriginalName();
            $name_images = current(explode('.', $get_name_images));
            $new_images = $name_images . rand(0, 99) . '.' . $get_images->getClientOriginalExtension();
            $get_images->move($path, $new_images);
            $nick->images = $new_images;
        }
        
        $nick->save();
        return redirect()->route('nick.index')->with('status', 'Thêm nick game thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $nick = Nick::find($id)->delete();
       return redirect()->route('nick.index');
    }
}
