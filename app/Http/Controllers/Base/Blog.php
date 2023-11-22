<?php

namespace App\Http\Controllers\Base;

use App\Models\Posts;
use App\Models\bCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class Blog extends Controller
{
    //Support Class
    protected function image_store($req_file){
        if($req_file != null){
            $img_name = $req_file->getClientOriginalName();
            $image = date("Y-m-d_H-i-s")."_".rand(11111,99999).$img_name;
            $req_file->storeAs('public/image', $image);
            return 'storage/post/'.$image;
        }
    }
    protected function image_delete($file){
        $image_path = $file; 
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        return 0;
    }

    //Main Section-------------------------------------------------------------------->

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
    public function category_submission ($request,$items){
        $category = new bCategories();
        foreach ($items as $item){
            $category->$item = $request->$item;
        }
        if(!is_null($request->file('image'))){
            $category->cimage_path = $this->image_store($request->file('image'));
        }
        $category->save();
        return 0;
    }
    public function category_resubmission($id, $request, $items){
        $category = bCategories::where('id', $id)->first();
        foreach ($items as $item){
            $category->$item = $request->$item;
        }
        if(!is_null($request->file('image'))){
            $this->image_delete($category->cimage_path);
            $category->cimage_path = $this->image_store($request->file('image'));
        }
        $category->update();
        return 0;
    }
    public function searchResult($search_keyword, $perpage){
        $results = Posts::where('status',1)->where('deleted_at', null)->where('title','LIKE','%'.$search_keyword.'%')->latest()->paginate($perpage);
        return $results;
    }
}
