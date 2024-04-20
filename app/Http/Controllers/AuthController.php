<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends MyController
{
    public function index() {

        $users = User::orderBy('id', 'desc')->get();
        
        return response()->json($users);
    }

    public function show($id) {
        $user = User::find($id);
        return response()->json($user);
    }

    public function store(Request $request) {
        
        $this->validateRequest($request, 0);

        DB::beginTransaction();

        try {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            
            if(!$user->save()) {
                return response()->json(['status' => false, 'message' => 'Terjadi kesalahan!']);
            }

            DB::commit();

            return response()->json(['status' => true, 'message' => 'User berhasil ditambahkan', 'data' => $user]);

        } catch(\Throwable $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
            DB::rollBack();
        }

    }

    public function update($id, Request $request) {

        $this->validateRequest($request, 1);
        
        $user = User::find($id);
        if($user === null) {
            return response()->json(['status' => false, 'message' => 'User tidak ditemukan!']);
        }

        DB::beginTransaction();
        try {

            $user = [
                'name' => $request->name,
                'email' => $request->email
            ];

            if($request->has('password')) {
                $user['password'] = Hash::make($request->password);
            }

            User::where('id', $id)->update($user);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'User berhasil diupdate!']);

        } catch(\Throwable $e) {
            DB::rollBack();            
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }

    }

    public function destroy($id) {

        $user = User::find($id);

        if($user === null) {
            return response()->json(['status' => false, 'message' => 'User tidak ditemukan!']);
        }

        DB::beginTransaction();

        try {
            
            if (!$user->delete()) {
                return response()->json(['status' => false, 'message' => 'Gagal menghapus data']);
            }

            DB::commit();

            return response()->json(['status' => true, 'message' => 'User berhasil dihapus.']);

        } catch(\Throwable $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

}
