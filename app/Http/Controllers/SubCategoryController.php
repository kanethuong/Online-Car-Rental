<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index($id)
    {
        $product = Product::where('sub_category_id', $id)->paginate(6);
        $subCategoryName = SubCategory::where('sub_category_id', $id)->first()->sub_category_name;
        $categories = Category::all();
        $catSubcatMap = [];
        foreach ($categories as $category) {
            $catSubcatMap[$category->category_id] = $category->subcategories;
        }
        return view('home.sub_category', compact('product', 'subCategoryName', 'categories', 'catSubcatMap'));
    }
}
