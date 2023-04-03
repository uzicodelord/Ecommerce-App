<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        return view('home.contact', compact('categories'));
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
