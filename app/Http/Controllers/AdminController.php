<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Posts;
use App\Models\Products;
use App\Models\Settings;
use App\Models\bCategories;
use App\Models\OrderUpdate;
use App\Models\pCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\Blog;
use App\Http\Controllers\Base\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\RedirectResponse;


class AdminController extends Controller
{

    //Extend Class
    protected function Blog(){
        $blog = new Blog();
        return $blog;
    }
    protected function Shop(){
        $shop = new Shop();
        return $shop;
    }
      //
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



    //Dashboard----------------------------------------------------------------------------------------->
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
        $items = ['name', 'phone_no', 'email', 'facebook', 'linkdin', 'twitter', 'pinterest', 'address', 'office_time', 'copyright'];
        if(is_null(Settings::where('id', 1)->first())){
            $settings = new Settings;
            foreach ($items as $item){
                $settings->$item = $req->$item;    
            }
            if(!is_null($req->file('image'))){
                $this->image_store($req->file('image'));
            }
            $settings->save();
        }
        else{
            $settings = Settings::where('id', 1)->first();
            foreach ($items as $item){
                $settings->$item = $req->$item;    
            }
            if(!is_null($req->file('image'))){
                $this->image_delete('storage/image/'.$settings->image_path);
                $this->image_store($req->file('image'));
            }
            $settings->update();

        }
        return redirect()->route('Settings (Admin)')->with('message','Settings updated Successfully.');
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
        $perpage = 12;
        $blog = $this->Blog();
        $categories = $blog->categories($perpage);
        return view ('backend.admin.blog.categories',compact('categories'))->with('i',(request()->input('page',1)-1)*$perpage);;

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
            return redirect()->route('Blog New Category (Admin)');
        }
        else{
        $title = 'Update Category';
        $submission = null;
        $data = compact('categories','title','submission');
        return view('backend.admin.blog.new-category')->with($data);
        }
    }
    protected function blogAddCategorySubmission(Request $req) : RedirectResponse{
        $req->validate(
            [
                'cname' => 'required',
                'cdescription' => 'required'
            ]
            );
        $items = ['cname', 'curl', 'cdescription'];
        $category = $this->Blog();
        $category->category_submission($req, $items, Auth::user()->id);
        return redirect()->route('Blog Categories (Admin)')->with('message','New Category added Successfully.');
    }
    protected function blogUpdateCategorySubmission(Request $req,$id) : RedirectResponse{
        $req->validate(
            [
                'cname' => 'required',
                'cdescription' => 'required'
            ]
            );
        $items = ['cname', 'curl', 'cdescription'];
        $category = $this->Blog();
        $category->category_resubmission($id, $req, $items, Auth::user()->id );
        return redirect()->route('Blog Categories (Admin)')->with('message','The Category updated Successfully.');
    }

    //Delete Blog Categories
    protected function blogDeleteCategory($id){
        $category = $this->Blog();
        $category->delete_category($id);
        return redirect()->route('Blog Categories (Admin)')->with('message','The Category deleted Successfully.');
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
        $perpage = 20;
        $post = $this->Blog();
        $posts = $post->admin_read($perpage);
        return view ('backend.admin.blog.posts',compact('posts'))->with('i',(request()->input('page',1)-1)*$perpage);
    }
    protected function addPost(){
        $title = 'Add a Post';
        $submission = null;
        $categories = bCategories::all();
        $data = compact('title','submission','categories');
        return view('backend.admin.blog.new-post')->with($data);
    }
    protected function postSubmission(Request $req) : RedirectResponse {
        $req->validate(
            [
                'title' => 'required',
                'content' => 'required',
                'tag' => 'required'
            ]);
        $items = ['title', 'slug', 'content', 'tag', 'status', 'category'];
        $blog =  $this->Blog();
        $action = $blog->create($req, $items, Auth::user()->id);
        if ($action == true){
            $message = 'The Post added Successfully';
        }
        else {
            $message = 'Something went wrong';
        }
        return redirect()->back()->with('message',$message);
    }

    protected function updatePost($id){
        $getPost = Posts::where('id', $id)->first();
        $title = 'Update Content of the Post';
        $post_id = $id;
        $submission = null;
        $categories = bCategories::all();
        $data = compact('title','submission','categories','getPost','post_id');
        return view('backend.admin.blog.new-post')->with($data);
    }
    protected function postSubmissionUpdate(Request $req, $id) : RedirectResponse {
        $req->validate(
            [
                'title' => 'required',
                'content' => 'required',
                'tag' => 'required'
            ]);
        $items = ['title', 'slug', 'content', 'tag', 'status', 'category'];
        $post_id = $id;
        $blog = $this->Blog();
        $blog->update($post_id , $req, $items, Auth::user()->id);
        return redirect()->back()->with('message','The Post updated Successfully');
    }
    protected function deletePost($id){
        $post = Posts::where('id', $id)->first();
        $image_path = $post->image_path;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $post->delete();
        return redirect()->route('Posts (Admin)')->with('message','The Post deleted Successfully');

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
        $perpage = 20;
        $shop = $this->Shop();
        $categories = $shop->read_category($perpage);
        return view ('backend.admin.categories',compact('categories'))->with('i',(request()->input('page',1)-1)*$perpage);
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

    protected function categorySubmission(Request $req) : RedirectResponse{
        $req->validate([
            'pname' => 'required',
            'pdescription' => 'required'
        ]);
        $items = ['pname', 'purl', 'pdescription'];
        $shop = $this->Shop();
        $shop->submission_category($req, $items, Auth::user()->id);
        return redirect()->route('Product Categories (Admin)')->with('message','New Category added Successfully.');
    }
  
    protected function categoryResubmission(Request $req,$id) : RedirectResponse{
        $req->validate([
            'pname' => 'required',
            'pdescription' => 'required'
        ]);
        $items = ['pname', 'purl', 'pdescription'];
        $shop = $this->Shop();
        $shop->resubmission_category($id, $req, $items, Auth::user()->id);
        return redirect()->route('Product Categories (Admin)')->with('message','New Category added Successfully.');
    }
    //Delete Categories
    protected function deleteCategory($id){
        $shop = $this->Shop();
        $category = $shop->delete_category($id);
        return redirect()->route('Product Categories (Admin)')->with('message','The Category deleted Successfully.');
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
        $perpage = 12;
        $shop = $this->Shop();
        $products = $shop->read($perpage);
        return view ('backend.admin.products',compact('products'))->with('i',(request()->input('page',1)-1)*$perpage);
    }
    protected function addProduct(){
        $title = 'New Product';
        $submission = null;
        $categories = pCategories::all();
        $data = compact('title','submission','categories');
        return view('backend.admin.new-product')->with($data);
    }
    protected function addedProduct(Request $req) : RedirectResponse {
        $req->validate(
            [
                'pro_name' => 'required',
                'orginal_price' =>'required',
                'description' => 'required'
            ]);
        
        $items = ['pro_name', 'slug', 'category', 'orginal_price', 'discount_price', 'availability', 'shipping', 'weight', 'description', 'information'];
        $shop = $this->Shop();
        $action = $shop->product_submitted($req, $items, Auth::user()->id);
        if ($action == true){
            $message = 'Product Added Successful';
        }
        else{
            $message = 'Something went wrong';
        }
        return redirect()->route('Products (Admin)')->with('message',$message);
    }
    protected function updateProduct($id){
        $product = Products::where('id', $id)->first();
        $title = 'Update Product';
        $submission = null;
        $categories = pCategories::all();
        $data = compact('title','submission','categories','product');
        return view('backend.admin.new-product')->with($data);
    }
    protected function  updatedProduct(Request $req, $id) : RedirectResponse{
        $req->validate(
            [
                'pro_name' => 'required',
                'orginal_price' =>'required',
                'description' => 'required'
            ]);
        $items = ['pro_name', 'slug', 'category', 'orginal_price', 'discount_price', 'availability', 'shipping', 'weight', 'description', 'information'];
        $shop = $this->Shop();
        $product = $shop->product_resubmitted($id, $req, $items, Auth::user()->id);
        return redirect()->route('Products (Admin')->with('message','Product updated Successfully');
    }

    protected function deleteProduct($id){
        $shop = $this->Shop();
        $product =$shop->delete_product($id); 
        return redirect()->route('Products (Admin)')->with('message','Product deleted Successfully.');
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
        return redirect()->route('Users (Admin)')->with('message','User updated successfully');
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
