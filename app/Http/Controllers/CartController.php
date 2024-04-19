<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        return view('home.cart')
            ->with('cart_data', $cart_data);
    }

    public function addCart(Request $request)
    {
        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    $cart_data[$keys]["item_quantity"] += $request->input('quantity');
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status' => $request->input('quantity') . ' x ' . $cart_data[$keys]["item_name"] . ' added to cart', 'status2' => '2']);
                }
            }
        } else {
            $product = Product::find($prod_id);
            $prod_name = $product->product_name;
            // $prod_image = $products->image;
            // $priceval = $products->unit_price;

            if ($product) {
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_quantity' => $quantity,
                    // 'item_name' => $prod_name,
                    // 'item_price' => $priceval,
                    // 'item_image' => $prod_image
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 60;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                return response()->json(['status' => $quantity . ' x ' . $prod_name . ' added to cart']);
            }
        }
    }

    public function cartLoad()
    {
        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $total_cart = 0;
            foreach ($cart_data as $item) {
                $total_cart += $item['item_quantity'];
            }

            echo json_encode(array('totalcart' => $total_cart));
            die;
            return;
        } else {
            $total_cart = "0";
            echo json_encode(array('totalcart' => $total_cart));
            die;
            return;
        }
    }

    public function updateCart(Request $request)
    {
        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $item_id_list = array_column($cart_data, 'item_id');
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    $cart_data[$keys]["item_quantity"] =  $quantity;
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    // return response()->json(['status'=>'"'.$cart_data[$keys]["item_name"].'" Quantity Updated']);
                    return response()->json(['status' => 'Quantity Updated']);
                }
            }
        }
    }
}
