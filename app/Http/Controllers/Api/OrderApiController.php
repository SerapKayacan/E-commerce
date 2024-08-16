<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderApiController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'order_items', 'order_items.product')->get();

        return response()->json($orders, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['integer', 'exists:users,id'],
            'order_items.*.product_id' => ['integer', 'exists:products,id'],
            'order_items.*.order_quantity' => ['required', 'integer', 'min:1'],


        ]);


        if ($validator->fails()) {

            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $order = new Order();
        $order->user_id = $request->input('user_id');
        $order->cargo_price = 30;
        $order->total_price = 0;
        $order->date_of_delivery = '12-04-2024';
        $order->discount_price = 0;
        $order->order_status = 'Pending';
        $order->save();

        $totalPrice = 0;
        foreach ($request->input('order_items') as $order_item) {

            $product = Product::find($order_item['product_id']);

            if ($product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product->id;
                $orderItem->order_quantity = $order_item['order_quantity'];
                $orderItem->order_price = $product->product_price * $order_item['order_quantity'];
                $orderItem->save();

                $totalPrice += $orderItem->order_price;
            }
        }
        $totalPrice += $order->cargo_price;
        $order->total_price = $totalPrice;
        $order->update();

        return response()->json([
            'message' => 'Order placed succesfully',
            'data' => new OrderResource($order)
        ], 200);
    }


    public function show($id)
    {
        $order = Order::with(['order_items.product', 'user'])->find($id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Order retrieved successfully',
            'data' => $order
        ], 200);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'order_status' => ['required', 'string', 'in:Pending,Deliverd,Out of delivery,Canceled,Accepted'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        $order->order_status = $request->input('order_status');
        $order->save();

        return response()->json([
            'message' => 'Order status updated successfully',
            'data' => $order
        ], 200);
    }


    public function destroy($id)
    {
        $order = Order::withoutTrashed()->find($id);

        if ($order) {

            $order->delete();
            return response()->json(['message' => 'Order soft deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Order not found.'], 404);
    }
}
