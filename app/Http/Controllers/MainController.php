<?php

namespace App\Http\Controllers;

use App\Product;
use App\Product_type;
use App\Room;
use App\Comfort;
use App\Room_type;
use Illuminate\Http\Request;
use App\Http\Resources\MainProduct as MainProductResource;

class MainController extends Controller
{
    //API
    public function getProducts(){
        $products = Product::all();
        $prods = $products->sortByDesc('created_at');
        return MainProductResource::collection($prods);
    }
    public function searchProducts(Request $request){
        $first_price = $request->first_price;
        $second_price = $request->second_price;
        $products = Product::with('rooms')->whereHas('rooms', function($q) use($first_price,$second_price) {
            $q->whereBetween('price',[$first_price,$second_price]);
        })->get();
       return MainProductResource::collection($products);

    }
}
