<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
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
        //
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
        $data = $request->except(['total','_token']);
        $total = $request->input("total");
        $ids = $request->input("ids");
        $category_ids = $request->input("category_ids");
        // dd($category_ids);
        $quantities = $request->input("quantities");
        $new_order_data = [
            'total_price' =>$request->total,
            'user_id' => Auth::id()
        ];
        $order_id = Order::insertGetId($new_order_data);
        // $order = Order::
        $record = [];
        for($i=0;$i<count($ids);$i++){
            // var_dump($i);
            $record['category_id'] = $category_ids[$i];
            $record['quantity'] = $quantities[$i];
            $package = Package::find($ids[$i]);
            $order = Order::find($order_id);
            $users = User::find(Auth::user()->id);
            $order->packages()->attach($ids[$i],$record);
            // $users->packages()->attach($ids[$i],['category_id'=>$category_ids[$i]]);
        }
        // dd($request->total);
        return redirect()->route('pay_order',['order'=>$order_id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->route('MyOrders');
         //               ->with('success','Category deleted successfully');
    }
    public function myOrders()
    {
        $user_id = Auth::user()->id;
        $user = User::with("orders")->find($user_id);
        return view('front.user.orders',["user"=>$user]);
    }
    public function details($id)
    {
        $order = Order::with("packages")->find($id);
        // dd($order);
        return view('front.user.details',["order"=>$order]);
    }
}
