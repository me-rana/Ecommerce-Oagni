<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\pCategories;
use App\Models\RequestCategory;
use App\Models\Products;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderUpdate;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use File;

class ResellerController extends Controller
{
    //
    protected function home(){
        return view('backend.seller.dashboard');
    }

    //Category------------------------------------------------------------------------------------>
    protected function getCategoryPurl(Request $req){
        $purl = SlugService::createSlug(pCategories::class, 'purl', $req->pname);
        return response()->json([
            'status => true',
            'purl' => $purl
        ]);
    }
    protected function productCategories(){
        $cat_per = 20;
        $categories = pCategories::where('p_categories.id','!=',null)->latest()->paginate($cat_per);
        return view ('backend.seller.categories',compact('categories'))->with('i',(request()->input('page',1)-1)*$cat_per);
    }
    protected function newCategory(){
        $title = 'Request Category';
        $submission = null;
        $data = compact('title','submission');
        return view('backend.seller.request-category')->with($data);
    }
    protected function categorySubmission(Request $req){
        $category = new RequestCategory;
        $category->pname = $req->pname;
        $category->purl = $req->purl;
        if($req->file('image') != null){
            $imgName = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $imgName;
            $req->file('image')->storeAs('public/image', $image);
            $category->pimage_path = $image;
        }
        $category->pdescription = $req->pdescription;
        $category->puid = Auth::user()->id;
        $category->save();

        return redirect()->route('seller.categories')->with('message','New Category added Successfully.');
    }

    //Products----------------------------------------------------------------------------------->
    protected function getpSlug(Request $req){
        $slug = SlugService::createSlug(Products::class, 'slug', $req->pro_name);
        return response()->json([
            'status => true',
            'slug' => $slug
        ]);
    }
    protected function products(){
        $cat_per = 20;
        $products = Products::rightJoin('users','products.seller','users.id')->join('p_categories','products.category','p_categories.id')->where('products.id','!=',null)->where('products.seller',Auth::user()->id)->select('products.*','users.name','p_categories.pname')->latest()->paginate($cat_per);
        return view ('backend.seller.products',compact('products'))->with('i',(request()->input('page',1)-1)*$cat_per);
    }
    protected function addProduct(){
        $title = 'New Product';
        $submission = null;
        $categories = pCategories::all();
        $data = compact('title','submission','categories');
        return view('backend.seller.new-product')->with($data);
    }
    protected function addedProduct(Request $req){
        $product = new Products;
        $product->pro_name = $req->pro_name;
        $product->slug = $req->slug;
        if($req->file('image') != null){
            $imgName = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $imgName;
            $req->file('image')->storeAs('public/image', $image);
            $product->image_path = $image;
        }
        $product->category = $req->category;
        $product->orginal_price = $req->orginal_price;
        $product->discount_price = $req->discount_price;
        $product->availability = $req->availability;
        $product->shipping = $req->shipping;
        $product->seller = Auth::user()->id;
        $product->weight = $req->weight;
        $product->description = $req->description;
        $product->information = $req->information;
        $product->save();
        return redirect()->route('seller.products')->with('message','Product added Successfully');
    }
    protected function updateProduct($id){
        $product = Products::find($id);
        if (is_null($product)){
            return redirect()->route('seller.addProduct');
        }
        else{
            $title = 'Update Product';
            $submission = null;
            $categories = pCategories::all();
            $data = compact('title','submission','categories','product');
            return view('backend.seller.new-product')->with($data);

        }
    }
    protected function  updatedProduct(Request $req, $id){
        $product = Products::find($id);
        $product->pro_name = $req->pro_name;
        $product->slug = $req->slug;
        if($req->file('image') != null){
        // $image_path = public_path('public/image', $blogCategory->cimage_path);
        $image_path = 'storage/image/'.$product->image_path;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
            $imgName = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $imgName;
            $req->file('image')->storeAs('public/image', $image);
            $product->image_path = $image;
        }
        $product->category = $req->category;
        $product->orginal_price = $req->orginal_price;
        $product->discount_price = $req->discount_price;
        $product->availability = $req->availability;
        $product->shipping = $req->shipping;
        $product->seller = Auth::user()->id;
        $product->weight = $req->weight;
        $product->description = $req->description;
        $product->information = $req->information;
        $product->update();
        return redirect()->route('seller.products')->with('message','Product updated Successfully');
    }

    protected function deleteProduct($id){
        $product = Products::find($id);
        // $image_path = public_path('public/image', $blogCategory->cimage_path);
        $image_path = 'storage/image/'.$product->image_path;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $product->delete();
        return redirect()->route('seller.products')->with('message','Product deleted Successfully.');
    }
    protected function orders(){
        $orders = Order::where('seller',Auth::user()->id)->get();
        return view('backend.seller.orders',compact('orders'));
    }
    protected function orderSearch(Request $req){
        $noOfProducts = 20;
        $orders = Order::where('order_id','LIKE','%'.$req->order_id.'%')->where('seller',Auth::user()->id)->latest()->paginate($noOfProducts);
        return view('backend.seller.orders',compact('orders'))->with('i',(request()->input('page',1)-1)*$noOfProducts);
    }
    protected function order_modify($order_id){
        $order = Order::where('order_id',$order_id)->where('seller',Auth::user()->id)->first();
        $product = Products::where('id',$order->product_id)->where('seller',Auth::user()->id)->first();
        $order_update = OrderUpdate::where('order_id',$order_id)->latest()->first();
        return view('backend.seller.order-update',compact('order','order_update','product'));
    }
    protected function orderSearchUpdate(Request $req){
        $order = Order::where('order_id', $req->order_id)->where('seller',Auth::user()->id)->first();
        $order->status = $req->status ?? 'Processing';
        $order->update();
        if($order->seller == Auth::user()->id){
            $orderUpdate = new OrderUpdate();
            $orderUpdate->order_id = $req->order_id;
            $orderUpdate->status = $req->status ?? 'Processing';
            $orderUpdate->note = $req->note ?? '';
            $orderUpdate->save();
        }
        return redirect()->back()->with('message','Order status update successfully.');
}

        protected function myInfo(){
            $user = User::where('id',Auth::user()->id)->first();
            return view('backend.seller.userinfo',compact('user'));
        }
        protected function myInfoUpdated(Request $req){
            $user = User::where('id',Auth::user()->id)->first();
            $user->name = $req->name;
            $user->phone = $req->phone;
            $user->shipping_address = $req->shipping_address;
            $user->billing_address = $req->billing_address;
            $user->country = $req->country;
            $user->city = $req->city;
            $user->state = $req->state;
            $user->postcode = $req->postcode;
            $user->update();
            return view('backend.seller.userinfo',compact('user'));
        }
}
