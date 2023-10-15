<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Contact;
use App\Models\pCategories;
use App\Models\bCategories;
use App\Models\Posts;
use App\Models\Products;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;


class FrontendController extends Controller
{

    // public function support(){
    //     if(!is_null(Settings::find(1))){
    //         $settings =  Settings::find(1)->first();
    //      }
    //     else{
    //         $settings = null;
    //     }
    //     $productCategories = pCategories::all();
    //     $data = compact('settings','productCategories');
    // }
    //Index
    public function home(){
        $productCategories = pCategories::all();
        $noOfProducts = 3;
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }
        $products = Products::where('availability','In Stock')->latest()->limit(8)->get();
        $latest_Products = Products::latest()->limit(3)->get();
        $latest_Productsx = Products::latest()->limit(3)->offset(3)->get();
        $posts_latest = Posts::where('status',1)->latest()->limit(3)->get();
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        return view('frontend.home',compact('settings', 'productCategories','latest_Products','latest_Productsx','posts_latest','products','carts'));
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
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }
        $productCategories = pCategories::all();
        $noOfProducts = 12;
        $disproducts = Products::where('availability','In Stock')->where('discount_price','!=',null)->join('p_categories','products.category','p_categories.id')->select('products.*','p_categories.pname')->limit(12)->latest()->get();
        $products = Products::where('availability','In Stock')->latest()->paginate($noOfProducts);
        $products_latest = Products::latest()->limit(4)->get();
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        return view('frontend.shop',compact('carts','settings','productCategories', 'products', 'disproducts','products_latest'))->with('i',(request()->input('page',1)-1)*$noOfProducts);
    }

    //Product Categories
    public function categoryAction($purl){
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }
        $productCategories = pCategories::all();
        $noOfProducts = 12;

        $products = Products::where('availability','In Stock')->join('p_categories','products.category','p_categories.id')->where('purl',$purl)->select('products.*','p_categories.purl')->latest()->paginate($noOfProducts);
        $products_latest = Products::latest()->limit(4)->get();
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        return view('frontend.search',compact('carts','settings','productCategories', 'products', 'products_latest'))->with('i',(request()->input('page',1)-1)*$noOfProducts);
    }

    protected function productDetails($slug){
        $products = Products::limit(4)->latest()->get();
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        $productCategories = pCategories::all();
        $product = Products::where('slug',$slug)->join('p_categories','products.category','p_categories.id')->where('availability','In Stock')->select('products.*','p_categories.pname')->first();
        return view('frontend.single-product',compact('carts','product','productCategories','settings','products'));
    }

    //Blog
    public function blog(){
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }
        $productCategories = pCategories::all();
        $blogCategories = bCategories::all();
        $noOfPosts = 20;
        $posts = Posts::where('status',1)->latest()->paginate($noOfPosts);
        $posts_latest = Posts::where('status',1)->latest()->limit(3)->get();
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        return view('frontend.blog',compact('carts','settings','productCategories','blogCategories','posts','posts_latest'))->with('i',(request()->input('page',1)-1)*$noOfPosts);
    }

    //Search Blog Posts
    public function blogSearch(Request $req){
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }
        $productCategories = pCategories::all();
        $blogCategories = bCategories::all();
        $noOfPosts = 12;
        $posts = Posts::where('status',1)->where('title','LIKE','%'.$req->title.'%')->latest()->paginate($noOfPosts);
        $posts_latest = Posts::where('status',1)->latest()->limit(3)->get();
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        return view('frontend.blog',compact('carts','settings','productCategories','blogCategories','posts','posts_latest'))->with('i',(request()->input('page',1)-1)*$noOfPosts);
    }
    //Blog Category Action
    public function blogCategoryAction($curl){
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }
        $productCategories = pCategories::all();
        $blogCategories = bCategories::all();
        $noOfPosts = 12;
        $posts = Posts::join('b_categories','posts.category','b_categories.id')->where('posts.status',1)->where('b_categories.curl',$curl)->select('posts.*','b_categories.curl')->latest()->paginate($noOfPosts);
        $posts_latest = Posts::where('status',1)->latest()->limit(3)->get();
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        return view('frontend.blog',compact('carts','settings','productCategories','blogCategories','posts','posts_latest'))->with('i',(request()->input('page',1)-1)*$noOfPosts);
    }

    //Single Post
    public function singlePost($slug){
        if(Auth::check()){
            $carts = Cart::where('uid',Auth::user()->id)->get();
        }
        else{
            $carts = null;
        }

        $post = Posts::where('slug',$slug)->join('users','posts.writer','users.id')->join('b_categories','posts.category','b_categories.id')->where('posts.id','!=',null)->select('posts.*','users.name','b_categories.cname')->first();
        $productCategories = pCategories::all();
        $latest_posts = Posts::latest()->limit(3)->get();
        $blogCategories = bCategories::all();
        if(!is_null(Settings::find(1))){
            $settings =  Settings::find(1)->first();
         }
        else{
            $settings = null;
        }
        return view('frontend.single-post',compact('latest_posts','carts','settings','productCategories','post','blogCategories'));
    }

    //Contact
    public function contact(){
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
        return view('frontend.contact',compact('carts','settings','productCategories'));
    }
    protected function contactSubmission(Request $req){

        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'

        ]);
        $contact = new Contact;
        $contact->name = $req->name;
        $contact->email = $req->email;
        $contact->message = $req->message;
        $contact->save();

        return redirect()->route('contact')->with('message','Message sent successfully');

    }

    //Single Product
    public function singleProduct(){
        $products = Products::limit(4)->latest()->get();
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
        return view('frontend.single-product',compact('carts','settings','productCategories','products'));
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
        $noOfProducts = 12;
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
        $products_latest = Products::latest()->limit(4)->get();
        $products = Products::where('pro_name','LIKE','%'.$req->product_name.'%')->where('availability','In Stock')->latest()->paginate($noOfProducts);
        return view('frontend.search',compact('products','carts','settings','productCategories','products_latest'))->with('i',(request()->input('page',1)-1)*$noOfProducts);
    }

}
