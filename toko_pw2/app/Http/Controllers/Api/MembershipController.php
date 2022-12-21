<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Membership;

class MembershipController extends Controller
{
    public function index()
    {
        $membership = DB::table('memberships')->select('memberships.*', 'users.username')
        ->join('users', 'id_user_membership', '=', 'users.id')->get();

        if(count($membership) > 0){
            return response([
                'message' => 'Retrive All Success',
                'data' => $membership
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
        $membership = DB::table('memberships')->select('memberships.*', 'users.username')
        ->join('users', 'id_user_membership', '=', 'users.id')
        ->where('memberships.id', '=', $id)
        ->get();   

        if(!is_null($membership)){
            return response([
                'message' => 'Retrive Barang Success',
                'data' => $membership
            ], 200);
        }

        return response([
            'message' => 'Membership Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'id_user_membership' => 'required',
            'jenis_membership' => 'required',
            'deskripsi_membership' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $membership = Membership::create($storeData);
        return response([
            'message' => 'Add Membership Success',
            'data' => $membership
        ], 200);
    }

    public function destroy($id)
    {
        $membership = Membership::find($id);

        if(is_null($membership)){
            return response([
                'message' => 'Membership Not Found',
                'data' => null
            ], 404);
        }

        if($membership->delete()){
            return response([
                'message' => 'Delete Membership Success',
                'data' => $membership
            ], 200);
        }

        return response([
            'message' => 'Delete Membership Failed',
            'data' => null
        ], 400);   
    }

    public function edit($id)
    {
        //
    }

    public function update($id, Request $request)
    {
        $membership = Membership::find($id);

        if(is_null($membership)){
            return response([
                'message' => 'Membership Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_user_membership' => 'required',
            'jenis_membership' => 'required',
            'deskripsi_membership' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $membership->id_user_membership = $updateData['id_user_membership'];
        $membership->jenis_membership = $updateData['jenis_membership'];
        $membership->deskripsi_membership = $updateData['deskripsi_membership'];

        if($membership->save()){
            return response([
                'message' => 'Update Membership Success',
                'data' => $membership
            ], 200);
        }

        return response([
            'message' => 'Update Membership Failed',
            'data' => null
        ], 400);
    }
}
