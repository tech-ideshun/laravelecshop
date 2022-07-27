<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request){

        $keyword = $request->input('keyword');

        $products = [];
        if(!empty($keyword)) {
            $products = Product::availableItems()
            ->where('products.name', 'LIKE', "%{$keyword}%")
            ->orWhere('products.info', 'LIKE', "%{$keyword}%")
            ->get();
        }else{
            $products  = Product::availableItems()->get();
        }

        return view('products', ['products' => $products, 'keyword' => $keyword
    ]);
    }
    
}
