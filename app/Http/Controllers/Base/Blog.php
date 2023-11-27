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
    protected function image_cstore($req_file){
        if($req_file != null){
            $img_name = $req_file->getClientOriginalName();
            $image = date("Y-m-d_H-i-s")."_".rand(11111,99999).$img_name;
            $req_file->storeAs('public/categories', $image);
            return 'storage/categories/'.$image;
        }
    }
    protected function image_store($req_file){
        if($req_file != null){
            $img_name = $req_file->getClientOriginalName();
            $image = date("Y-m-d_H-i-s")."_".rand(11111,99999).$img_name;
            $req_file->storeAs('public/posts', $image);
            return 'storage/posts/'.$image;
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
    public function admin_read($perpage){
        $posts = Posts::where('deleted_at', null)->latest()->paginate($perpage);
        return $posts;
    }
    public function read_one($slug){
        $post = Posts::where('status', 1)->where('deleted_at', null)->where('slug',$slug)->first();
        return $post;
    }
    public function create($request, $items, $uid) {
        $post = new Posts();
        foreach ($items as $item){
            $post->$item = $request->$item;
        }
        if ($request->file('image')){
            $post->image_path = $this->image_store($request->file('image'));
        }
        $post->writer = $uid;
        $post->updated_by = '';
        $post->save();
        return true;

    }
    public function update($post_id ,$request, $items, $uid){
        $post = Posts::where('id', $post_id)->first();
        foreach ($items as $item){
            $post->$item = $request->$item;
        }
        if ($request->file('image')){
            $this->image_delete($post->image_path);
            $post->image_path = $this->image_store($request->file('image'));
        }
        $post->updated_by = $uid;
        $post->update();
        return true;
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
    public function category_submission ($request,$items, $uid){
        $category = new bCategories();
        foreach ($items as $item){
            $category->$item = $request->$item;
        }
        if(!is_null($request->file('image'))){
            $category->cimage_path = $this->image_cstore($request->file('image'));
        }
        $category->cuid = $uid;
        $category->save();
        return 0;
    }
    public function category_resubmission($id, $request, $items, $uid){
        $category = bCategories::where('id', $id)->first();
        foreach ($items as $item){
            $category->$item = $request->$item;
        }
        if(!is_null($request->file('image'))){
            $this->image_delete($category->cimage_path);
            $category->cimage_path = $this->image_cstore($request->file('image'));
        }
        $category->cuid = $uid;
        $category->update();
        return 0;
    }
    public function delete_category ($id){
        $category = bCategories::where('id', $id)->first();
        $this->image_delete($category->cimage_path);
        $category->delete();
    }
    public function searchResult($search_keyword, $perpage){
        $results = Posts::where('status',1)->where('deleted_at', null)->where('title','LIKE','%'.$search_keyword.'%')->latest()->paginate($perpage);
        return $results;
    }
}
