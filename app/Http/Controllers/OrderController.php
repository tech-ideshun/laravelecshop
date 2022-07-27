<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status', '=', 1)->orderBy('purchase_date', 'asc')
                    ->with('product')->paginate(9);

                    return view('orders.index', [
                            'orders' => $orders,
                        ]);
    }

    public function index2()
    {
        $orders2 = Order::where('status', '=', 2)->orderBy('purchase_date', 'desc')
                    ->with('product')->paginate(9);

                    return view('orders.index2', [
                        'orders2' => $orders2,
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $order = Order::find($request->order_id)->update(['status' => 2]);
        return redirect('/order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function history()
    {
        $user = User::findOrFail(Auth::id());
        // $orders = $user->orders;
        // dd($orders[0]->product);
        $orders = Order::with('product')->where('user_id', $user->id)->get();
        // dd($orders);

        return view('orders.purchase-history', compact('orders'));
    }
}
