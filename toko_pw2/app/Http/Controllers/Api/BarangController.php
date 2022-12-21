<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        if(count($barangs) > 0){
            return response([
                'message' => 'Retrive All Success',
                'data' => $barangs
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

    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'nama' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'deskripsi' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $barang = Barang::create($storeData);
        return response([
            'message' => 'Add Barang Success',
            'data' => $barang
        ], 200);
    }

    public function show($id)
    {
        $barang = Barang::find($id);

        if(!is_null($barang)){
            return response([
                'message' => 'Retrive Barang Success',
                'data' => $barang
            ], 200);
        }

        return response([
            'message' => 'Barang Not Found',
            'data' => null
        ], 404);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if(is_null($barang)){
            return response([
                'message' => 'Barang Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'deskripsi' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $barang->nama = $updateData['nama'];
        $barang->harga = $updateData['harga'];
        $barang->jumlah = $updateData['jumlah'];
        $barang->deskripsi = $updateData['deskripsi'];

        if($barang->save()){
            return response([
                'message' => 'Update Barang Success',
                'data' => $barang
            ], 200);
        }

        return response([
            'message' => 'Update Barang Failed',
            'data' => null
        ], 400);
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if(is_null($barang)){
            return response([
                'message' => 'Barang Not Found',
                'data' => null
            ], 404);
        }

        if($barang->delete()){
            return response([
                'message' => 'Delete Barang Success',
                'data' => $barang
            ], 200);
        }

        return response([
            'message' => 'Delete Barang Failed',
            'data' => null
        ], 400);   
    }
}
