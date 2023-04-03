<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    public function handle(UserRegistered $event)
    {
        $user = $event->user;

        Mail::send('emails.welcome', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject('Welcome to Uzi-Shop');
        });
    }
}
