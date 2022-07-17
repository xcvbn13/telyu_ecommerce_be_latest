<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        $order = Order::where('status_order','Menunggu Pembayaran')
        ->orWhere('status_order','Menunggu Verifikasi')
        ->orWhere('status_order','Terverifikasi')
        ->orWhere('status_order','Verifikasi Gagal')
        ->orWhere('status_order','Selesai')
        ->with(['cart','statusnya_order'])->get();
        $countOrder = Order::where('status_order','Menunggu Pembayaran')->count();
        $countVerifikasi = Order::where('status_order','Menunggu Verifikasi')->count();
        $countTerverifikasi = Order::where('status_order','Terverifikasi')->count();
        $countSelesai = Order::where('status_order','Selesai')->count();
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
        $order = Order::where('id',$id)->first();

        $cart = Cart::findOrFail($order->id_cart)->with(['user'])->first();
        $product = CartItem::where('id_cart',$cart->id)->get();
        // dd($cartId);
        $data = [
            'order' => $order,
            'product' => $product,
            'cart' => $cart,
        ];

        return view('Dashboard.detail',$data);
    }
}
