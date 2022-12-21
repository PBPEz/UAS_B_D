<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Keranjang;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = DB::table('keranjangs')->select('keranjangs.*', 'users.username', 'barangs.nama',
        'barangs.harga', 'barangs.jumlah', 'barangs.deskripsi')
        ->join('users', 'id_user', '=', 'users.id')->join('barangs', 'barang_id', '=', 'barangs.id')->get();

        if(count($keranjang) > 0){
            return response([
                'message' => 'Retrive All Success',
                'data' => $keranjang
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function create()
    {   
        //
    }

    public function show($id)
    {
        $keranjang = DB::table('keranjangs')->select('keranjangs.*', 'users.username', 'barangs.nama',
        'barangs.harga', 'barangs.jumlah', 'barangs.deskripsi')
        ->join('users', 'id_user', '=', 'users.id')->join('barangs', 'barang_id', '=', 'barangs.id')
        ->where('keranjangs.id', '=', $id)
        ->get();   

        if(!is_null($keranjang)){
            return response([
                'message' => 'Retrive Barang Success',
                'data' => $keranjang
            ], 200);
        }

        return response([
            'message' => 'Keranjang Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'id_user' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'barang_id' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $keranjang = Keranjang::create($storeData);
        return response([
            'message' => 'Add Keranjang Success',
            'data' => $keranjang
        ], 200);
    }

    public function destroy($id)
    {
        $keranjang = Keranjang::find($id);

        if(is_null($keranjang)){
            return response([
                'message' => 'Keranjang Not Found',
                'data' => null
            ], 404);
        }

        if($keranjang->delete()){
            return response([
                'message' => 'Delete Keranjang Success',
                'data' => $keranjang
            ], 200);
        }

        return response([
            'message' => 'Delete Keranjang Failed',
            'data' => null
        ], 400);   
    }

    public function edit($id)
    {
        //
    }

    public function update($id, Request $request)
    {
        $keranjang = Keranjang::find($id);

        if(is_null($keranjang)){
            return response([
                'message' => 'Keranjang Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_user' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'barang_id' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $keranjang->id_user = $updateData['id_user'];
        $keranjang->nama_barang = $updateData['nama_barang'];
        $keranjang->jumlah = $updateData['jumlah'];
        $keranjang->total_harga = $updateData['total_harga'];
        $keranjang->barang_id = $updateData['barang_id'];

        if($keranjang->save()){
            return response([
                'message' => 'Update Keranjang Success',
                'data' => $keranjang
            ], 200);
        }

        return response([
            'message' => 'Update Keranjang Failed',
            'data' => null
        ], 400);
    }
}
