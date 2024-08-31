<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\review;
use App\Models\Thumnail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $total_star = review::sum('star');
        $product_info = Product::first();
        $products = Product::orderBy('created_at', 'desc')->paginate(24);
        return view('frontend.index',[
            'products'=>$products,
            'product_info'=>$product_info,
            'reviews'=> review::all(),
            'total_star'=>$total_star
        ]);
    }
    public function details($slug){
        $product_info = Product::where('slug',$slug)->first();
        $thamnails = Thumnail::where('product_id',$product_info->id)->get();
        $products = Product::orderBy('created_at', 'desc')->paginate(24);
        
        return view('frontend.page.details',[
            'product_info'=>$product_info,
            'products'=>$products,
            'thamnails'=>$thamnails,
        ]);
    }

    public function orderConfirm(Request $request){
        $order_id = '#'.Str::upper(Str::random(3)).'-'.rand(99999999,1000000000);
        $rules = [
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'required|numeric',
            'productCode' => 'nullable',
            'address' => 'required|string'
        ];
        $validatedData = $request->validate($rules);
        $validatedData['orderId'] = $order_id;
        Order::create($validatedData);

        $abc = substr($order_id, 1,13);
        return redirect()->route('order.success',$abc)->with('success','adaa');

        // return view('frontend.page.checkout');
    }
    public function orderSuccess($abc){

        echo 'success';
        if(session('success')){
            return view('frontend.page.order_success',[
                'order_id'=>$abc,
            ]);
        }
        else {
            abort(404);
        }
    }

    public function reviewStore(Request $request){
        $rules = [
            'name'=>'required|string',
            'comment'=>'required|string',
            'star'=>'required|string',
        ];
        $validatedData = $request->validate($rules);
        review::create($validatedData);
        return response()->json(['success' => 'Message Sent!']);
    }

}
