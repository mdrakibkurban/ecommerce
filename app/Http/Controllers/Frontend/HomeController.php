<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
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


    public function category($section, $slug){
        $category = Category::where('slug',$slug)->first();
        $data['category'] = $category;
        $product = Product::where('category_id',$category->id)->active();

        if(isset($_GET['sort']) && !empty($_GET['sort'])){
            if($_GET['sort'] == 'product_latest'){
                $product->orderBy('products.id','desc');
            }
            else if($_GET['sort'] == 'price_lowest'){
                $product->orderBy('products.price','asc');
            }
            else if($_GET['sort'] == 'price_highest'){
                $product->orderBy('products.price','desc');
            }
            else if($_GET['sort'] == 'name_a_z'){
                $product->orderBy('products.name','asc');
            }
            else if($_GET['sort'] == 'name_z_a'){
                $product->orderBy('products.name','desc');
            }
        }
        $data['products'] = $product->paginate(11); 
        return view('frontend.home.category',$data);   
    }

    public function single($category,$slug){
        $data['product'] = Product::with('category','attributes','images')
        ->where('slug',$slug)->first();
        $data['total_stock'] = ProductAttribute::where('product_id', $data['product']->id)->sum('stock');
        return view('frontend.home.single',$data);
    }


     public function getProductPrice(Request $request){
        $productArrtibute = ProductAttribute::where(['product_id' =>$request->id, 'size' => $request->size])->first();
        
        $product = Product::select('id','discount','category_id')->where('id',$request->id)
        ->first();
            
        $category = Category::select('id','discount')->where('id',$product->category_id)->first();

        if($product->discount > 0){
            $final_price = $productArrtibute->price - 
            ($productArrtibute->price * $product->discount/100);

            $discount = $productArrtibute->price - $final_price;
         }
         else if($category->discount > 0){
            $final_price = $productArrtibute->price - 
            ($productArrtibute * $category->discount/100);
            $discount = $productArrtibute->price - $final_price;
         }else{
            $final_price = $productArrtibute->price;
            $discount = 0;
         }

         return response()->json([
              'final_price'   => $final_price,
              'discount'      => $discount,
              'product_price' => $productArrtibute->price,
         ]);

     } 
   
}
