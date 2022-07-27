<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Orders;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('id');
            if(!is_null($id)) {
                $itemId = Product::availableItems()->where('products.id', $id)->exists();
                if(!$itemId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }
  
    //   商品一覧
    public function index(Request $request)
    {
        // 商品一覧の取得
        $products = Product::orderBy('created_at', 'desc')->get();
        
        // 販売中の商品一覧
        $products_selling = Product::where('is_selling', '=', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // 販売停止の商品一覧
        
        $products_no_selling = Product::where('is_selling', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();;

        //  商品の在庫数の取得
        for ($i = 0; $i < $products->count(); $i++) {

            $stocks_quantity_add_total = Stock::where('product_id', $products[$i]->id)->where('type', 1)->sum('quantity');

            $stocks_quantity_sub_total = Stock::where('product_id', $products[$i]->id)->where('type', 2)->sum('quantity');

            $stocks[$products[$i]->id] = $stocks_quantity_add_total + $stocks_quantity_sub_total;
        }

        // 商品の購入数取得
        for ($i = 0; $i < $products->count(); $i++) {
            $orders_quantity_add_total = DB::table('orders')->where('product_id', $products[$i]->id)->sum('quantity');
            $orders[$products[$i]->id] = $orders_quantity_add_total;
        }

        return view('products.index', [
            'products' => $products,
            'products_selling' => $products_selling,
            'products_no_selling' => $products_no_selling,
            'stocks' => $stocks,
            'orders' => $orders
        ]);
    }


    // 商品登録
    public function create()
    {
        
        return view('products.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // 方法１
        $newProduct = new Product();
        $newProduct->name = $request->name;
        $newProduct->price = $request->price;
        $newProduct->info = $request->info;
        $newProduct->category_id = $request->category_id;
        $uploadImg1 = $request->image1;
        $uploadImg2 = $request->image2;
        $uploadImg3 = $request->image3;
        $uploadImg4 = $request->image4;

        if (isset($uploadImg1)) {
            $filePath = $uploadImg1->store('public/upload_img');
            $newProduct->image1 = str_replace('public/upload_img/', '', $filePath);
        } else {
            $newProduct->image1 =null;
        }

        if (isset($uploadImg2)) {
            $filePath = $uploadImg2->store('public/upload_img');
            $newProduct->image2 = str_replace('public/upload_img/', '', $filePath);
        } else {
            $newProduct->image2 =null;
        }

        if (isset($uploadImg3)) {
            $filePath = $uploadImg3->store('public/upload_img');
            $newProduct->image3 = str_replace('public/upload_img/', '', $filePath);
        } else {
            $newProduct->image3 =null;
        }

        if (isset($uploadImg4)) {
            $filePath = $uploadImg4->store('public/upload_img');
            $newProduct->image4 = str_replace('public/upload_img/', '', $filePath);
        } else {
            $newProduct->image4 =null;
        }

        $newProduct->is_selling = $request->is_selling;

        $newProduct->save();

        $newStock = new Stock();
        $newStock->product_id = $newProduct->id;
        $newStock->type = 1;
        $newStock->quantity = $request->quantity;
        $newStock->save();


        return redirect()->route('index');
    }

    // 商品検索
    public function search(Request $request)
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        $search = $request->input('search');
        $searches = Product::where('name', 'like', "%$request->search%")
        ->orWhere('id', 'like', "%{$search}%")
        ->get();
        
        // dd($searches[0]->id);

        // 販売中の商品一覧
        $products_selling = Product::where('is_selling', '=', 1)
            ->where('name', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->get();

        // 販売停止中の商品一覧
        $products_no_selling = Product::where('is_selling', '=', 0)
            ->where('name', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->get();

        //  商品の在庫数の取得
        // dd($products->count());
        for ($i = 0; $i < $searches->count(); $i++) {

            $stocks_quantity_add_total = Stock::where('product_id', $searches[$i]->id)->where('type', 1)->sum('quantity');

            $stocks_quantity_sub_total = Stock::where('product_id', $searches[$i]->id)->where('type', 2)->sum('quantity');
            $stocks[$searches[$i]->id] = $stocks_quantity_add_total + $stocks_quantity_sub_total;
        }

        // 商品の購入数取得
        for ($i = 0; $i < $searches->count(); $i++) {
            $orders_quantity_add_total = DB::table('orders')->where('product_id', $searches[$i]->id)->sum('quantity');
            $orders[$searches[$i]->id] = $orders_quantity_add_total;
        }


        return view('products.index', [
            'products' => $searches,
            'products_selling' => $products_selling,
            'products_no_selling' => $products_no_selling,
            'stocks' => $stocks,
            'orders' => $orders,
            'search' => $search
        ]);
    }


    // 商品編集
    public function edit(Request $request)
    {
        
        // 商品一覧の取得
        $products = Product::orderBy('created_at', 'desc')->get();

        // 選択された商品の取得
        $product = Product::find($request->id);

        // 登録時のカテゴリーの種類のid
        $category_selected_id = Category::find($product->category_id);

        //  商品の在庫数の取得
        for ($i = 0; $i < $products->count(); $i++) {

            $stocks_quantity_add_total = Stock::where('product_id', $products[$i]->id)->where('type', 1)->sum('quantity');

            $stocks_quantity_sub_total = Stock::where('product_id', $products[$i]->id)->where('type', 2)->sum('quantity');

            $stocks[$products[$i]->id] = $stocks_quantity_add_total + $stocks_quantity_sub_total;
        }
        return view('products.edit', [
            'product' => $product,
            'category_selected_id' => $category_selected_id,
            'categories' => Category::all(),
            'stock' => $stocks[$product->id],
            // dd($stocks[$product->id])                        
        ]);
    }



    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        // 選択された商品の取得
        $editProduct = Product::find($request->id);
        // dd($editProduct->name);
        // $editProduct->update($request->only(['name']));
        $editProduct->name = $request->name;
        $editProduct->price = $request->price;
        $editProduct->info = $request->info;
        $editProduct->category_id = $request->category_id;

        // 画像ファイルインスタンス取得
        $uploadImg1 = $request->image1;
        $uploadImg2 = $request->image2;
        $uploadImg3 = $request->image3;
        $uploadImg4 = $request->image4;

        if (isset($uploadImg1)) {
            Storage::delete('public/upload_img/' . $editProduct->image1);
            $filePath = $uploadImg1->store('public/upload_img');
            $editProduct->image1 = str_replace('public/upload_img/', '', $filePath);
        }
        if (isset($uploadImg2)) {
            Storage::delete('public/upload_img/' . $editProduct->image2);
            $filePath = $uploadImg2->store('public/upload_img');
            $editProduct->image2 = str_replace('public/upload_img/', '', $filePath);
        }
        if (isset($uploadImg3)) {
            Storage::delete('public/upload_img/' . $editProduct->image3);
            $filePath = $uploadImg3->store('public/upload_img');
            $editProduct->image3 = str_replace('public/upload_img/', '', $filePath);
        }
        if (isset($uploadImg4)) {
            Storage::delete('public/upload_img/' . $editProduct->image4);
            $filePath = $uploadImg4->store('public/upload_img');
            $editProduct->image4 = str_replace('public/upload_img/', '', $filePath);
        }

        $editProduct->is_selling = $request->is_selling;
        $editProduct->save();

        //// 選択された商品の取得  
        //Stock::where('product_id', $request->id)->update(['quantity' => (int)$request->stock]);
        //  商品の在庫数の取得
        // 選択された商品の取得
        $stocks_quantity_add_total = Stock::where('product_id', $editProduct->id)->where('type', 1)->sum('quantity');

        $stocks_quantity_sub_total = Stock::where('product_id', $editProduct->id)->where('type', 2)->sum('quantity');

        $stocks = $stocks_quantity_add_total + $stocks_quantity_sub_total;
        //在庫数が変更されているか判定
        //dd($request->stock);
        if( $request->stock - $stocks != 0 ){
            //Stockテーブルの登録
            $newStock = new Stock();
            $newStock->product_id = $editProduct->id;
            $newStock->quantity = $request->stock - $stocks;
            //在庫増減の判定
            if( $newStock->quantity > 0){
                $newStock->type = 1;
            }else{
                $newStock->type = 2;
            }
            $newStock->save();
        }
        // dd($request->stock);

        return redirect()->route('index');
    }


    // 商品削除
    // public function delete(Request $request)
    // {
    //     $product = Product::find($request->id);
    //     $product->delete();
    //     return redirect()->route('index');
    // }
    // return redirect('/');
  
    public function show($id) {
        $product = Product::findOrFail($id);
        // dd($product);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');
        // dd($quantity);
        if ($quantity > 9) {
            $quantity = 9;
        }

        // $recommend_items = Product::where([
        //     ['category_id', '=', $product->category_id],
        //     ['is_selling', '=', 1],
        //     ['id', '!=', $id ],

        $recommend_items = Product::availableItems()->where([
                ['category_id', '=', $product->category_id],
                ['is_selling', '=', 1],
                ['products.id', '!=', $id ],
        ])->get()
        // ->pluck('name')
        ->shuffle()
        ->take(3);
        // dd($recommend_items);


        // $test = Stock::join('products', 'stocks.product_id', '=', 'products.id')
        // ->join('categories', 'products.category_id', '=', 'categories.id');
        
        return view('product.show', compact('product', 'quantity', 'recommend_items'));
    }
}
