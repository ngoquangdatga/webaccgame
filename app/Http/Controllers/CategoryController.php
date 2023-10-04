<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

use function Pest\Laravel\get;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->paginate(5);
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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

                'title' => 'required|unique:categories|max:255',
                'slug' => 'required|unique:categories|max:255',
                'description' => 'required|max:255',


                'status' => 'required',
            ],
            [
                'title.unique' => 'Tên danh mục đã có vui lòng điền tên khác.',
                'title.required' => 'Tên danh mục game phải có1.',
                'slug.unique' => 'Tên slug danh mục đã có vui lòng điền tên khác.',
                'slug.required' => 'Tên slug danh mục game phải có1.',
                'description.required' => 'Mô tả danh mục phải có1.',

            ],
        );
        $category = new Category();
        $category->title = $data['title'];

        $category->description = $data['description'];
        $category->status = $data['status'];

        $get_images = $request->images;
        $path = "uploads/category/";
        $get_name_images = $get_images->getClientOriginalName();
        $name_images = current(explode('.', $get_name_images));
        $new_images = $name_images . rand(0, 99) . '.' . $get_images->getClientOriginalExtension();
        $get_images->move($path, $new_images);
        $category->images = $new_images;
        $category->save();
        return redirect()->route('category.index')->with('status', 'Thêm danh mục game thành công');
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
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
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
                'slug' => 'required|max:255',
                'description' => 'required|max:255',

                'status' => 'required',
            ],
            [
                
                'title.required' => 'Tên danh mục game phải có.',
                'slug.required' => 'Tên slug danh mục game phải có.',
                'description.required' => 'Mô tả danh mục phải có.1',
            ],
        );
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];

        $get_images = $request->images;
        if ($get_images) {
            $path_unlink = 'uploads/category/' . $category->images;
            if (file_exists($path_unlink)) {
                unlink($path_unlink);
            }
            $path = "uploads/category/";
            $get_name_images = $get_images->getClientOriginalName();
            $name_images = current(explode('.', $get_name_images));
            $new_images = $name_images . rand(0, 99) . '.' . $get_images->getClientOriginalExtension();
            $get_images->move($path, $new_images);
            $category->images = $new_images;
        }
        $category->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $path_unlink = 'uploads/category/' . $category->images;
        if (file_exists($path_unlink)) {
            unlink($path_unlink);
        }
        $category->delete();
        return redirect()->back()->with('status', 'Cập nhật danh mục game thành công');
    }
}
