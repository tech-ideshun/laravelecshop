<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Stock;

class ProductController extends Controller
{
    
    //   在庫一覧
    public function index(Request $request)
    {
        $stocks = Stock::orderBy('created_at', 'desc')->get();
        return view('products.index', [
            'stocks' => $stocks,
            // ここでstockテーブルを取り出す
        ]);
    }

}