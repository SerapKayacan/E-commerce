<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Author;
use App\Models\Category;
use App\Models\Campaign;
use App\Models\CampaignRule;
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

        $productList = [];
        foreach ($request->input('order_items') as $orderProductItem) {
            $product = Product::find($orderProductItem['product_id']);
            if ($product) {
                $product->orderFromQuantity = $orderProductItem['order_quantity'];
                $productList[$product->id] = $product;
            }
        }

        $mostUsefulMatchedCampaign = null;
        $campaigns = Campaign::with('campaign_rules', 'campaign_rules.author', 'campaign_rules.category')->get();
        foreach ($campaigns as $campaign) {
            foreach ($campaign->campaign_rules as $rule) {
                foreach ($productList as $product) {
                    $product->price;
                    $product->orderFromQuantity;
                    if ($rule->author_id == $product->author_id  && $rule->category_id == $product->product_category_id && $rule->campaign_rules_status == 'Active') {
                        if ($rule->author_id == 3 && $rule->category_id == 1 && $product->orderFromQuantity >= 2) {
                            if ($rule->campaign_type == 'buy_2_pay_1') {
                                $sortedProductList = collect($productList)->sortBy('price');
                                $totalPrice = 0;
                                $appliedProducts = $sortedProductList->take(2);
                                $totalPrice += $appliedProducts->skip(1)->sum('price');

                                $totalPrice += $sortedProductList->take(2)->sum('price');
                                // dd($totalPrice);
                            }
                        }
                        $mostUsefulMatchedCampaign = $campaign;
                    } elseif ($rule->author_type == $product->author->author_type &&  $rule->campaign_rules_status == 'Active') {
                        if ($rule->author_type == 'Local')
                            if ($rule->campaign_type == 'author_type_discount') {
                                $totalPrice = 0;
                                $totalPrice +=  $product->price * $product->orderFromQuantity;
                                $totalPrice -=   $totalPrice * 0.05;
                                // dd($totalPrice );
                            }
                        $mostUsefulMatchedCampaign = $campaign;
                    } elseif ($rule->min_total_price >= $product->price && $rule->campaign_rules_status == 'Active') {
                        if (($product->price * $product->orderFromQuantity) >= 200) {
                            if ($rule->campaign_type == 'percentage_discount') {
                                $totalPrice = 0;
                                $totalPrice +=  $product->price * $product->orderFromQuantity;
                                $totalPrice -=  ($product->price * $product->orderFromQuantity) * 0.05;
                                dd($totalPrice);
                            }
                        }
                        $mostUsefulMatchedCampaign = $campaign;
                    }
                }
            }
            //max kar bul 3. kampanya ekle.değişken adı değisecek
        }

        //  dd($matchedCampaign);

        $order = new Order();

        $order->order_status = 'Pending';
        $order->user_id = $request->input('user_id');
        $order->cargo_price = 10;
        $order->total_price = 0;
        $order->date_of_delivery = '12-04-2024';
        $order->discount_price = 0;
        $order->campaign_id = ($mostUsefulMatchedCampaign !== null) ? $mostUsefulMatchedCampaign->id : null;
        $order->save();

        $totalPrice = 0;

        foreach ($request->input('order_items') as $orderProductItem) {
            $product = $productList[$orderProductItem['product_id']];

            if ($product && $product->stock_quantity >= $orderProductItem['order_quantity']) {


                if ($mostUsefulMatchedCampaign && $orderProductItem->product->author_id == 2 && $orderProductItem->product->product_category_id == 3) {
                    if ($orderProductItem['order_quantity'] >= 2) {
                        $orderProductItem['order_quantity'] -= 1;
                    }
                } elseif ($orderProductItem->product->author->author_type == 'Local') {
                    $totalPrice -= ($totalPrice / 100) * 5;
                }

                for ($i = 1; $i <= $orderProductItem['order_quantity']; $i++) {

                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $product->id;
                    $orderItem->order_quantity = $orderProductItem['order_quantity'];
                    $orderItem->order_price = $product->price * $orderProductItem['order_quantity'];
                    $orderItem->save();

                    $totalPrice += $orderItem->order_price;
                }

                $product->stock_quantity -= $orderProductItem['order_quantity'];
                $product->save();
            } else {
                return response()->json([
                    'message' => 'Product stock is insufficient or product does not exist',
                ], 400);
            }
        }


        // }
        if ($totalPrice >= 50) {
            $order->cargo_price = 0;
        }
        // }elseif($totalPrice >=200){
        //     $totalPrice -= ($totalPrice/100)*5;

        // }

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
