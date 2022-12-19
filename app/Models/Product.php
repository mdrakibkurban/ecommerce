<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function attributes(){
        return $this->hasMany(ProductAttribute::class);
    }
    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public static function getDiscountPrice($product_id)
    {
        $product = Product::select('price','discount','category_id')->where('id',$product_id)
        ->first();
        
        $category = Category::select('discount')->where('id',$product->category_id)->first();

        if($product->discount > 0){
            $discount_price = $product->price - ($product->price * $product->discount/100);
        }
        else if($category->discount > 0){
            $discount_price = $product->price - ($product->price * $category->discount/100);
        }else{
            $discount_price = 0;
        }

         return $discount_price;
    }

}
