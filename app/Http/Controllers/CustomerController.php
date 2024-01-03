<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Products;
use App\Models\Order;
use App\Models\OrderUpdate;

class CustomerController extends Controller
{
    //
    public function home(){
        return view('backend.customer.dashboard');
    }
    protected function myorders(){
        $noOfOrders = 12;
        $orders = Order::where('uid',Auth::user()->id)->latest()->paginate($noOfOrders);
        return view('backend.customer.myorder',compact('orders'))->with('i',(request()->input('page',1)-1)*$noOfOrders);

    }
    protected function myorderdetails($order_id){
        $order = Order::where('order_id',$order_id)->first();
        $product = Products::where('id',$order->product_id)->first();
        $order_updates = OrderUpdate::where('order_id',$order_id)->get();
        return view('backend.customer.order-details',compact('order','order_updates','product'));
    }
    protected function myinfo(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('backend.customer.userinfo',compact('user'));
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
        return redirect()->back()->with('message','Update Info Successfully');
    }

}
