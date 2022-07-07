<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Products;
use App\Models\Opsikirim;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KalkulasiController;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::where('id_user',auth()->user()->id)->where('id_status_cart',2)->without(['cart_item','user','status'])->with(['order'])->get();  

        return response([
            'data' => $cart,
        ], 200);
    }

    public function payment(){
        
        $opsiKirim = Opsikirim::all();

        $metode_pembayaran = MetodePembayaran::where('id_status_metode',1)->get();

        $user = User::where('id',auth()->user()->id)->pluck('alamat');

        $data = [
            'opsiKirim' => $opsiKirim,
            'user' =>$user,
            'metode_pembayaran' =>$metode_pembayaran
        ];

        return response([
            'message' => "data payment",
            'data' => $data,
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
        $request->validate([
            'alamat' => 'required',
            'opsikirim' => 'required',
            'metode_pembayaran' => 'required'
        ]);

        $date = Carbon::now()->format('Ymd');

        $orderController = new OrderController();
        $uniqid = $orderController->generateUniqueId();

        $no_resi = 'INV/'.$date.'/'.$uniqid;

        $kalkulasi = new KalkulasiController();
        $cart = Cart::where('id_user',auth()->user()->id)->where('id_status_cart',1)->first();
        
        // total harga -> create order
        $totalHargaOnOrder = $kalkulasi->totalHargaOnOrder($cart->id);

        // pengurangan jumlah barang di table 
        $kalkulasi->penguranganJumlahProductOnOrder($cart->id);
        
        $order = Order::create([
            'no_resi' => $no_resi,
            'jumlah_harga' => $totalHargaOnOrder,
            'alamat' => $request->alamat,
            'status_order_id' => 1,
            'id_cart' => $cart->id,
            'id_opsikirim' => $request->opsikirim,
            'id_metode_pembayaran' => $request->metode_pembayaran
        ]);

        
        // non aktif cart 
        $cart->id_status_cart = 2;
        $cart->save();

        $cartCreate = Cart::create([
            'id_user' => auth()->user()->id,
            'id_status_cart' => 1
        ]);

        $review = Order::where('id',$order->id)->with(['status_order','cart','opsikirim','metodepembayaran'])->get();

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
        $check = Order::where('no_resi','LIKE','%'.$uniqid.'%')->get();
        if($check->count() > 0){
            return true;
        }
        return false;
    }

    //  order -> status -> 2 

    public function store_pembayaran(Request $request,$id){

        $request->validate([
            'pembayaran' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        $file = $request->file('pembayaran');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
		$tujuan_upload = 'data_img_pembayaran';
		$file->move($tujuan_upload,$nama_file);

        $pembayaran = Pembayaran::create([
            'bukti_pembayaran' => $nama_file,
        ]);

        $idPembayaran = $pembayaran->id;

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 2;
        $updateOrder->pembayaran_id = $idPembayaran;
        $updateOrder->save();

        $review = Order::where('id',$updateOrder->id)->with(['status_order','cart','opsikirim','metodepembayaran','pembayaran'])->get();

        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
    }

    // order -> status -> 4

    public function store_dibatalkan($id){

        $updateOrder = Order::findOrFail($id);

        $kalkulasi = new KalkulasiController();
        $kalkulasi->penambahanJumlahProductOnOrder($updateOrder->id_cart);

        $updateOrder->status_order_id = 4;
        $updateOrder->save();

        $review = Order::where('id',$updateOrder->id)->with(['status_order','cart','opsikirim','metodepembayaran','pembayaran'])->get();

        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
    }

    // order -> status -> 5

    public function store_waktu_habis($id){

        $updateOrder = Order::findOrFail($id);

        $kalkulasi = new KalkulasiController();
        $kalkulasi->penambahanJumlahProductOnOrder($updateOrder->id_cart);

        $updateOrder->status_order_id = 5;
        $updateOrder->save();

        $review = Order::where('id',$updateOrder->id)->with(['status_order','cart','opsikirim','metodepembayaran','pembayaran'])->get();

        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
    }

    

    // order -> status -> 7

    public function store_selesai(Request $request, $id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 7;
        $updateOrder->save();

        $review = Order::where('id',$updateOrder->id)->with(['status_order','cart','opsikirim','metodepembayaran','pembayaran'])->get();

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
        $review = Order::findOrFail($id)->with(['status_order','cart','opsikirim','metodepembayaran','pembayaran'])->get();

        return response([
            'data' => $review,
        ], 200);
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
