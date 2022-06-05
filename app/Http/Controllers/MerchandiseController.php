<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

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

            return redirect('admin/dashboard');
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
        $merchandise = Products::create([
            'product_name' => $request->product_name,
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
        $product = Products::findOrFail($id);
        $product->product_name = $request->product_name;
        $product->jumlah_product = $request->jumlah_produk;
        $product->deskripsi_product = $request->product_description;
        $product->harga = $request->harga_produk;
        $product->id_category = $request->kategori;

        $product->save();

        Alert::success('Berhasil', 'Produk Berhasil Diubah');

        return redirect('admin/merchandise/detail_product/'.$id);
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
