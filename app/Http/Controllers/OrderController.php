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
use App\Models\StatusOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KalkulasiController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\UpdateStatusOrderController;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::where('id_user',auth()->user()->id)->where('id_status_cart',2)->get();
        $idCartArray = [];
        $data = [];
        foreach ($cart as $value) {
            $idCartArray[] = $value->id;
        }

        foreach ($idCartArray as $value){
            $order = Order::where('id_cart',$value)->first();
            $data[] = $order;
        }

        return response([
            'data' => $data,
        ], 200);
    }

    public function payment(){
        
        $opsiKirim = Opsikirim::all();

        $metode_pembayaran = MetodePembayaran::where('status_metode','Aktif')->get();

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

    //  order -> status -> 1 
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'opsikirim' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        // create INV uniq
        $date = Carbon::now()->format('Ymd');

        $orderController = new OrderController();
        $uniqid = $orderController->generateUniqueId();

        $no_resi = 'INV/'.$date.'/'.$uniqid;

        // kalkulasi Controller 
        $kalkulasi = new KalkulasiController();
        $cart = Cart::where('id_user',auth()->user()->id)->where('id_status_cart',1)->first(); //Cart yang digunakan oleh user
        
        // total harga -> create order
        $cartItem = CartItem::where('id_cart',$cart->id)->get();
        if(sizeof($cartItem) == 0){
            return response([
                'message' => "Tambah Produk Ke Cart Terlebih Dahulu",
            ], 400);
        }
        $totalHargaOnOrder = $kalkulasi->totalHargaOnOrder($cart->id , $cartItem);

        // pengurangan jumlah barang di table 
        $kalkulasi->penguranganJumlahProductOnOrder($cart->id);

        // status order create
        $status_order = StatusOrder::where('id',1)->first();

        // pilih opsi kirim
        $opsi_kirim_order = Opsikirim::where('id', $request->opsikirim)->first();
        
        $order = Order::create([
            'no_resi' => $no_resi,
            'jumlah_harga' => $totalHargaOnOrder,
            'name_user' => auth()->user()->name,
            'alamat' => $request->alamat,
            'status_order' => $status_order->status,
            'id_cart' => $cart->id,
            'opsikirim' => $opsi_kirim_order->opsi,
            'id_metode_pembayaran' => $request->metode_pembayaran,
        ]);

        // update jumlah order di metode pembayaran
        $metode_pembayaran_count = new MetodePembayaranController();
        $metode_pembayaran_count->jumlahOrder($request->metode_pembayaran);
        
        // non aktif cart
        $cart->id_status_cart = 2;
        $cart->save();
        // ---------
        // Pembuatan Cart baru untuk user 
        $cartCreate = Cart::create([
            'id_user' => auth()->user()->id,
            'id_status_cart' => 1
        ]);
        // -----------------------

        return response([
            'message' => "Berhasil"
        ], 200);
    }

    public function generateUniqueId() {
        $uniqid = time().mt_rand(111,999);
        return $uniqid;
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
        $updateOrder->pembayaran_id = $idPembayaran;
        $updateOrder->save();

        // update status order 
        $updateStatusOrder = new UpdateStatusOrderController();
        $updateStatusOrder->updateStatusOrder(2,$id);

        return response([
            'message' => "Berhasil",
        ], 200);
    }

    // order -> status -> 4

    public function store_dibatalkan($id){

        $updateOrder = Order::findOrFail($id);

        $kalkulasi = new KalkulasiController();
        $kalkulasi->penambahanJumlahProductOnOrder($updateOrder->id_cart);

        // update status order 
        $updateStatusOrder = new UpdateStatusOrderController();
        $updateStatusOrder->updateStatusOrder(4,$id);

        return response([
            'message' => "Berhasil",
        ], 200);
    }

    // order -> status -> 5

    public function store_waktu_habis($id){

        $updateOrder = Order::findOrFail($id);

        $kalkulasi = new KalkulasiController();
        $kalkulasi->penambahanJumlahProductOnOrder($updateOrder->id_cart);

        // update status order 
        $updateStatusOrder = new UpdateStatusOrderController();
        $updateStatusOrder->updateStatusOrder(5,$id);

        return response([
            'message' => "Berhasil",
        ], 200);
    }

    

    // order -> status -> 7

    public function store_selesai(Request $request, $id){

        // update status order 
        $updateStatusOrder = new UpdateStatusOrderController();
        $updateStatusOrder->updateStatusOrder(7,$id);

        return response([
            'message' => "Berhasil",
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
}
