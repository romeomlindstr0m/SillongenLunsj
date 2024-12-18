<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Order;

use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::all();
        return view('orders.index')->with('orders', $orders);
    }

    public function show($id): View
    {
        $order = Order::findOrFail($id);
        return view('orders.show')->with('order', $order);
    }

    public function destroy($id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('status', 'Order has been successfully deleted.');
    }
}
