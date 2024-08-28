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
use App\Service\OrderService;
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
            $product = Product::where('product_status', true)->whereId($orderProductItem['product_id'])->first();
            if ($product && $product->stock_quantity >= $orderProductItem['order_quantity']) {
                $product->orderLineQuantity = $orderProductItem['order_quantity'];
                $product->orderLineTotalPrice = $orderProductItem['order_quantity'] * $product->price;
                $productList[$product->id] = $product;
            } else {
                return response()->json([
                    'message' => 'Product stock is insufficient or product does not exist',
                ], 400);
            }
        }

        $mostUsefulMatchedCampaign = null;
        $campaigns = Campaign::with('campaign_rules')->where('campaign_status', 'Active')->get();
        $buyOneGetOneFreeItems = [];
        $localAuthorItems = [];

        foreach ($campaigns as $campaign) {
            foreach ($campaign->campaign_rules as $rule) {
                foreach ($productList as $product) {

                    if ($rule->campaign_type == 'buy_2_pay_1') {
                        if ($rule->author_id == $product->author_id && $rule->category_id == $product->product_category_id) {

                            for ($i = 0; $i < $product->orderLineQuantity; $i++) {
                                $buyOneGetOneFreeItems[$rule->author_id][$rule->category_id][] = $product;
                            }


                            if (count($buyOneGetOneFreeItems[$rule->author_id][$rule->category_id]) > 1) {

                                $cheapestItem = $buyOneGetOneFreeItems[$rule->author_id][$rule->category_id][0];
                                foreach ($buyOneGetOneFreeItems[$rule->author_id][$rule->category_id] as $buyOneGetOneFreeItem) {
                                    if ($buyOneGetOneFreeItem->price < $cheapestItem->price) {
                                        $cheapestItem = $buyOneGetOneFreeItem;
                                    }
                                    $campaign->savings = $cheapestItem->price;
                                    if ($mostUsefulMatchedCampaign == null) {
                                        $mostUsefulMatchedCampaign = $campaign;
                                    } elseif ($buyOneGetOneFreeItem->price > $mostUsefulMatchedCampaign->savings) {
                                        $mostUsefulMatchedCampaign = $campaign;
                                    }
                                }
                            }
                        }
                    }

                    if ($rule->campaign_type == 'author_type_discount') {
                        if ($rule->author_type == $product->author->author_type) {

                            for ($i = 0; $i < $product->orderLineQuantity; $i++) {
                                $localAuthorItems[$rule->author_type][] = $product;
                            }

                            $localAuthorItemsTotalPrice = 0;

                            foreach ($localAuthorItems[$rule->author_type] as $localAuthorItem) {
                                $discountPrice = ($localAuthorItem->price * $rule->discount_value) / 100;
                                $localAuthorItemsTotalPrice += $discountPrice;
                            }

                            $campaign->savings = $localAuthorItemsTotalPrice;
                            if ($mostUsefulMatchedCampaign == null) {
                                $mostUsefulMatchedCampaign = $campaign;
                            } elseif ($localAuthorItemsTotalPrice > $mostUsefulMatchedCampaign->savings) {
                                $mostUsefulMatchedCampaign = $campaign;
                            }
                        }
                    }
                }
            }
        }

        $user = User::find($request->input('user_id'));

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $order = new Order();
        $order->order_status = 'Pending';
        $order->user_id = $request->input('user_id');
        $order->cargo_price = 10;
        $order->total_price = 0;
        $order->discount_price = 0;
        $order->campaign_id = null;
        $order->save();

        $totalPrice = 0;

        foreach ($request->input('order_items') as $orderProductItem) {

            $product = $productList[$orderProductItem['product_id']];

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->order_quantity = $orderProductItem['order_quantity'];
            $orderItem->order_price = $product->orderLineTotalPrice;
            $orderItem->save();

            $product->stock_quantity -= $orderProductItem['order_quantity'];
            unset($product->orderLineTotalPrice);
            unset($product->orderLineQuantity);
            $product->update();
            $totalPrice += $orderItem->order_price;
        }
        if ($totalPrice >= 50) {
            $order->cargo_price = 0;
        }
        $order->total_price = $totalPrice;
        $order->update();

        foreach ($campaigns as $campaign) {
            foreach ($campaign->campaign_rules as $rule) {

                $totalDiscountPrice = ($order->total_price * $rule->discount_value) / 100;

                if ($rule->campaign_type == 'percentage_discount') {
                    if ($order->total_price >= $rule->min_total_price) {

                        $campaign->savings = $totalDiscountPrice;

                        if ($mostUsefulMatchedCampaign == null) {
                            $mostUsefulMatchedCampaign = $campaign;
                        } elseif ($totalDiscountPrice > $mostUsefulMatchedCampaign->savings) {
                            $mostUsefulMatchedCampaign = $campaign;
                        }
                    }
                }
            }
        }

        $order->total_price += $order->cargo_price;
        $order->discount_price = $mostUsefulMatchedCampaign->savings ?? 0;
        $order->campaign_id = $mostUsefulMatchedCampaign->id ?? NULL;
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
                'message' => 'No Such Order Found!'
            ], 404);
        }

        $order->order_status = $request->input('order_status');
        $order->save();

        return response()->json([
            'message' => 'Order status updated successfully',
            'data' => new OrderResource($order)
        ], 200);
    }


    public function destroy($id)
    {
        $order = Order::withoutTrashed()->find($id);

        if ($order) {

            $order->delete();
            return response()->json([
                'message' => 'Order soft deleted successfully.',
                'data' => new OrderResource($order)
            ], 200);
        }

        return response()->json(['message' => 'No Such Order Found!'], 404);
    }
}
