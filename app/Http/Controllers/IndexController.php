<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Blogs;
class IndexController extends Controller
{
    public function home(){
        $slider = Slider::orderBy('id', 'DESC')->where('status',1)->get( ); 
        $category = Category::orderBy('id', 'DESC')->get();
       // dd( $category->toArray() );
        return view('pages.home',compact('category','slider'));
       
    }
    public function dichvu(){
        $slider = Slider::orderBy('id', 'DESC')->where('status',1)->get( ); 
        return view('pages.services',compact('slider'));
    }
    public function dichvucon($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status',1)->get( ); 
        return view('pages.sub_services',compact('slug','slider'));
    }
    public function danhmuc_game($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status',1)->get( ); 
        return view('pages.category',compact('slider'));
    }
    public function danhmuccon($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status',1)->get( ); 
        return view('pages.sub_category',compact('slug','slider'));
    }
  
    public function blogs(){
        $blogs = Blogs::orderBy('id','DESC')->paginate(30);
        $slider = Slider::orderBy('id','DESC')->where('status',1)->get( ); 
        return view('pages.blogs',compact('slider','blogs'));
    }
    public function blogs_detail($slug){
        $blog = Blogs::where('slug','$slug')->first();
        $slider = Slider::orderBy('id','DESC')->where('status',1)->get( ); 
        return view('pages.blog_detail',compact('slider','blog'));
    }
}
