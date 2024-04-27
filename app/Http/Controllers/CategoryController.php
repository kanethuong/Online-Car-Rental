<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    //show all products of a category
    public function index($id)
    {
        $product = Product::where('category_id', $id)->paginate(6);
        $categoryName = Category::where('category_id', $id)->first()->category_name;
        $categories = Category::all();
        $catSubcatMap = [];
        foreach ($categories as $category) {
            $catSubcatMap[$category->category_id] = $category->subcategories;
        }
        return view('home.category', compact('product', 'categoryName', 'categories', 'catSubcatMap'));
    }
}
