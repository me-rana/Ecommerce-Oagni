<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Posts;
use App\Models\Contact;
use App\Models\Products;
use App\Models\Settings;
use App\Models\bCategories;
use App\Models\pCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\Blog;
use App\Http\Controllers\Base\Shop;
use Illuminate\Support\Facades\Auth;


class FrontendController extends Controller
{

    protected function support(){
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        $productCategories = pCategories::all();
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }
        $data = compact('settings','productCategories', 'carts');
        return $data;
    }
    //Index
    public function home(){
        $data = $this->support();
        $shop = new Shop();
        $blog = new Blog();
        $products = $shop->fixedread();
        $posts_latest = $blog->latest_posts(3);
        $latest_list = $shop->latest_list(3,3);
        return view('frontend.home', compact('products','posts_latest'))->with($data)->with($latest_list);
    }

    //Delete Cart
    protected function deleteCart($id){
        $cart = Cart::where('id',$id)->first();
        if(!is_null($cart)){
            $cart->delete();
            return redirect()->back()->with('message','Product removed from Cart Successfully');
        }
        else{
            return redirect()->back()->with('message','Be mature');
        }

    }

    //Shop
    public function shop(){
        $data = $this->Support();
        $perpage = 12;
        $shop = new Shop();
        $disproducts = $shop->discount_products(12);
        $products = $shop->read($perpage);
        $latest_list = $shop->latest_list(4,0);
        return view('frontend.shop',compact('products', 'disproducts'))->with($data)->with($latest_list)->with('i',(request()->input('page',1)-1)*$perpage);
    }

    //Product Categories
    public function categoryAction($purl){
        $shop = new Shop();
        $data = $this->support();
        $category = $shop->categorywise($purl);
        $latest_list = $shop->latest_list(8,0);
        return view('frontend.category',compact('category'))->with($data)->with($latest_list);
    }

    protected function productDetails($slug){
        $shop = new Shop();
        $latest_list = $shop->latest_list(4, 0);
        $products = $latest_list['latest_Products'];
        $data = $this->support();
        $product = $shop->read_one($slug);
        return view('frontend.single-product',compact('product','products'))->with($data);
    }

    //Blog
    public function blog(){
        $perpage = 20;
        $blog = new Blog();
        $data = $this->support();
        $blogCategories = $blog->categories();
        $posts = $blog->read($perpage);
        $posts_latest = $blog->latest_posts(3);
        return view('frontend.blog',compact('blogCategories','posts','posts_latest'))->with($data)->with('i',(request()->input('page',1)-1)*$perpage);
    }

    //Search Blog Posts
    public function blogSearch(Request $req){
        $perpage = 12;
        $blog = new Blog();
        $data = $this->support();
        $blogCategories = $blog->categories();
        $posts = $blog->searchResult($req->title, $perpage);
        $posts_latest = $blog->latest_posts(3);
        return view('frontend.blog',compact('blogCategories','posts','posts_latest'))->with($data)->with('i',(request()->input('page',1)-1)*$perpage);
    }
    //Blog Category Action
    public function blogCategoryAction($curl){
        $blog = new Blog();
        $data = $this->support();
        $blogCategories = $blog->categories();
        $category = $blog->category($curl);
        $posts = $category->getposts;
        $posts_latest = $blog->latest_posts(3);
        return view('frontend.blog',compact('blogCategories','posts','posts_latest'))->with($data);
    }

    //Single Post
    public function singlePost($slug){
        $blog = new Blog();
        $data = $this->support();
        $post = $blog->read_one($slug);
        $latest_posts = $blog->latest_posts(3);
        $blogCategories = $blog->categories();
        return view('frontend.single-post',compact('latest_posts', 'post', 'blogCategories'))->with($data);
    }

    //Contact
    public function contact(){
        $data = $this->support();
        return view('frontend.contact')->with($data);
    }
    protected function contactSubmission(Request $req){

        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'

        ]);
        $list = ['name', 'email', 'message'];
        $contact = new Contact;
        foreach ($list as $row){
            $contact->$row = $req->$row;
        }
        $contact->save();
        return redirect()->route('contact')->with('message','Message sent successfully');

    }

    //Single Product
    public function singleProduct(){
        $shop = new Shop();
        $latest_list = $shop->latest_list(4, 0);
        $products =  $list['latest_Products'];
        $data = $this->support();
        return view('frontend.single-product',compact('products'))->with($data);
    }

    //Checkout
    public function checkout(){
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
            $user = User::where('id',Auth::user()->id)->first();
            $productCategories = pCategories::all();
            if(!is_null(Settings::find(1))){
                $settings =  Settings::find(1)->first();
            }
            else{
                $settings = null;
            }
            return view('frontend.checkout',compact('carts','settings','productCategories','user'));
        }
        else{
            return redirect()->route('login');
        }
    }
    //Back
    public function sendMeBack(){
        return redirect()->back();
    }
    //Order Placed
    protected function order(Request $req){
        $carts = Cart::where('uid', Auth::user()->id)->get();
        $user = User::where('id',Auth::user()->id)->first();
        $info = array($user->phone,$user->shipping_address,$user->country,$user->city,$user->state,$user->postcode,$user->billing_address);
        if(in_array(null,$info)){
            $user->phone = $req->phone_no;
            $user->shipping_address = $req->shipping_address;
            $user->country = $req->country;
            $user->city = $req->city;
            $user->state = $req->state;
            $user->postcode = $req->postcode;
            if (is_null($user->billing_address)){
                $user->billing_address = $req->shipping_address;
            }
            $user->update();
        }

        foreach ($carts as $cart){
            $order = new Order();
            $order->name = $req->first_name." ".$req->last_name;
            $order->email = $user->email;
            $order->phone = $req->phone_no;
            $order->product_id = $cart->product_id;
            $order->product_name = $cart->product_name;
            $order->quantity = $cart->quantity;
            $order->price = $cart->price;
            $order->uid = Auth::user()->id;
            $totalx = $cart->price * $cart->quantity;
            $order->vat = $totalx- (($totalx*99.5)/100);
            $order->total_price = $totalx;
            $order->order_id = date('Myjhis')."-".rand(11111,99999).$cart->id;
            $order->status = "Processing";
            $order->payment_method = $req->payment;
            $order->shipping_address = $req->shipping_address."<br>".$req->state.",".$req->city."-".$req->postcode.",".$req->country;
            $order->save();
            $cart->delete();
        }
        return redirect()->route('shop')->with('message','Order placed successful.');

    }

    //Shoping Cart
    public function shopingCart(){
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
            $uid = Auth::user()->id;
            $product = Products::where('id',$uid)->first();
        }
        else{
            $carts = null;
            $product = null;
        }
        $productCategories = pCategories::all();

        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        $data = compact('carts','settings','productCategories');
        return view('frontend.shoping-cart')->with($data);
    }
    //Add to Cart
    protected function productCart(Request $req, $id){
        $productCategories = pCategories::all();
        $product = Products::where('id',$id)->first();
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
       if(Auth::check()){
        $user = Auth::user();
        $cart = new Cart;
        $cart->name = $user->name;
        $cart->phone = $user->phone;
        $cart->uid = $user->id;
        $cart->billing_address = $user->billing_address;
        $cart->shipping_address = $user->shipping_address;
        $cart->quantity = $req->quantity ?? 1;
        $cart->product_id = $id;
        $cart->product_name = $product->pro_name;
        $cart->price = $product->discount_price ?? $product->orginal_price;
        $cart->save();
        return redirect()->back()->with('message','Product Added to cart successfully');
       }
       else{
        return redirect()->route('login');
         }

    }
    //Add to Cart
    protected function singleCart(Request $req){
       if(Auth::check()){
        $user = Auth::user();
        $cart = new Cart;
        $cart->name = $user->name;
        $cart->phone = $user->phone;
        $cart->uid = $user->id;
        $cart->billing_address = $user->billing_address;
        $cart->shipping_address = $user->shipping_address;
        $cart->quantity = $req->quantity ?? 1;
        $cart->product_id = $req->product_id;
        $cart->product_name = $req->pro_name;
        $cart->price = $req->price;
        $cart->save();
        return redirect()->back()->with('message','Product Added to cart successfully');
       }
       else{
        return redirect()->route('login');
         }

    }
    //Update Cart
    protected function updateCart(Request $req){
        $cart =  Cart::find($req->id);
        $cart->quantity = $req->quantity;
        $cart->update();
        return redirect()->back()->with('message','Quantity update Successful');

    }



    //Access Denied
    public function access_denied(){
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }
        $productCategories = pCategories::all();
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        return view('frontend.denied',compact('carts','settings','productCategories'));
    }

    protected function searchResult(Request $req){
        $perpage = 12;
        $shop = new Shop();
        $data = $this->support();
        $latest_list = $shop->latest_list(3, 0);
        $products = $shop->searchResult($req->product_name, $perpage);
        return view('frontend.search',compact('products'))->with($data)->with($latest_list)->with('i',(request()->input('page',1)-1)*$perpage);
    }

}
