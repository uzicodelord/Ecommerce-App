<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Stripe;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    public function index(){
        $categories = Category::orderBy('category_name', 'asc')->get();
        $products = Product::paginate(9);
        return view('home.userpage', compact('products', 'categories'));
    }

    public function redirect(){
        $usertype = Auth::user()->usertype;

        if ($usertype == '1'){

            $totalproducts = Product::all()->count();
            $totalorders = Order::all()->count();
            $totalcustomers = User::all()->count();

            $orders = Order::all();
            $totalrevenue = 0;

            foreach ($orders as $order){
                $totalrevenue = $totalrevenue + $order->price;
            }

            $ordersdelivered = Order::where('delivery_status','=','Delivered')->get()->count();

            $ordersprocessing = Order::where('delivery_status','=','Processing')->get()->count();

            return view('admin.home',compact('totalproducts', 'totalorders', 'totalcustomers', 'totalrevenue', 'ordersdelivered', 'ordersprocessing'));
        }
        else{
            $categories = Category::orderBy('category_name', 'asc')->get();
            $products = Product::paginate(9);
            return view('home.userpage', compact('products', 'categories'));
        }
    }



    public function productDetails($id){
        $categories = Category::orderBy('category_name', 'asc')->get();
        $product = Product::find($id);
        $attributes = Attribute::where('product_id', $id)->get();

        return view('home.productdetails', compact('product', 'categories', 'attributes'));
    }


    public function addToCart(Request $request, $id) {
        if (Auth::id()) {
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;

            if ($product->discountprice != null) {
                $total_price = $product->discountprice * $request->quantity;
            } else {
                $total_price = $product->price * $request->quantity;
            }

            $cart->price = $total_price;
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;
            $cart->attribute_id = $request->id;
            $cart->attribute_value = $request->attribute;
            // add selected attribute value to the cart item
            $cart->save();

            Alert::success('Product Successfully Added To The Cart');

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }




    public function showCart(){

        $categories = Category::orderBy('category_name', 'asc')->get();
        if (Auth::id()){
            $id = Auth::user()->id;

            $cart = Cart::where('user_id', '=', $id)->get();

            return view('home.showcart', compact('cart', 'categories'));
        }
        else{
            return redirect('login');
        }
    }



    public function removefromCart($id){
        $cart = Cart::find($id);
        $cart->delete();

        Alert::success('Product Deleted Successfully From The Cart');

        return redirect()->back();
    }

    public function payment(){
        $user = Auth::user();
        $user_id = $user->id;

        $orders = [];
        $cart_ids = [];

        $data = Cart::where('user_id', '=', $user_id)->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('message', 'You do not have anything in your cart.');
        }

        foreach ($data as $cart) {
            $order = new Order();

            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->phone = $cart->phone;
            $order->address = $cart->address;
            $order->user_id = $cart->user_id;
            $order->product_title = $cart->product_title;
            $order->price = $cart->price;
            $order->quantity = $cart->quantity;
            $order->image = $cart->image;
            $order->product_id = $cart->product_id;
            $order->attribute_id = $cart->attribute_id;
            $order->attribute_value = $cart->attribute_value;
            $order->payment_status = 'Cash on delivery';
            $order->delivery_status = 'Processing';

            $orders[] = $order;
            $cart_ids[] = $cart->id;
        }

        // Save all orders in one transaction
        DB::transaction(function () use ($orders, $cart_ids) {
            foreach ($orders as $order) {
                $order->save();
            }

            // Delete all cart items in one query
            Cart::whereIn('id', $cart_ids)->delete();
        });

        Alert::success('We have received your order. We will contact you shortly!');

        return redirect()->back();
    }


    public function stripe($totalprice){
        $categories = Category::orderBy('category_name', 'asc')->get();
        return view('home.stripe',compact('totalprice', 'categories'));
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey('sk_test_51MlbYXEY5qD0fPtLLyONPeBkgNVb53vSqDRWXh5Ci3wBWfOgl6Wa61txzcFyUwyClgOh3Cxmym3vFGslirEOy0yU0080SfOX26');

        Stripe\Charge::create ([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for purchasing."
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $orders = [];
        $cart_ids = [];

        $data = Cart::where('user_id', '=', $user_id)->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('message', 'You do not have anything in your cart.');
        }

        foreach ($data as $cart) {
            $order = new Order();

            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->phone = $cart->phone;
            $order->address = $cart->address;
            $order->user_id = $cart->user_id;
            $order->product_title = $cart->product_title;
            $order->price = $cart->price;
            $order->quantity = $cart->quantity;
            $order->image = $cart->image;
            $order->product_id = $cart->product_id;
            $order->attribute_id = $cart->attribute_id;
            $order->attribute_value = $cart->attribute_value;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'Processing';

            $orders[] = $order;
            $cart_ids[] = $cart->id;
        }

        // Save all orders in one transaction
        DB::transaction(function () use ($orders, $cart_ids) {
            foreach ($orders as $order) {
                $order->save();
            }

            // Delete all cart items in one query
            Cart::whereIn('id', $cart_ids)->delete();
        });

        Alert::success( 'Payment successful!');

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $searchQuery = $request->input('query');
        $products = Product::where('title', 'LIKE', "%$searchQuery%")
            ->orWhere('description', 'LIKE', "%$searchQuery%")
            ->orWhere('category', 'LIKE', "%$searchQuery%")
            ->paginate(9);
        return view('home.search', compact('products', 'searchQuery', 'categories'));
    }


}
