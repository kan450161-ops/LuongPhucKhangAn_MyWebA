<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer');

        if ($q = $request->input('q')) {
            $query->where('order_code', 'like', "%{$q}%")
                ->orWhereHas('customer', function ($q2) use ($q) {
                    $q2->where('name', 'like', "%{$q}%");
                });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');

        return view('admin.orders.index', compact('orders', 'totalOrders', 'totalRevenue'));
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'items.product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated.');
    }
}
