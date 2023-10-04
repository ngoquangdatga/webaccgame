<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::orderBy('id', 'DESC')->paginate(2);
        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
        $data = $request->validate(
            [

                'title' => 'required|unique:slider|max:255',

                'description' => 'required|max:255',


                'status' => 'required',
            ],
            [
                'title.unique' => 'Tên danh mục đã có vui lòng điền tên khác.',
                'title.required' => 'Tên danh mục game phải có.',
                'description.required' => 'Mô tả danh mục phải có.',

            ],
        );
        $slider = new Slider();
        $slider->title = $data['title'];

        $slider->description = $data['description'];
        $slider->status = $data['status'];

        $get_images = $request->images;
        $path = "uploads/slider/";
        $get_name_images = $get_images->getClientOriginalName();
        $name_images = current(explode('.', $get_name_images));
        $new_images = $name_images . rand(0, 99) . '.' . $get_images->getClientOriginalExtension();
        $get_images->move($path, $new_images);
        $slider->images = $new_images;
        $slider->save();
        return redirect()->route('slider.index')->with('status', 'Thêm slider game thành công');
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
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
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
        $data = $request->validate(
            [

                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'title.required' => 'Tên danh mục game phải có.',
                'description.required' => 'Mô tả danh mục phải có.',
            ],
        );
        $slider = Slider::find($id);

        $slider->title = $data['title'];
        $slider->description = $data['description'];
        $slider->status = $data['status'];

        $get_images = $request->images;
        if ($get_images) {
            $path_unlink = 'uploads/slider/' . $slider->images;
            if (file_exists($path_unlink)) {
                unlink($path_unlink);
            }
            $path = "uploads/slider/";
            $get_name_images = $get_images->getClientOriginalName();
            $name_images = current(explode('.', $get_name_images));
            $new_images = $name_images . rand(0, 99) . '.' . $get_images->getClientOriginalExtension();
            $get_images->move($path, $new_images);
            $slider->images = $new_images;
        }
        $slider->save();
        return redirect()->route('slider.index')->with('status', 'Cập nhật slider game thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $path_unlink = 'uploads/slider/' . $slider->images;
        if (file_exists($path_unlink)) {
            unlink($path_unlink);
        }
        $slider->delete();
        return redirect()->back()->with('status', 'Cập nhật danh mục game thành công');
    }
}
