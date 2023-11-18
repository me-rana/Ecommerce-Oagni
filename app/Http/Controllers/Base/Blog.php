<?php

namespace App\Http\Controllers\Base;

use App\Models\Posts;
use App\Models\bCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Blog extends Controller
{
    //

    public function read($perpage){
        $posts = Posts::where('status',1)->where('deleted_at', null)->latest()->paginate($perpage);
        return $posts;
    }
    public function read_one($slug){
        $post = Posts::where('status', 1)->where('deleted_at', null)->where('slug',$slug)->first();
        return $post;
    }

    public function latest_posts($limit){
        $latest_posts = Posts::where('status',1)->where('deleted_at', null)->latest()->limit($limit)->get();
        return $latest_posts;
    }
    public function categories(){
        $categories = bCategories::all();
        return $categories;
    }
    public function category($curl){
        $category = bCategories::where('curl', $curl)->first();
        return $category;
    }
    public function searchResult($search_keyword, $perpage){
        $results = Posts::where('status',1)->where('deleted_at', null)->where('title','LIKE','%'.$search_keyword.'%')->latest()->paginate($perpage);
        return $results;
    }
}
