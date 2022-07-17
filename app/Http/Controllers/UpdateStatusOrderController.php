<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\StatusOrder;
use Illuminate\Http\Request;

class UpdateStatusOrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatusOrder($idStatus , $idOrder)
    {
        // status order create
        $status_order = StatusOrder::where('id',$idStatus)->first();
        
        $order = Order::findOrFail($idOrder);
        $order->status_order = $status_order->status;
        $order->save();
        
    }

    
}
