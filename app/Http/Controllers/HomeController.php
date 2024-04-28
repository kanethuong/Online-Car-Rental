<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class HomeController extends Controller
{
    public function index()
    {
        if (request()->has('search_text')) {
            $product = Product::where('product_name', 'like', '%' . request('search_text') . '%')->paginate(6);
        } else {
            $product = Product::paginate(6);
        }
        $categories = Category::all();
        $catSubcatMap = [];
        foreach ($categories as $category) {
            $catSubcatMap[$category->category_id] = $category->subcategories;
        }
        return view('home.userpage', compact('product', 'categories', 'catSubcatMap'));
    }
}
