<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    /**
     * Send an order confirmation email to the customer.
     *
     * @param int $id The ID of the order to send the email for.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendOrderConfirmationEmail(int $id)
    {
        $order = Order::findOrFail($id);

        $details = [
            'greeting' => 'Hello '. ',',
            'subject' => 'Order Confirmation - Order #' . $order->id,
            'body' => 'Thank you for your order. Here is a summary of your purchase:',
            'items' => $order->items,
            'total' => 'Total: $' . number_format($order->total, 2),
            'lastline' => 'If you have any questions, please do not hesitate to contact us.',
        ];

        Notification::send($order->user, new SendEmailNotification($details));

        return redirect()->back()->with('message', 'Order confirmation email sent successfully.');
    }
}
