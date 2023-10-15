<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\AuthRedirectController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Frontend Controller Use for Management Public Views
Route::prefix('/')->group(function () {
    Route::get('/',[FrontendController::class,'home'])->name('home');
    Route::get('/back',[FrontendController::class,'sendMeBack'])->name('sendMeBack');
    Route::get('shop',[FrontendController::class,'shop'])->name('shop');
    Route::get('search',[FrontendController::class,'searchResult'])->name('search.result');
    Route::get('category/{purl}',[FrontendController::class,'categoryAction'])->name('categoryAction');
    Route::get('blog',[FrontendController::class,'blog'])->name('blog');
    Route::get('blog-category/{curl}',[FrontendController::class,'blogCategoryAction'])->name('blogCategoryAction');
    Route::get('blog-search',[FrontendController::class,'blogSearch'])->name('blogSearch');
    Route::get('blog/{slug}',[FrontendController::class,'singlePost'])->name('singlePost');
    Route::get('contact',[FrontendController::class,'contact'])->name('contact');
    Route::post('contact',[FrontendController::class,'contactSubmission'])->name('contactSubmission');
    Route::get('single-product',[FrontendController::class,'singleProduct'])->name('singleProduct');
    Route::post('single-product',[FrontendController::class,'singleCart'])->name('singleCart');
    Route::get('product/{slug}',[FrontendController::class,'productDetails'])->name('productDetails');
    Route::get('add-cart/{id}',[FrontendController::class,'productCart'])->name('productCart');
    Route::get('shoping-cart',[FrontendController::class,'shopingCart'])->name('shopingCart');
    Route::post('shoping-cart',[FrontendController::class,'updateCart'])->name('update.Cart');
    Route::get('delete-cart/{id}',[FrontendController::class,'deleteCart'])->name('deleteCart');
    Route::get('checkout',[FrontendController::class,'checkout'])->name('checkout');
    Route::post('checkout',[FrontendController::class,'order'])->name('order');
    Route::get('access-denied',[FrontendController::class,'access_denied'])->name('denied');
    Route::get('mydashboard',[AuthRedirectController::class,'mydashboard'])->name('mydashboard');

});

//All User
Route::middleware([
    'auth:sanctum',
    'auth.permit:0',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Admin
Route::middleware([
    'auth:sanctum',
    'auth.permit:3',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin',[AdminController::class,'home'] )->name('admin.dashboard');
    //Settings Management System------------------------------------------------------------------->
    Route::get('admin/settings',[AdminController::class,'settings'] )->name('admin.settings');
    Route::post('admin/settings',[AdminController::class,'settings_submission'] )->name('admin.settings.submit');
    // Category for Blog Posts---------------------------------------------------------------------->
    Route::get('admin/blog/get-blog-curl',[AdminController::class,'getBlogCurl'])->name('admin.blog.getBlogCurl');
    Route::get('admin/blog/categories',[AdminController::class,'blogCategories'] )->name('admin.blog.categories');
    Route::get('admin/blog/add-category',[AdminController::class,'blogAddCategory'] )->name('admin.blog.addCategory');
    Route::get('admin/blog/update-category/{id}',[AdminController::class,'blogUpdateCategory'] )->name('admin.blog.updateCategory');
    Route::post('admin/blog/add-category',[AdminController::class,'blogAddCategorySubmission'] )->name('admin.blog.addedCategory');
    Route::post('admin/blog/update-category/{id}',[AdminController::class,'blogUpdateCategorySubmission'] )->name('admin.blog.updatedCategory');
    Route::get('admin/blog/delete-category/{id}',[AdminController::class,'blogDeleteCategory'] )->name('admin.blog.DeleteCategory');
    // Blog Posts Section--------------------------------------------------------------------------->
    Route::get('admin/blog/get-slug',[AdminController::class,'getSlug'])->name('admin.blog.getSlug');
    Route::get('admin/blog/posts',[AdminController::class,'posts'])->name('admin.blog.posts');
    Route::get('admin/blog/add-posts',[AdminController::class,'addPost'])->name('admin.blog.addPost');
    Route::post('admin/blog/add-posts',[AdminController::class,'PostSubmission'])->name('admin.blog.addedSubmission');
    Route::get('admin/blog/update-post/{id}',[AdminController::class,'updatePost'])->name('admin.blog.updatePost');
    Route::post('admin/blog/update-post/{id}',[AdminController::class,'PostSubmissionUpdate'])->name('admin.blog.updatedPost');
    Route::get('admin/blog/delete-post/{id}',[AdminController::class,'deletePost'])->name('admin.blog.deletePost');
    // Product Category Management------------------------------------------------------------------->
    Route::get('admin/get-slugcategory',[AdminController::class,'getCategoryPurl'])->name('admin.getPurl');
    Route::get('admin/categories',[AdminController::class,'productCategories'])->name('admin.categories');
    Route::get('admin/add-category',[AdminController::class,'newCategory'])->name('admin.addCategory');
    Route::post('admin/add-category',[AdminController::class,'categorySubmission'])->name('admin.addedCategory');
    Route::get('admin/update-category/{id}',[AdminController::class,'updateCategory'])->name('admin.updateCategory');
    Route::post('admin/update-category/{id}',[AdminController::class,'categoryResubmission'])->name('admin.updatedCategory');
    Route::get('admin/delete-category/{id}',[AdminController::class,'deleteCategory'])->name('admin.deleteCategory');
    // Product Management System
    Route::get('admin/get-slug',[AdminController::class,'getpSlug'])->name('admin.getpSlug');
    Route::get('admin/products',[AdminController::class,'Products'])->name('admin.products');
    Route::get('admin/add-product',[AdminController::class,'addProduct'])->name('admin.addProduct');
    Route::post('admin/add-product',[AdminController::class,'addedProduct'])->name('admin.addedProduct');
    Route::get('admin/update-product/{id}',[AdminController::class,'updateProduct'])->name('admin.updateProduct');
    Route::post('admin/update-product/{id}',[AdminController::class,'updatedProduct'])->name('admin.updatedProduct');
    Route::get('admin/delete-product/{id}',[AdminController::class,'deleteProduct'])->name('admin.deleteProduct');
    // Users Management System
    Route::get('admin/users',[AdminController::class,'users'])->name('admin.users');
    Route::get('admin/update-user/{id}',[AdminController::class,'updateUser'])->name('admin.updateUser');
    Route::post('admin/update-user/{id}',[AdminController::class,'updatedUser'])->name('admin.updatedUser');
    // Order Management
    Route::get('admin/orders',[AdminController::class,'orders'])->name('admin.orders');
    Route::get('admin/order-modify/{order_id}',[AdminController::class,'order_modify'])->name('admin.orderModify');
    Route::get('admin/orders/search',[AdminController::class,'orderSearch'])->name('admin.orderSearch');
    Route::post('admin/orders',[AdminController::class,'orderSearchUpdate'])->name('admin.orderSearchUpdate');





});

//Reseller
Route::middleware([
    'auth:sanctum',
    'auth.permit:2',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/seller',[ResellerController::class,'home'] )->name('seller.dashboard');

    //Product Categories
    Route::get('seller/get-slugcategory',[ResellerController::class,'getCategoryPurl'])->name('seller.getPurl');
    Route::get('seller/categories',[ResellerController::class,'productCategories'])->name('seller.categories');
    Route::get('seller/add-category',[ResellerController::class,'newCategory'])->name('seller.addCategory');
    Route::post('seller/add-category',[ResellerController::class,'categorySubmission'])->name('seller.requestedCategory');

    //Products

    Route::get('seller/get-slug',[ResellerController::class,'getpSlug'])->name('seller.getpSlug');
    Route::get('seller/products',[ResellerController::class,'Products'])->name('seller.products');
    Route::get('seller/add-product',[ResellerController::class,'addProduct'])->name('seller.addProduct');
    Route::post('seller/add-product',[ResellerController::class,'addedProduct'])->name('seller.addedProduct');
    Route::get('seller/update-product/{id}',[ResellerController::class,'updateProduct'])->name('seller.updateProduct');
    Route::post('seller/update-product/{id}',[ResellerController::class,'updatedProduct'])->name('seller.updatedProduct');
    Route::get('seller/delete-product/{id}',[ResellerController::class,'deleteProduct'])->name('seller.deleteProduct');
    //MyInfo
    Route::get('seller/myinfo',[ResellerController::class,'myInfo'])->name('seller.myinfo');
    Route::post('seller/myinfo',[ResellerController::class,'myInfoUpdated'])->name('seller.updatedmyinfo');
    //Order
    Route::get('seller/orders',[ResellerController::class,'orders'])->name('seller.orders');
    Route::get('seller/order-modify/{order_id}',[ResellerController::class,'order_modify'])->name('seller.orderModify');
    Route::get('seller/orders/search',[ResellerController::class,'orderSearch'])->name('seller.orderSearch');
    Route::post('seller/orders',[ResellerController::class,'orderSearchUpdate'])->name('seller.orderSearchUpdate');


});


//Customer
Route::middleware([
    'auth:sanctum',
    'auth.permit:1',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/customer',[CustomerController::class,'home'] )->name('customer.dashboard');
    Route::get('/customer/myorders',[CustomerController::class,'myorders'] )->name('customer.myorder');
    Route::get('/customer/myorder/{order_id}',[CustomerController::class,'myorderdetails'] )->name('customer.myorderdetails');
    Route::get('/customer/myinfo',[CustomerController::class,'myinfo'] )->name('customer.myinfo');
    Route::post('/customer/myinfo',[CustomerController::class,'myinfoUpdated'] )->name('customer.updatedmyinfo');

});

