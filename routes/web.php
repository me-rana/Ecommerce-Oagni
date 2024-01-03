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
    Route::get('/',[FrontendController::class,'home'])->name('Home');
    Route::get('/back',[FrontendController::class,'sendMeBack'])->name('sendMeBack');
    Route::get('shop',[FrontendController::class,'shop'])->name('Shop');
    Route::get('search',[FrontendController::class,'searchResult'])->name('Search Result');
    Route::get('category/{purl}',[FrontendController::class,'categoryAction'])->name('Product Category Action');
    Route::get('blog',[FrontendController::class,'blog'])->name('Blog');
    Route::get('blog-category/{curl}',[FrontendController::class,'blogCategoryAction'])->name('Blog Category Action');
    Route::get('blog-search',[FrontendController::class,'blogSearch'])->name('Blog Search');
    Route::get('blog/{slug}',[FrontendController::class,'singlePost'])->name('Single Post');
    Route::get('contact',[FrontendController::class,'contact'])->name('Contact');
    Route::post('contact',[FrontendController::class,'contactSubmission'])->name('Contact Submission');
    Route::get('single-product',[FrontendController::class,'singleProduct'])->name('Single Product');
    Route::post('single-product',[FrontendController::class,'singleCart'])->name('Single Cart');
    Route::get('product/{slug}',[FrontendController::class,'productDetails'])->name('product Details');
    Route::get('add-cart/{id}',[FrontendController::class,'productCart'])->name('Product Cart');
    Route::get('shoping-cart',[FrontendController::class,'shopingCart'])->name('Shoping Cart');
    Route::post('shoping-cart',[FrontendController::class,'updateCart'])->name('Update Cart');
    Route::get('delete-cart/{id}',[FrontendController::class,'deleteCart'])->name('Delete Cart');
    Route::get('checkout',[FrontendController::class,'checkout'])->name('Checkout');
    Route::post('checkout',[FrontendController::class,'order'])->name('Order');
    Route::get('access-denied',[FrontendController::class,'access_denied'])->name('Denied');
    Route::get('mydashboard',[AuthRedirectController::class,'mydashboard'])->name('mydashboard');

});

//All User

//Admin
Route::middleware([
    'auth:sanctum',
    'auth.permit:3',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin',[AdminController::class,'home'] )->name('Dashboard (Admin)');
    //Settings Management System------------------------------------------------------------------->
    Route::get('admin/settings',[AdminController::class,'settings'] )->name('Settings (Admin)');
    Route::post('admin/settings',[AdminController::class,'settings_submission'] )->name('admin.settings.submit');
    // Category for Blog Posts---------------------------------------------------------------------->
    Route::get('admin/blog/get-blog-curl',[AdminController::class,'getBlogCurl'])->name('admin.blog.getBlogCurl');
    Route::get('admin/blog/categories',[AdminController::class,'blogCategories'] )->name('Blog Categories (Admin)');
    Route::get('admin/blog/add-category',[AdminController::class,'blogAddCategory'] )->name('Blog New Category (Admin)');
    Route::get('admin/blog/update-category/{id}',[AdminController::class,'blogUpdateCategory'] )->name('Blog Update Category (Admin)');
    Route::post('admin/blog/add-category',[AdminController::class,'blogAddCategorySubmission'] )->name('admin.blog.addedCategory');
    Route::post('admin/blog/update-category/{id}',[AdminController::class,'blogUpdateCategorySubmission'] )->name('admin.blog.updatedCategory');
    Route::get('admin/blog/delete-category/{id}',[AdminController::class,'blogDeleteCategory'] )->name('admin.blog.DeleteCategory');
    // Blog Posts Section--------------------------------------------------------------------------->
    Route::get('admin/blog/get-slug',[AdminController::class,'getSlug'])->name('admin.blog.getSlug');
    Route::get('admin/blog/posts',[AdminController::class,'posts'])->name('Posts (Admin)');
    Route::get('admin/blog/add-posts',[AdminController::class,'addPost'])->name('New Post (Admin)');
    Route::post('admin/blog/add-posts',[AdminController::class,'PostSubmission'])->name('admin.blog.addedSubmission');
    Route::get('admin/blog/update-post/{id}',[AdminController::class,'updatePost'])->name('Update Post(Admin)');
    Route::post('admin/blog/update-post/{id}',[AdminController::class,'PostSubmissionUpdate'])->name('admin.blog.updatedPost');
    Route::get('admin/blog/delete-post/{id}',[AdminController::class,'deletePost'])->name('admin.blog.deletePost');
    // Product Category Management------------------------------------------------------------------->
    Route::get('admin/get-slugcategory',[AdminController::class,'getCategoryPurl'])->name('admin.getPurl');
    Route::get('admin/categories',[AdminController::class,'productCategories'])->name('Product Categories (Admin)');
    Route::get('admin/add-category',[AdminController::class,'newCategory'])->name('Product New Category (Admin)');
    Route::post('admin/add-category',[AdminController::class,'categorySubmission'])->name('admin.addedCategory');
    Route::get('admin/update-category/{id}',[AdminController::class,'updateCategory'])->name('Product Update Category (Admin)');
    Route::post('admin/update-category/{id}',[AdminController::class,'categoryResubmission'])->name('admin.updatedCategory');
    Route::get('admin/delete-category/{id}',[AdminController::class,'deleteCategory'])->name('admin.deleteCategory');
    // Product Management System
    Route::get('admin/get-slug',[AdminController::class,'getpSlug'])->name('admin.getpSlug');
    Route::get('admin/products',[AdminController::class,'Products'])->name('Products (Admin)');
    Route::get('admin/add-product',[AdminController::class,'addProduct'])->name('New Product (Admin)');
    Route::post('admin/add-product',[AdminController::class,'addedProduct'])->name('admin.addedProduct');
    Route::get('admin/update-product/{id}',[AdminController::class,'updateProduct'])->name('Update Product (Admin)');
    Route::post('admin/update-product/{id}',[AdminController::class,'updatedProduct'])->name('admin.updatedProduct');
    Route::get('admin/delete-product/{id}',[AdminController::class,'deleteProduct'])->name('admin.deleteProduct');
    // Users Management System
    Route::get('admin/users',[AdminController::class,'users'])->name('Users (Admin)');
    Route::get('admin/update-user/{id}',[AdminController::class,'updateUser'])->name('Update User (Admin)');
    Route::post('admin/update-user/{id}',[AdminController::class,'updatedUser'])->name('admin.updatedUser');
    // Order Management
    Route::get('admin/orders',[AdminController::class,'orders'])->name('Orders (Admin)');
    Route::get('admin/order-modify/{order_id}',[AdminController::class,'order_modify'])->name('Order Update (Admin)');
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
    Route::get('/seller',[ResellerController::class,'home'] )->name('Dashboard (Seller)');

    //Product Categories
    Route::get('seller/get-slugcategory',[ResellerController::class,'getCategoryPurl'])->name('seller.getPurl');
    Route::get('seller/categories',[ResellerController::class,'productCategories'])->name('Product Categories (Seller)');
    Route::get('seller/add-category',[ResellerController::class,'newCategory'])->name('Product New Category (Seller)');
    Route::post('seller/add-category',[ResellerController::class,'categorySubmission'])->name('seller.requestedCategory');

    //Products

    Route::get('seller/get-slug',[ResellerController::class,'getpSlug'])->name('seller.getpSlug');
    Route::get('seller/products',[ResellerController::class,'Products'])->name('Products (Seller)');
    Route::get('seller/add-product',[ResellerController::class,'addProduct'])->name('New Product (Seller)');
    Route::post('seller/add-product',[ResellerController::class,'addedProduct'])->name('seller.addedProduct');
    Route::get('seller/update-product/{id}',[ResellerController::class,'updateProduct'])->name('Update Product Seller');
    Route::post('seller/update-product/{id}',[ResellerController::class,'updatedProduct'])->name('seller.updatedProduct');
    Route::get('seller/delete-product/{id}',[ResellerController::class,'deleteProduct'])->name('seller.deleteProduct');
    //MyInfo
    Route::get('seller/myinfo',[ResellerController::class,'myInfo'])->name('My Info (Seller)');
    Route::post('seller/myinfo',[ResellerController::class,'myInfoUpdated'])->name('seller.updatedmyinfo');
    //Order
    Route::get('seller/orders',[ResellerController::class,'orders'])->name('Orders (Seller)');
    Route::get('seller/order-modify/{order_id}',[ResellerController::class,'order_modify'])->name('Order Update (Seller)');
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
    Route::get('/customer',[CustomerController::class,'home'] )->name('Dashboard (Customer)');
    Route::get('/customer/myorders',[CustomerController::class,'myorders'] )->name('My Order (Customer)');
    Route::get('/customer/myorder/{order_id}',[CustomerController::class,'myorderdetails'] )->name('Order Details (Customer)');
    Route::get('/customer/myinfo',[CustomerController::class,'myinfo'] )->name('My Info (Customer)');
    Route::post('/customer/myinfo',[CustomerController::class,'myinfoUpdated'] )->name('customer.updatedmyinfo');

});

