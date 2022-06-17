<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $order = Order::where('status_order_id',1)
        ->where('status_order_id',1)
        ->where('status_order_id',2)
        ->where('status_order_id',3)
        ->where('status_order_id',6)
        ->where('status_order_id',7)
        ->with(['cart','status_order'])->get();
        $countOrder = Order::where('status_order_id',1)->count();
        $countVerifikasi = Order::where('status_order_id',2)->count();
        $countTerverifikasi = Order::where('status_order_id',3)->count();
        $countSelesai = Order::where('status_order_id',7)->count();
        // dd($countOrder);

        $data = [
            'order' => $order,
            'countOrder' => $countOrder,
            'countVerifikasi' => $countVerifikasi,
            'countTerverifikasi' => $countTerverifikasi,
            'countSelesai' => $countSelesai,
        ];

        return view('Dashboard.home',$data);
    }

    public function index_detail($id)
    {
        $order = Order::where('id',$id)->with(['cart','status_order'])->first();

        $cartId = Order::where('id',$id)->pluck('id_cart');
        $product = CartItem::where('id_cart',$cartId)->get();
        // dd($cartId);
        $data = [
            'order' => $order,
            'product' => $product,
        ];

        return view('Dashboard.detail',$data);
    }
}
