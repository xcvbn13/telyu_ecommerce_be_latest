<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cekCategory = Category::all()->count();

        if($cekCategory < 1){
            Alert::warning('Kategori Kosong', 'Tambahkan Kategori Terlebih Dahulu');

            return redirect('admin/merchandise/kategori');
        }

        $product = Products::where('jumlah_product','>',0)->get();

        $data = [
            'product' => $product,
        ];

        return view('Merchandise.Merchandise.index',$data);
    }
    public function index_stok()
    {
        $product = Products::where('jumlah_product','=',0)->get();

        return view('Merchandise.Stok.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        return view('Merchandise.Merchandise.form',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name'=> 'required|string',
            'gambar_product' => 'required',
            'jumlah_produk'=> 'required|numeric',
            'product_description'=> 'required|string',
            'harga_produk'=> 'required|numeric',
            'kategori'=> 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Fail!', 'Periksa Data Yang Diinputkan Kembali');
            return redirect()->back()->withInput();
            // return response([
            //     'error' => $request->gambar_product
            // ]);
        }

        $file = $request->file('gambar_product');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
		$tujuan_upload = 'img_produk';
		$file->move($tujuan_upload,$nama_file);

        $merchandise = Products::create([
            'product_name' => $request->product_name,
            'gambar_product' => $nama_file,
            'jumlah_product' => $request->jumlah_produk,
            'deskripsi_product' => $request->product_description,
            'harga' => $request->harga_produk,
            'id_category' => $request->kategori
        ]);

        Alert::success('Berhasil', 'Produk Berhasil Ditambahkan');
        
        return redirect('admin/merchandise/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::findOrFail($id);

        $data = [
            'product' => $product,
        ];

        return view('Merchandise.Merchandise.detail',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $category = Category::all();

        return view('Merchandise.Merchandise.edit',compact('product','category'));
    }

    public function edit_stok($id)
    {
        $product = Products::findOrFail($id);

        return $product;
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
        $validator = Validator::make($request->all(), [
            'product_name'=> 'required|string',
            'jumlah_produk'=> 'required|numeric',
            'product_description'=> 'required|string',
            'harga_produk'=> 'required|numeric',
            'kategori'=> 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Fail!', 'Periksa Data Yang Diinputkan Kembali');
            return redirect()->back()->withInput();
        }

        

        $product = Products::findOrFail($id);
        $product->product_name = $request->product_name;
        $product->jumlah_product = $request->jumlah_produk;
        $product->deskripsi_product = $request->product_description;
        $product->harga = $request->harga_produk;
        $product->id_category = $request->kategori;

        if ($request->gambar_product != null){
            $file = $request->file('gambar_product');
    
            $nama_file = time()."_".$file->getClientOriginalName();
    
            $tujuan_upload = 'img_produk';
            $file->move($tujuan_upload,$nama_file);

            $product->gambar_product = $nama_file;   
            
            $gambar = Products::findOrFail($id)->pluck('gambar_product')->first();

            if(\File::exists(public_path('img_produk/'.$gambar))){
                \File::delete(public_path('img_produk/'.$gambar));
            
            }
            
        }
        
        $product->save();

        Alert::success('Berhasil', 'Produk Berhasil Diubah');

        return redirect('admin/merchandise/product/detail_product/'.$id);
    }

    public function update_stok(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $product->jumlah_product = $request->stok_product;

        $product->save();

        return 'success';
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
