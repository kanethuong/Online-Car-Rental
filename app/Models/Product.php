<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Buyable
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'product_name',
        'unit_price',
        'unit_quantity',
        'in_stock',
        'image',
        'category_id',
        'sub_category_id'
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'sub_category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function getBuyableIdentifier($options = null) {
        return $this->product_id;
    }

    public function getBuyableDescription($options = null) {
        return $this->product_name;
    }

    public function getBuyablePrice($options = null) {
        return $this->unit_price;
    }
}
