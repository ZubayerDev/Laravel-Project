<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['barcode', 'product_name', 'product_brand','category_name','subcategory','sku','discount','short_desp','product_photo','seo_tag','long_desp','add_info'];

    function rel_to_category(){
        return $this->belongsTo(Category::class, 'category_name');
    }

    function rel_to_subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory');
    }

    function rel_to_brand(){
        return $this->belongsTo(Brand::class, 'product_brand');
    }

    function rel_to_inventory(){
        return $this->hasMany(Inventory::class, 'product_id', 'id');
    }
}
