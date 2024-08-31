<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\BuyCart;
use App\Models\Cart;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Request $request) {
        if($request->click == 1){
            if (!session()->has('customer_id')) {
                session(['customer_id' => uniqid()]);
            }
            
            $customer_id = session('customer_id');
            BuyCart::where('customer_id', $customer_id)->delete();
            $cart = BuyCart::create([
                'customer_id' => $customer_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
            $carts = BuyCart::where('customer_id', $customer_id)->get();
            return view('frontend.page.checkout', [
                'carts' => $carts
            ]);
        }else{
            if (!session()->has('customer_id')) {
                session(['customer_id' => uniqid()]);
            }
            $customer_id = session('customer_id');
            $carts = Cart::where('customer_id', $customer_id)->get();
            return view('frontend.page.checkout', [
                'carts' => $carts
            ]);
        }
        
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'charge' => 'required',
        ]);
        
        $order_id = '#'.Str::upper(Str::random(3)).'-'.rand(99999999,1000000000);
        BillingDetails::insert([
            'order_id'=>$order_id,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'created_at'=>Carbon::now(),
        ]);

        if (!session()->has('customer_id')) {
            session(['customer_id' => uniqid()]);
        }
        $customer_id = session('customer_id');
        $carts = cart::where('customer_id',$customer_id)->get();

        
        foreach($carts as $cart){
            $total = $request->subtotal + $request->charge;
            OrderProduct::insert([
                'order_id'=>$order_id,
                'product_id'=>$cart->product_id,
                'price'=>$cart->product->after_discount,
                'sub_total'=>$request->subtotal,
                'charge'=>$request->charge,
                'total'=>$total,
                'discount'=>$request->discount,
                'quantity'=>$cart->quantity,
                'created_at'=>Carbon::now(),
            ]);
        }
        //clear cart after order
        Cart::where('customer_id',$customer_id)->delete();
        return back();

        // return redirect()->route('order.success')->with('success','adaa');  
    }
}
