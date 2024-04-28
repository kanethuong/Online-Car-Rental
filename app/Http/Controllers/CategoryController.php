<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display all products of a category.
     *
     * @param  int  $id  The ID of the category.
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        // Retrieve all products of the specified category
        $product = Product::where('category_id', $id)->paginate(6);

        // Retrieve the name of the category
        $categoryName = Category::where('category_id', $id)->first()->category_name;

        // Retrieve all categories
        $categories = Category::all();

        // Create a map of category IDs to their subcategories
        $catSubcatMap = [];
        foreach ($categories as $category) {
            $catSubcatMap[$category->category_id] = $category->subcategories;
        }

        // Render the category view with the necessary data
        return view('home.category', compact('product', 'categoryName', 'categories', 'catSubcatMap'));
    }
}
