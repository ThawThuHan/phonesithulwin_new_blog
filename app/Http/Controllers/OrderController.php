<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmMail;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.order.index', ["orders" => $orders]);
    }

    public function create($book_id)
    {
        $book = Book::find($book_id);
        if (!$book) {
            abort(404);
        }
        return view('book_order', ['book' => $book]);
    }

    public function store(Request $request)
    {
        $formdata = $request->validate([
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required",
            "book_id" => "required",
            "payment_screenshot" => "required",
        ]);

        if ($request->hasFile('payment_screenshot')) {
            $path = $request->file('payment_screenshot')->store('payment_screenshot');
            $formdata['payment_screenshot'] = explode("/", $path)[1];
        }

        $result = Order::create($formdata);
        return redirect()->back()->with('success', "Complete Order Successful, We'll reply back soon!");
    }

    public function confirm(Order $order)
    {
        $details = [
            "confirm" => true,
            "message" => "Hey $order->name, We've got your order! We'll send your order from delievery. Thanks for supporting me.",
        ];
        try {
            Mail::to($order->email)->send(new OrderConfirmMail($details, $order));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('status', 'Mail not send! try again...');
        }
        $order->confirm = true;
        $order->update();
        return back()->with('status', "Order Confirm Mail Send!");
    }

    public function cancel(Order $order, Request $request)
    {
        $request->validate([
            "message" => "required",
        ]);
        $details = [
            "confirm" => false,
            "message" => $request->message,
        ];
        try {
            Mail::to($order->email)->send(new OrderConfirmMail($details, $order));
        } catch (\Throwable $th) {
            return back()->with('status', 'Mail not send! try again...');
        }
        $order->confirm = false;
        $order->update();
        return back()->with('status', "Order Cancel Mail Send!");
    }

    public function destroy(Order $order)
    {
        Storage::delete("payment_screenshot/$order->payment_screenshot");
        $order->delete();
        return redirect()->route('order.index')->with('status', 'Order Deleted!');
    }
}
