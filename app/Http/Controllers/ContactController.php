<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function show()
    {
        $cart_count = Cart::where('user_id', Auth::id())->count();

        $categories = Category::orderBy('category_name', 'asc')->get();
        return view('home.contact', compact('categories', 'cart_count'));
    }
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Mail::send('emails.contact', [
            'name' => $request->name,
            'email' => $request->email,
            'messages' => $request->message
        ], function ($mail) use ($request) {
            $mail->from($request->email, $request->name);
            $mail->to('uzinarco2@gmail.com')->subject('Contact Request');
        });

        return redirect()->back()->with('message', 'Thanks for your message!');
    }
}
