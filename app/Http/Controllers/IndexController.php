<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Blogs;
use App\Models\Videos;
use App\Models\Nick;
use App\Models\Gallery;
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
    public function acc($slug){
        $category =Category::where('slug',$slug)->first();
         $nicks = Nick::where('category_id',$category->id)->where('status',1)->paginate(16);
        $slider = Slider::orderBy('id', 'DESC')->where('status',1)->get( ); 
        return view('pages.acc',compact('slug','slider','nicks','category'));
    }
    public function detail_acc($ms){
        $nicks_game = Nick::Where('ms',$ms)->first();
        $nicks = Nick::find($nicks_game->id);
        $gallery = Gallery::where('nick_id',$nicks->id)->orderBy('id','DESC')->get();
        $category = Category::where('id',$nicks->category_id)->first();
        $slider = Slider::orderBy('id', 'DESC')->where('status',1)->get( ); 
        return view('pages.accgame',compact('slider','nicks','category','gallery'));
    }
    public function danhmuc_game($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status',1)->get( ); 
        $category = Category::where('slug',$slug)->first();
        return view('pages.category',compact('slider','category'));
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
    public function video_highlight(){
        $videos = Videos::orderBy('id','DESC')->where('status',1)->paginate(30);
        $slider = Slider::orderBy('id','DESC')->where('status',1)->get( ); 
        return view('pages.videos',compact('slider','videos'));
    }
    public function show_videos(Request $request){
        $data = $request->all();
        echo $data;
        
        $videos = Videos::find($data['id']);
        $output['videos_title'] = $videos->title;
        $output['videos_description'] = $videos->description;
        $output['videos_link'] = $videos->link;
         echo json_encode($output);
    }
    public function blogs_detail($slug){
        $blog = Blogs::where('slug','$slug')->first();
        $slider = Slider::orderBy('id','DESC')->where('status',1)->get( ); 
        return view('pages.blog_detail',compact('slider','blog'));
    }
}
