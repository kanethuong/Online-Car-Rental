<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Arr;
use App\Models\Category;

/**
 * The CartController class handles the functionality related to the shopping cart.
 */
class CartController extends Controller
{
    /**
     * Display the shopping cart.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cart_data = Cart::content()->toArray();
        return view('home.cart')
            ->with('cart_data', $cart_data);
    }

    /**
     * Add a product to the shopping cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCart(Request $request)
    {
        $prod_id = $request->input('product_id');
        $quantity = 1;

        $product = Product::find($prod_id);
        Cart::add($product->product_id, $product->product_name, $quantity, $product->unit_price, ['image' => $product->image]);
        return response()->json(['status' => $quantity . ' x ' . $product->product_name . ' added to cart', 'status2' => '2']);
    }

    /**
     * Load the total number of items in the cart.
     *
     * @return void
     */
    public function cartLoad()
    {
        echo json_encode(array('totalcart' => Cart::count()));
        die;
        return;
    }

    /**
     * Update the quantity of a product in the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCart(Request $request)
    {
        Cart::update($request->row_id, $request->quantity);
        return response()->json(['status' => 'Cart Updated!', 'newSubtotal' => Cart::subtotal()]);
    }

    /**
     * Clear the shopping cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearCart()
    {
        Cart::destroy();
        return response()->json(['status' => 'Cart Cleared!']);
    }

    /**
     * Remove a product from the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCartItem(Request $request)
    {
        Cart::remove($request->row_id);
        return response()->json(['status' => 'Item Removed!']);
    }
}
