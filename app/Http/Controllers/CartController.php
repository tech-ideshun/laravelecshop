<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Stock;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        // dd($products);
        $totalPrice = 0;

        foreach ($products as $product) {
            $totalPrice += $product->price * $product->pivot->quantity;
        }
        // dd($products, $totalPrice);

        return view('cart.index', compact('products', 'totalPrice'));
    }   

    public function add(Request $request)
    {
        $itemInCart = Cart::where('product_id', $request->product_id)
        ->where('user_id', Auth::id())->first();

        if ($itemInCart){
            $itemInCart->quantity += $request->quantity;
            $itemInCart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }
        return redirect()->route('cart.index');
    }

    public function delete($id)
    {
        Cart::where('product_id', $id)
        ->where('user_id', Auth::id())
        ->delete();

        return redirect()->route('cart.index');
    }

    public function checkout(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $now = Carbon::now();
        $nowDate = $now->format('YmdHis');

        // dd($orderNo);
        
        foreach($products as $product) {
            $quantity = Stock::where('product_id', $product->id)->sum('quantity');
            // dd($product->pivot->user_id);
            $randName = uniqid(rand().'_');
            $orderNo = $nowDate . '_' . $randName;

            if($product->pivot->quantity > $quantity) {
                return redirect()->route('cart.index');
            } else {
                try {
                    DB::transaction(function () use($product, $nowDate, $orderNo, $request) {
                        Stock::create([
                            'product_id' => $product->id,
                            'type' => 2,
                            'quantity' => $product->pivot->quantity * -1
                        ]);
                        Order::create([
                            'user_id' => $product->pivot->user_id,
                            'product_id' => $product->id,
                            'purchase_date' => $nowDate,
                            'order_number' => $orderNo,
                            'quantity' => $product->pivot->quantity,
                            'payment_id' => $request->payment,
                            'status' => 1
                        ]);
                        Cart::where('user_id', Auth::id())->delete();
                    }, 2);
                } catch(Throwable $e) {
                    Log::error($e);
                    throw $e;
                }
                // Stock::create([
                //     'product_id' => $product->id,
                //     'type' => 2,
                //     'quantity' => $product->pivot->quantity * -1
                // ]);
                // Order::create([
                //     'user_id' => $product->pivot->user_id,
                //     'product_id' => $product->id,
                //     'purchase_date' => $nowDate,
                //     'order_number' => $orderNo,
                //     'quantity' => $product->pivot->quantity,
                //     'payment_id' => 1,
                //     'status' => 1
                // ]);
                // Cart::where('user_id', Auth::id())->delete();
            }
        }
        return view('product.payment-complete');
    }
}
