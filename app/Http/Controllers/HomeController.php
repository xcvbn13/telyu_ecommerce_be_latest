<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $order = Order::with(['user','product','status_order'])->get();
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
}
