<?php

namespace App\Http\Controllers\Base;

use App\Models\Products;
use App\Models\pCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Shop extends Controller
{
    //
    public function read($perpage){
        $products = Products::where('availability','In Stock')->where('deleted_at', null)->latest()->paginate($perpage);
        return $products;
    }

    public function read_one($slug){
        $product = Products::where('slug', $slug)->where('deleted_at', null)->first();
        return $product;
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
    public function categorywise($catName){
        $categorywise = pCategories::where('purl',$catName)->with('getproducts')->latest()->first();
        return $categorywise;
    }
}
