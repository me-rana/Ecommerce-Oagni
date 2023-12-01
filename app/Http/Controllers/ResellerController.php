<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Order;
use App\Models\Products;
use App\Models\OrderUpdate;
use App\Models\pCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\Blog;
use App\Http\Controllers\Base\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ResellerController extends Controller
{
    //

       //Extend Class
       protected function Blog(){
        $blog = new Blog();
        return $blog;
    }
    protected function Shop(){
        $shop = new Shop();
        return $shop;
    }
    
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
        $perpage = 20;
        $shop = $this->Shop();
        $categories = $shop->read_category($perpage);
        return view ('backend.seller.categories',compact('categories'))->with('i',(request()->input('page',1)-1)*$perpage);
    }
    protected function newCategory(){
        $title = 'Request Category';
        $submission = null;
        $data = compact('title','submission');
        return view('backend.seller.request-category')->with($data);
    }
    protected function categorySubmission(Request $req) : RedirectResponse{
        $req->validate([
            'pname' => 'required',
            'pdescription' => 'required'
        ]);
        $items = ['pname', 'purl', 'pdescription'];
        $shop = $this->Shop();
        $shop->submission_category($req, $items, Auth::user()->id);
        return redirect()->route('Product Categories (Seller)')->with('message','New Category added Successfully.');
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
        $perpage = 12;
        $shop = $this->Shop();
        $products = $shop->read($perpage);
        return view ('backend.seller.products',compact('products'))->with('i',(request()->input('page',1)-1)*$perpage);
    }
    protected function addProduct(){
        $title = 'New Product';
        $submission = null;
        $categories = pCategories::all();
        $data = compact('title','submission','categories');
        return view('backend.seller.new-product')->with($data);
    }
    protected function addedProduct(Request $req) : RedirectResponse {
        $req->validate([
            'pro_name' => 'required',
            'orginal_price' =>'required',
            'description' => 'required'
        ]);
        $items = ['pro_name', 'slug', 'category', 'orginal_price', 'discount_price', 'availability', 'shipping', 'weight', 'description', 'information'];
        $shop = $this->Shop();
        $product = $shop->product_submitted($req, $items, Auth::user()->id);
        return redirect()->route('Products (Seller)')->with('message','Product added Successfully');
    }
    protected function updateProduct($id){
        $product = Products::find($id);
        if (is_null($product)){
            return redirect()->route('New Product (Seller)');
        }
        else{
            $title = 'Update Product';
            $submission = null;
            $categories = pCategories::all();
            $data = compact('title','submission','categories','product');
            return view('backend.seller.new-product')->with($data);

        }
    }
    protected function  updatedProduct(Request $req, $id) : RedirectResponse {
        $req->validate([
            'pro_name' => 'required',
            'orginal_price' =>'required',
            'description' => 'required'
        ]);
        $items = ['pro_name', 'slug', 'category', 'orginal_price', 'discount_price', 'availability', 'shipping', 'weight', 'description', 'information'];
        $shop = $this->Shop();
        $product = $shop->product_resubmitted($id, $req, $items, Auth::user()->id);
        return redirect()->route('Products (Seller)')->with('message','Product updated Successfully');
    }

    protected function deleteProduct($id){
        $shop = $this->Shop();
        $product =$shop->delete_product($id); 
        return redirect()->route('Products (Seller)')->with('message','Product deleted Successfully.');
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
