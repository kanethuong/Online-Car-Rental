<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

use function Psy\debug;

class OrderController extends Controller
{

    public function placeOrder(Request $request)
    {
        //recheck the availability of the car from JSON file
        $jsonData = json_decode(file_get_contents(storage_path() . "/cars.json"), true);
        $cars = $jsonData['cars'];
        $reservation = Cookie::get('reservation');
        if ($reservation) {
            $reservation = json_decode($reservation, true);
            foreach ($cars as $car) {
                if ($car['car_id'] == $reservation['car_id']) {
                    if ($car['quantity'] < $reservation['quantity'] || $car['availability'] == "No") {
                        return redirect('/reservation')->with('error', 'Sorry, the car is not available anymore!');
                    }
                    break;
                }
            }

            $car_id = $reservation['car_id'];
            //Clear the reservation cookie
            Cookie::queue(Cookie::forget('reservation'));

            //Insert a new rental record to the database
            $order = new Order();
            $order->user_email = $request->email;
            $order->rent_start_date = $request->start_date;
            $order->rent_end_date = $request->end_date;

            // Calculate the number of days
            $start_date = strtotime($request->start_date);
            $end_date = strtotime($request->end_date);
            $days = abs(($end_date - $start_date) / (60 * 60 * 24)) + 1;
            $order->price = $request->input('quantity') * $request->input('price_per_day') * $days;
            $order->status = 'unconfirmed';
            $order->save();

            return view('home.order_confirmation')
                ->with('order', $order)
                ->with('car_id', $car_id)
                ->with('success', 'Your order has been placed successfully!');
        }
    }

    public function orderConfirmation(Request $request)
    {
        $jsonData = json_decode(file_get_contents(storage_path() . "/cars.json"), true);
        $cars = &$jsonData['cars'];
        foreach ($cars as &$car) {
            if ($car['car_id'] == $request->query('id')) {
                $car['quantity'] -= 1;
                break;
            }
        }
        $jsonData = json_encode(['cars' => $cars], JSON_PRETTY_PRINT);
        file_put_contents(storage_path() . "/cars.json", $jsonData);

        //find order by email
        $order = Order::where('user_email', $request->query('email'))
            ->where('status', 'unconfirmed')
            ->first();
        $order->status = 'confirmed';
        $order->save();

        return redirect('/');
    }

    public function cancelOrder()
    {
        Cookie::queue(Cookie::forget('reservation'));
        return redirect('/');
    }
}
