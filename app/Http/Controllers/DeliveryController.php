<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;

/**
 * Class DeliveryController
 *
 * This class handles the delivery functionality of the application.
 */
class DeliveryController extends Controller
{
    /**
     * Display the delivery page with the cart data.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cart_data = Cart::content()->toArray();
        return view('home.delivery')
            ->with('cart_data', $cart_data);
    }

    /**
     * Place an order with the given request data.
     *
     * @param \Illuminate\Http\Request $request The request object containing the order details.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function placeOrder(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',  // Only letters and spaces
            'street' => 'required|string|max:255',  // Allowing more characters for street
            'city' => 'required|string|max:255',  // Allowing common characters in city names
            'state' => 'required|in:NSW,VIC,QLD,WA,SA,TAS,ACT,NT,Others',  // Specific list of values
            'mobile' => 'required|regex:/^04\d{8}$/',  // Australian mobile numbers start with '04' and have 8 digits
            'email' => 'required|email|max:255',  // Must be a valid email address
        ]);

        $cart_data = Cart::content()->toArray();

        // Check quantity of each product in cart
        foreach ($cart_data as $cart_item) {
            $product = Product::find($cart_item['id']);
            if ($cart_item['qty'] > $product->in_stock) {
                return redirect()->route('delivery')->with('error', $product->product_name . ' is out of stock');
            }
        }

        // Create a new order
        $order = new Order();
        $order->name = $request->name;
        $order->street = $request->street;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->mobile = $request->mobile;
        $order->email = $request->email;
        $order->total = Cart::subtotal(2, '.', '');
        $saveOrder = $order->save();

        // Handle order creation failure
        if (!$saveOrder) {
            return redirect()->route('delivery')->with('error', 'Failed to place order. Please try again.');
        }

        // Create order items and update product stock
        foreach ($cart_data as $cart_item) {
            $orderItem = new OrderItem();
            $orderItem->quantity = $cart_item['qty'];
            $orderItem->name = $cart_item['name'];
            $orderItem->price = $cart_item['price'];
            $orderItem->total = $cart_item['price'] * $cart_item['qty'];
            $orderItem->order_id = $order->order_id;
            $orderItem->product_id = $cart_item['id'];

            $product = Product::find($cart_item['id']);
            $product->in_stock -= $cart_item['qty'];
            $saveProduct = $product->save();
            $saveOrderItem = $orderItem->save();

            // Handle order item or product update failure
            if (!$saveProduct || !$saveOrderItem) {
                return redirect()->route('delivery')->with('error', 'Failed to place order. Please try again.');
            }
        }

        // Clear the cart and redirect to order detail page
        Cart::destroy();
        return redirect()->route('order-detail', $order->order_id);
    }
}
