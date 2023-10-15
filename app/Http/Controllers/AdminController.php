<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\bCategories;
use App\Models\pCategories;
use App\Models\Posts;
use App\Models\Products;
use App\Models\User;
use App\Models\UserData;
use App\Models\Order;
use App\Models\OrderUpdate;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use File;


class AdminController extends Controller
{
    //Dashboard
    protected function home(){
        return view('backend.admin.dashboard');
    }
    //Setting Management
    protected function settings(){
        if(!is_null(Settings::find(1))){
           $settings =  Settings::find(1)->first();
           return view('backend.admin.settings',compact('settings'));
        }
        else{
            return view('backend.admin.settings');
        }
    }

    protected function settings_submission(Request $req){
        if(is_null(Settings::find(1))){
            $settings = new Settings;
            $settings->name = $req->name;
            $settings->phone_no = $req->phone_no;
            $settings->email = $req->email;
            $settings->facebook = $req->facebook;
            $settings->linkdin = $req->linkdin;
            $settings->twitter = $req->twitter;
            $imgName = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $imgName;
            $req->file('image')->storeAs('public/image', $image);
            $settings->logo_path = $image;
            $settings->pinterest = $req->pinterest;
            $settings->address = $req->address;
            $settings->office_time = $req->office_time;
            $settings->copyright = $req->copyright;
            $settings->save();
        }
        else{
            $settings = Settings::find(1);
            $settings->name = $req->name;
            $settings->phone_no = $req->phone_no;
            $settings->email = $req->email;
            if($req->file('image') != null){
                // $image_path = public_path('public/image', $blogCategory->cimage_path);
                $image_path = 'storage/image/'.$settings->logo_path;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $imgName = $req->file('image')->getClientOriginalName();
                $image = rand(11111, 99999) . $imgName;
                $req->file('image')->storeAs('public/image', $image);
                $settings->logo_path = $image;
            }
            $settings->facebook = $req->facebook;
            $settings->linkdin = $req->linkdin;
            $settings->twitter = $req->twitter;
            $settings->pinterest = $req->pinterest;
            $settings->address = $req->address;
            $settings->office_time = $req->office_time;
            $settings->copyright = $req->copyright;
            $settings->update();

        }
        return redirect()->route('admin.settings')->with('message','Settings updated Successfully.');
    }



    //Blog Categories Management Section--------------------------------------------------------------------->
    public function getBlogCurl(Request $req){
        $curl = SlugService::createSlug(bCategories::class, 'curl', $req->cname);
        return response()->json([
            'status => true',
            'curl' => $curl
        ]);
    }
    protected function blogCategories(){
        $cat_per = 20;
        $categories = bCategories::rightJoin('users','b_categories.cuid','users.id')->where('b_categories.id','!=',null)->select('b_categories.*','users.name')->latest()->paginate($cat_per);
        return view ('backend.admin.blog.categories',compact('categories'))->with('i',(request()->input('page',1)-1)*$cat_per);

    }
    protected function blogAddCategory(){
        $title = 'New Category';
        $submission = null;
        $data = compact('title','submission');
        return view('backend.admin.blog.new-category')->with($data);
    }
    protected function blogUpdateCategory($id){
        $categories = bCategories::find($id);
        if(is_null($categories)){
            return redirect()->route('admin.blog.addCategory');
        }
        else{
        $title = 'Update Category';
        $submission = null;
        $data = compact('categories','title','submission');
        return view('backend.admin.blog.new-category')->with($data);
        }
    }
    protected function blogAddCategorySubmission(Request $req){
        $blogCategory = new bCategories;
        $blogCategory->cname = $req->cname;
        $blogCategory->curl = $req->curl;
        if($req->file('image') == null){

        }
        else{
            $imgName = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $imgName;
            $req->file('image')->storeAs('public/image', $image);
            $blogCategory->cimage_path = $image;
        }
        $blogCategory->cdescription = $req->cdescription;
        $blogCategory->cuid = Auth::user()->id;
        $blogCategory->save();

        return redirect()->route('admin.blog.categories')->with('message','New Category added Successfully.');
    }
    protected function blogUpdateCategorySubmission(Request $req,$id){
        $blogCategory = bCategories::find($id);
        $blogCategory->cname = $req->cname;
        $blogCategory->curl = $req->curl;
        if($req->file('image') == null){

        }
        else{
            // $image_path = public_path('public/image', $blogCategory->cimage_path);
            $image_path = 'storage/image/'.$blogCategory->cimage_path;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $url = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $url;
            $req->file('image')->storeAs('public/image', $image);
            $blogCategory->cimage_path = $image;

        }
        $blogCategory->cdescription = $req->cdescription;
        $blogCategory->cuid = Auth::user()->id;
        $blogCategory->update();
        return redirect()->route('admin.blog.categories')->with('message','The Category updated Successfully.');
    }

    //Delete Blog Categories
    protected function blogDeleteCategory($id){
        $blogCategory = bCategories::find($id);
        // $image_path = public_path('public/image', $blogCategory->cimage_path);
        $image_path = 'storage/image/'.$blogCategory->cimage_path;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $blogCategory->delete();
        return redirect()->route('admin.blog.categories')->with('message','The Category deleted Successfully.');
    }


    //Posts Management Section------------------------------------------------------------------------------->
    protected function getSlug(Request $req){
        $slug = SlugService::createSlug(Posts::class, 'slug', $req->title);
        return response()->json([
            'status => true',
            'slug' => $slug
        ]);
    }
    protected function posts(){
        $cat_per = 20;
        $posts = Posts::rightJoin('users','posts.writer','users.id')->join('b_categories','posts.category','b_categories.id')->where('posts.id','!=',null)->select('posts.*','users.name','b_categories.cname')->latest()->paginate($cat_per);
        return view ('backend.admin.blog.posts',compact('posts'))->with('i',(request()->input('page',1)-1)*$cat_per);
    }
    protected function addPost(){
        $title = 'Add a Post';
        $submission = null;
        $categories = bCategories::all();
        $data = compact('title','submission','categories');
        return view('backend.admin.blog.new-post')->with($data);
    }
    protected function postSubmission(Request $req){
        $post = new Posts;
        $post->title = $req->title;
        $post->slug = $req->slug;
        $post->content = $req->content;
        if($req->file('image') != null){
            $imgName = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $imgName;
            $req->file('image')->storeAs('public/image', $image);
            $post->image_path = $image;
        }
        $post->writer = Auth::user()->id;
        $post->tag = $req->tag;
        $post->status = $req->status;
        $post->category = $req->category;
        $post->save();

        return redirect()->route('admin.blog.posts')->with('message','The Post added Successfully');
    }

    protected function updatePost($id){
        $getPost = Posts::find($id);
        if(is_null($getPost)){
            return redirect()->route('admin.blog.addPost');
        }
        else{
        $title = 'Update Content of the Post';
        $submission = null;
        $categories = bCategories::all();
        $data = compact('title','submission','categories','getPost');
        return view('backend.admin.blog.new-post')->with($data);
        }
    }
    protected function postSubmissionUpdate(Request $req,$id){
        $post = Posts::find($id);
        $post->title = $req->title;
        $post->slug = $req->slug;
        $post->content = $req->content;
        if($req->file('image') != null){
            // $image_path = public_path('public/image', $blogCategory->cimage_path);
            $image_path = 'storage/image/'.$post->image_path;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $imgName = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $imgName;
            $req->file('image')->storeAs('public/image', $image);
            $post->image_path = $image;
        }
        $post->writer = Auth::user()->id;
        $post->tag = $req->tag;
        $post->status = $req->status;
        $post->category = $req->category;
        $post->update();

        return redirect()->route('admin.blog.posts')->with('message','The Post updated Successfully');
    }
    protected function deletePost($id){
        $post = Posts::find($id);
        $image_path = 'storage/image/'.$post->image_path;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $post->delete();
        return redirect()->route('admin.blog.posts')->with('message','The Post deleted Successfully');

    }


    //Product categories Management System--------------------------------------------------------------->
    protected function getCategoryPurl(Request $req){
        $purl = SlugService::createSlug(pCategories::class, 'purl', $req->pname);
        return response()->json([
            'status => true',
            'purl' => $purl
        ]);
    }

    protected function productCategories(){
        $cat_per = 20;
        $categories = pCategories::rightJoin('users','p_categories.puid','users.id')->where('p_categories.id','!=',null)->select('p_categories.*','users.name')->latest()->paginate($cat_per);
        return view ('backend.admin.categories',compact('categories'))->with('i',(request()->input('page',1)-1)*$cat_per);
    }
    protected function newCategory(){
        $title = 'New Category';
        $submission = null;
        $data = compact('title','submission');
        return view('backend.admin.new-categories')->with($data);
    }
    protected function updateCategory($id){
        $title = 'Update Category';
        $submission = null;
        $categories = pCategories::find($id);
        $data = compact('title','submission','categories');
        return view('backend.admin.new-categories')->with($data);
    }

    protected function categorySubmission(Request $req){
        $category = new pCategories;
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

        return redirect()->route('admin.categories')->with('message','New Category added Successfully.');
    }

    protected function categoryResubmission(Request $req,$id){
        $category = pCategories::find($id);
        $category->pname = $req->pname;
        $category->purl = $req->purl;
        if($req->file('image') != null){
            // $image_path = public_path('public/image', $blogCategory->cimage_path);
            $image_path = 'storage/image/'.$category->pimage_path;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $imgName = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $imgName;
            $req->file('image')->storeAs('public/image', $image);
            $category->pimage_path = $image;
        }
        $category->pdescription = $req->pdescription;
        $category->puid = Auth::user()->id;
        $category->update();
        return redirect()->route('admin.categories')->with('message','New Category added Successfully.');
    }
    //Delete Categories
    protected function deleteCategory($id){
        $Category = pCategories::find($id);
        // $image_path = public_path('public/image', $blogCategory->cimage_path);
        $image_path = 'storage/image/'.$Category->pimage_path;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $Category->delete();
        return redirect()->route('admin.categories')->with('message','The Category deleted Successfully.');
    }

    //Products Management Syetem------------------------------------------------------------------------------------>
    protected function getpSlug(Request $req){
        $slug = SlugService::createSlug(Products::class, 'slug', $req->pro_name);
        return response()->json([
            'status => true',
            'slug' => $slug
        ]);
    }
    protected function products(){
        $cat_per = 20;
        $products = Products::rightJoin('users','products.seller','users.id')->join('p_categories','products.category','p_categories.id')->where('products.id','!=',null)->select('products.*','users.name','p_categories.pname')->latest()->paginate($cat_per);
        return view ('backend.admin.products',compact('products'))->with('i',(request()->input('page',1)-1)*$cat_per);
    }
    protected function addProduct(){
        $title = 'New Product';
        $submission = null;
        $categories = pCategories::all();
        $data = compact('title','submission','categories');
        return view('backend.admin.new-product')->with($data);
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
        return redirect()->route('admin.products')->with('message','Product added Successfully');
    }
    protected function updateProduct($id){
        $product = Products::find($id);
        if (is_null($product)){
            return redirect()->route('admin.addProduct');
        }
        else{
            $title = 'Update Product';
            $submission = null;
            $categories = pCategories::all();
            $data = compact('title','submission','categories','product');
            return view('backend.admin.new-product')->with($data);

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
        return redirect()->route('admin.products')->with('message','Product updated Successfully');
    }

    protected function deleteProduct($id){
        $product = Products::find($id);
        // $image_path = public_path('public/image', $blogCategory->cimage_path);
        $image_path = 'storage/image/'.$product->image_path;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $product->delete();
        return redirect()->route('admin.products')->with('message','Product deleted Successfully.');
    }

    //Users Management Systems------------------------------------------------------------------------->
    protected function users(){
        $noPerPage = 15;
        $users = User::all();
        return view('backend.admin.users',compact('users'))->with('i',(request()->input('page',1)-1)*$noPerPage);

    }
    protected function updateUser($id){
        $user = User::find($id);
        return view('backend.admin.update-user',compact('user'));
    }
    protected function updatedUser(Request $req, $id){
        $user = User::find($id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = $req->role;
        $user->phone = $req->phone_no;
        $user->billing_address = $req->billing_address;
        $user->shipping_address = $req->shipping_address;
        $user->update();
        return redirect()->route('admin.users')->with('message','User updated successfully');
    }

    protected function orders(){
        $orders = Order::all();
        return view('backend.admin.orders',compact('orders'));
    }
    protected function orderSearch(Request $req){
        $noOfProducts = 20;
        $orders = Order::where('order_id','LIKE','%'.$req->order_id.'%')->latest()->paginate($noOfProducts);
        return view('backend.admin.orders',compact('orders'))->with('i',(request()->input('page',1)-1)*$noOfProducts);
    }
    protected function order_modify($order_id){
        $order = Order::where('order_id',$order_id)->first();
        $product = Products::where('id',$order->product_id)->first();
        $order_update = OrderUpdate::where('order_id',$order_id)->latest()->first();
        return view('backend.admin.order-update',compact('order','order_update','product'));
    }
    protected function orderSearchUpdate(Request $req){
        $order = Order::where('order_id', $req->order_id)->first();
        $order->status = $req->status ?? 'Processing';
        $order->update();
        $orderUpdate = new OrderUpdate();
        $orderUpdate->order_id = $req->order_id;
        $orderUpdate->status = $req->status ?? 'Processing';
        $orderUpdate->note = $req->note ?? '';
        $orderUpdate->save();
        return redirect()->back()->with('message','Order status update successfully.');
    }
}
