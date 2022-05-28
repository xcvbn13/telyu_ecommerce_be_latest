<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();

        return response([
            'products' => $products,
        ], 200);
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
        $date = Carbon::now()->format('Ymd');

        $orderController = new OrderController();
        $uniqid = $orderController->generateUniqueId();

        $no_resi = 'INV/'.$date.'/'.$uniqid;

        $order = Order::create([
            'no_resi' => $no_resi,
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'status_order_id' => 1
        ]);

        $review = Order::findOrFail($order->id);

        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
    }
    
    public function generateUniqueId() {
        $uniqid = mt_rand(1000000000, 9999999999);

        $orderController = new OrderController();

        if($orderController->checkUniqueId($uniqid) == true){
            $orderController->generateUniqueId();
        }

        return $uniqid;
    }
    public function checkUniqueId($uniqid) {
        $check = Order::where('no_resi','LIKE','%'.$uniqid.'%')->exists();
        return $check;
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
    public function update(Request $request, $id)
    {
        //
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
}
