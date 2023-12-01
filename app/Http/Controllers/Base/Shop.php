<?php

namespace App\Http\Controllers\Base;

use App\Models\Products;
use App\Models\pCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class Shop extends Controller
{
    ////Support Class
    protected function image_pstore($req_file){
        if($req_file != null){
            $img_name = $req_file->getClientOriginalName();
            $image = date("Y-m-d_H-i-s")."_".rand(11111,99999).$img_name;
            $req_file->storeAs('public/product_categories', $image);
            return 'storage/product_categories/'.$image;
        }
    }
    protected function image_store($req_file){
        if($req_file != null){
            $img_name = $req_file->getClientOriginalName();
            $image = date("Y-m-d_H-i-s")."_".rand(11111,99999).$img_name;
            $req_file->storeAs('public/product', $image);
            return 'storage/product/'.$image;
        }
    }
    protected function image_delete($file){
        $image_path = $file; 
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        return 0;
    }
    //Main Section---------------------------------------------------------------------------------->
    public function read($perpage){
        $products = Products::where('availability','In Stock')->where('deleted_at', null)->latest()->paginate($perpage);
        return $products;
    }

    public function read_one($slug){
        $product = Products::where('slug', $slug)->where('deleted_at', null)->first();
        return $product;
    }

    public function product_submitted ($request, $items, $seller){
        $product = new Products();
        foreach ($items as $item){
            $product->$item = $request->$item;
        }
        $product->seller = $seller;
        if (!is_null($request->file('image'))){
            $product->image_path = $this->image_store($request->file('image'));
        }
        $product->save();
        return true;
    } 
    public function product_resubmitted ($id, $request, $items, $seller){
        $product = Products::where('id', $id)->first();
        foreach ($items as $item){
            $product->$item = $request->$item;
        }
        $product->seller = $seller;
        if (!is_null($request->file('image'))){
            $this->image_delete($product->image_path);
            $product->image_path = $this->image_store($request->file('image'));
        }
        $product->save();
        return true;
    } 

    public function discount_products($limit){
        $discount = Products::where('availability','In Stock')->where('deleted_at', null)->limit($limit)->latest()->get();
        return $discount;
    }

    public function fixedread(){
        $products = Products::where('availability','In Stock')->where('deleted_at', null)->latest()->limit(8)->get();
        return $products;
    }
    public function latest_list($limit, $offset){
        $latest_Products = Products::where('availability','In Stock')->where('deleted_at', null)->latest()->limit($limit)->get();
        $latest_Productsx = Products::where('availability','In Stock')->where('deleted_at', null)->latest()->limit($limit)->offset($offset)->get();
        $latest_Productsy = Products::where('availability','In Stock')->where('deleted_at', null)->latest()->limit($limit)->offset($offset*2)->get();
        $latest_list = compact('latest_Products','latest_Productsx','latest_Productsy');
        return $latest_list;
    }
    public function read_category($perpage){
        $categories = pCategories::latest()->paginate($perpage);
        return $categories; 
    }
    public function submission_category($request, $items, $uid){
        $category = new pCategories();
        foreach ($items as $item){
            $category->$item = $request->$item;
        }
        if (!is_null($request->file('image'))){
            $category->pimage_path = $this->image_pstore($request->file('image'));
        }
        $category->puid = $uid;
        $category->save();
        return true;
    }
    public function resubmission_category($id, $request, $items, $uid){
        $category = pCategories::where('id', $id)->first();
        foreach ($items as $item){
            $category->$item = $request->$item;
        }
        if (!is_null($request->file('image'))){
            $category->pimage_path = $this->image_pstore($request->file('image'));
        }
        $category->puid = $uid;
        $category->update();
        return true;
    }
    public function delete_product($id){
        $product = Products::where('id', $id)->first();
        $this->image_delete($product->image_path);
        $product->delete();
        return true;
    }
    public function delete_category($id){
        $category = pCategories::where('id', $id)->first();
        $this->image_delete($category->pimage_path);
        $category->delete();
        return true;
    }
    public function categorywise($catName){
        $categorywise = pCategories::where('purl',$catName)->with('getproducts')->latest()->first();
        return $categorywise;
    }
    public function searchResult($search_keyword, $perpage){
        $results = Products::where('pro_name','LIKE','%'.$search_keyword.'%')->where('availability','In Stock')->latest()->paginate($perpage);
        return $results;
    }
}
