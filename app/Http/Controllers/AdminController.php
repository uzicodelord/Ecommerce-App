<?php

namespace App\Http\Controllers;

use App\Mail\ThankYouMail;
use App\Models\Attribute;
use App\Models\Order;
use App\Notifications\SendEmailNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function viewCategory()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function addCategory(Request $request)
    {
        $data = new Category();
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('message', 'Category added successfully');
    }

    public function deleteCategory($id)
    {
        $data = Category::find($id);
        $data->delete();

        return redirect()->back()->with('message', 'Category deleted successfully');
    }

    public function viewProduct()
    {
        $category = Category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discountprice = $request->discountprice;
        $product->category = $request->category;

        // Upload and save the main image
        $image = $request->image;
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $image_name);
            $product->image = $image_name;
        }

        // Upload and save the first image
        $image1 = $request->image1;
        if ($image1) {
            $image1_name = time() . '_1.' . $image1->getClientOriginalExtension();
            $request->image1->move('product', $image1_name);
            $product->image1 = $image1_name;
        }

        // Upload and save the second image
        $image2 = $request->image2;
        if ($image2) {
            $image2_name = time() . '_2.' . $image2->getClientOriginalExtension();
            $request->image2->move('product', $image2_name);
            $product->image2 = $image2_name;
        }

        $product->save();

        $attributes = $request->input('attributes', []);
        foreach ($attributes as $attribute) {
            $value = $attribute['value'];
            $name = $request->input('attribute_name');

            $productAttribute = new Attribute();
            $productAttribute->value = $value;
            $productAttribute->name = $name;

            $product->attributes()->save($productAttribute);
        }
        return redirect()->back()->with('message', 'Product added successfully');
    }


    public function showProduct()
    {
        $product = Product::all();
        $attributes = Attribute::all();

        return view('admin.showProduct', compact('product', 'attributes'));
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('message', 'Product deleted from list');
    }

    public function updateProduct($id)
    {
        $product = Product::find($id);
        $category = Category::all();

        return view('admin.update',compact('product', 'category'));
    }

    public function updateProductConfirm(Request $request,$id){
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discountprice = $request->discount_price;
        $product->category = $request->category;
        $image = $request->image;
        if ($image){
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();

        $attributes = $request->input('attributes', []);
        foreach ($attributes as $attribute) {
            $value = $attribute['value'];

            $productAttribute = new Attribute();
            $productAttribute->name = "Color";
            $productAttribute->value = $value;

            $product->attributes()->save($productAttribute);
        }

        return redirect()->back()->with('message', 'Product updated successfully');
    }

    public function orders(){
        $orders = Order::latest()->get();

        return view('admin.orders', compact('orders'));
    }

    public function searchOrders(Request $request)
    {
        $search = $request->input('search');
        $orders = Order::where('name', 'like', '%'.$search.'%')
            ->orWhere('id', $search)
            ->get();
        return view('admin.orders', compact('orders'));
    }


    public function delivered($id){

        $order = Order::find($id);

        $order->delivery_status="Delivered";

        $order->payment_status = "Paid";

        $order->save();

        return redirect()->back();
    }
    public function sendmail($id){
        $order = Order::find($id);

        return view('admin.emailinfo',compact('order'));
    }

    public function sendmailR(Request $request,$id){

            // code to process payment and update order status
            // ...
            // send thank you email to user
            $user = auth()->user();
            $order = Order::find($id);
            Mail::to($user->email)->send(new ThankYouMail($user->name, $order));

            Alert::success('Payment confirmed. Thank you for your order!');

            return redirect()->back();
        }


    }
