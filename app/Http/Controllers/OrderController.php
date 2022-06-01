<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Products;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idUser)
    {
        $products = Order::where('user_id',$idUser)->get();

        return response([
            'data' => $products,
        ], 200);
    }

    public function order_detail($idOrder)
    {
        $products = Order::findOrFail($idOrder);

        return response([
            'data' => $products,
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


    //  order -> status -> 1 
    public function store(Request $request)
    {
        $date = Carbon::now()->format('Ymd');

        $orderController = new OrderController();
        $uniqid = $orderController->generateUniqueId();

        $no_resi = 'INV/'.$date.'/'.$uniqid;

        $order = Order::create([
            'no_resi' => $no_resi,
            'jumlah' => $request->jumlah,
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

    //  order -> status -> 2 

    public function store_pembayaran(Request $request, $id){

        $pembayaran = Pembayaran::create([
            'bukti_pembayaran' => $request->pembayaran,
        ]);

        $idPembayaran = $pembayaran->id;

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 2;
        $updateOrder->pembayaran_id = $idPembayaran;
        $updateOrder->save();

        $products = Products::findOrFail($updateOrder->product_id);
        $products->jumlah_product = $products->jumlah_product - $updateOrder->jumlah;
        $products->save();

        $review = Order::findOrFail($id);

        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
    }

    // order -> status -> 3 

    public function store_dibatalkan(Request $request, $id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 3;
        $updateOrder->save();

        $review = Order::findOrFail($id);

        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
    }

    // order -> status -> 4 

    public function store_waktu_habis(Request $request, $id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 4;
        $updateOrder->save();

        $review = Order::findOrFail($id);

        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
    }

    // order -> status -> 5 

    public function store_verifikasi_gagal(Request $request, $id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 5;
        $updateOrder->save();

        $products = Products::findOrFail($updateOrder->product_id);
        $products->jumlah_product = $products->jumlah_product + $updateOrder->jumlah;
        $products->save();

        $review = Order::findOrFail($id);

        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
    }

    // order -> status -> 6

    public function store_selesai(Request $request, $id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 6;
        $updateOrder->save();

        $review = Order::findOrFail($id);

        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
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
