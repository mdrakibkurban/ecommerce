<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;
    public static function getCartItems(){
        if(Auth::check()){
            $getCartItems = Cart::with(['product'=>function($query){
                $query->select('id','category_id','name','code','featured_image');
            }])->orderBy('id','desc')->where('user_id',Auth::user()->id)->get();
        }else{
            $getCartItems = Cart::with(['product'=>function($query){
                $query->select('id','category_id','name','code','featured_image');
            }])->orderBy('id','desc')->where('session_id',Session::get('session_id'))->get();
        }
        return $getCartItems;
    }

    public function product(){
        return $this->belongsTo(product::class);
    }
}
