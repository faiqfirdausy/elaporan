<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\storage;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Model\Transaksi;
use Carbon;
class UsersController extends Controller
{
    public function index()
    {
   		$data['users'] = User::get();
        return view('user.index', $data);
    }
       public function ubah(Request $request, $id)
    {
        $data['users'] = User::findOrFail($id);
        return view('user.ubah',$data);

    }
     public function update(request $request)
    {
        DB::beginTransaction();

            try {
                Auth::user()->password=Hash::make($request->password);
                Auth::user()->name= $request->name;
                // Auth::user()->email = $request->email;
                Auth::user()->save();

                DB::commit();
                // \Session::flash('success_flash_message','Data Mahasiswa Berhasil Ditambah.');
                return redirect('user');

            } catch (Exception $e) {
                return response()->json(['error' => 'silahkan coba lagi']);
                DB::rollback();
            }
    }

}