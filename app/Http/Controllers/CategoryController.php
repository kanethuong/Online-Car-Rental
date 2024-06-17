<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $jsonData;
    public function __construct()
    {
        $this->jsonData = json_decode(file_get_contents(storage_path() . "/cars.json"), true);
    }

    public function getCarsByType($id)
    {
        $results = [];
        $cars = $this->jsonData['cars'];
        foreach ($cars as $car) {
            if ($car['type'] == $id) {
                $results[] = $car;
            }
        }
        return view('home.type_category')
            ->with('cars', $results);
    }

    public function getCarsByBrand($id)
    {
        $results = [];
        $cars = $this->jsonData['cars'];
        foreach ($cars as $car) {
            if ($car['brand'] == $id) {
                $results[] = $car;
            }
        }
        return view('home.brand_category')
            ->with('cars', $results);
    }
}
