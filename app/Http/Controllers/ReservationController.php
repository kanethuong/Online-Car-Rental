<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\Order;

class ReservationController extends Controller
{
    public function index()
    {
        $reservation = Cookie::get('reservation');
        if ($reservation) {
            $reservation = json_decode($reservation, true);
            $jsonData = json_decode(file_get_contents(storage_path() . "/cars.json"), true);
            $cars = $jsonData['cars'];
            foreach ($cars as $car) {
                if ($car['car_id'] == $reservation['car_id']) {
                    $reservation = $car;
                    break;
                }
            }
            return view('home.reservation', compact('reservation'));
        }
        return view('home.reservation');
    }

    public function addReservation(Request $request)
    {
        $response = new Response('Add reservation successfully!');
        $car_arr = [
            'car_id' => $request->input('car_id'),
            'quantity' => $request->input('quantity')
        ];
        $reservation_json = json_encode($car_arr);
        $response->withCookie(cookie('reservation', $reservation_json, 60));
        return $response;
    }
}
