<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
       $data['latest'] = Product::orderBy('created_at','desc')->active()->take(12)->get();
       $data['special']= Product::where('discount', '!=', 0)
       ->orderBy('discount', 'desc')->active()->take(12)->get();
       $data['random']= Product::inRandomOrder()->active()->take(12)->get();

       $data['banner'] = Banner::get();
       return view('frontend.home.index',$data);
    }

   
}
