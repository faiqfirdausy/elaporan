<?php

namespace App\Http\Controllers\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\storage;
use App\Model\User;
use App\Model\Transaksi;
use Carbon;

class RevisiController extends Controller
{
    public function index()
    {
        $data['laporan'] = Transaksi::where('id_laporan',1)->get();
        return view('revisi.index', $data);
    }

    public function create()
    {

        return view('bulanan.create');
    }
    public function ubah(Request $request, $id)
    {
        $data['laporan'] = Transaksi::findOrFail($id);
        return view('bulanan.ubah',$data);

    }
    public function update(request $request)
    {
        DB::beginTransaction();

            try {
                $fileLaporan = null;
                $time = Carbon\Carbon::now()->format('d-m-Y_H-i-s');
                // dd($time);
       // dd($request);

                $transaksi = Transaksi::findOrFail($request->id_transaksi);
                $transaksi->keterangan = $request->keterangan;
                $transaksi->id_upt = Auth::user()->id_upt;
                $transaksi->id_laporan = 1;
                $transaksi->detil_laporan = $request->detillaporan;
                $transaksi->tahun = $request->tahun;
                $transaksi->updated_by = Auth::user()->id;
                $checkpath = $transaksi->path;
                if($checkpath != null)
                {
                     Storage::disk('local')->delete($transaksi->path);
                     if ($request->hasFile('file_laporan'))
                    {
                        $file = $request->file('file_laporan');
                        $filename = 'file_laporan_'.$time.'.'.$file->getClientOriginalExtension();
                        Storage::disk('local')->putFileAs('file_laporan/bulanan', $file, $filename);
                        $fileLaporan = 'file_laporan/bulanan/'.$filename;
                    }

                }
                 //dd($request->file('file_laporan'));
              

                $transaksi->path = $fileLaporan;
                $transaksi->save();

                DB::commit();
                // \Session::flash('success_flash_message','Data Mahasiswa Berhasil Ditambah.');
                return redirect('laporan/bulanan');

            } catch (Exception $e) {
                return response()->json(['error' => 'silahkan coba lagi']);
                DB::rollback();
            }
    }
    public function delete(Request $request)
    {
          DB::beginTransaction();

            try {
                $fileLaporan = null;
                $time = Carbon\Carbon::now()->format('d-m-Y_H-i-s');
                // dd($time);
       // dd($request);

                $transaksi = Transaksi::findOrFail($request->id_transaksi);
                $transaksi->delete();
                $checkpath = $transaksi->path;
                if($checkpath != null)
                {
                     Storage::disk('local')->delete($transaksi->path);

                }
                 //dd($request->file('file_laporan'));
              



                DB::commit();
                // \Session::flash('success_flash_message','Data Mahasiswa Berhasil Ditambah.');
                return redirect('laporan/bulanan');

            } catch (Exception $e) {
                return response()->json(['error' => 'silahkan coba lagi']);
                DB::rollback();
            }
    }

    public function store(Request $request)
    {
        // $rules = array(
        //     'student_nrp_number' => 'required',
        //     'student_name' => 'required|string',
        //     'password' => 'required|string|min:6|confirmed',
        //     'password_confirmation' => 'required',
        // );

        // $messages = [
        //     'required' => 'Kolom ini wajib diisi.',
        //     'string' => 'Kolom ini hanya diisi huruf',
        //     'numeric' => 'Kolom ini hanya diisi angka',
        //     'confirmed' => 'Konfirmasi password ini tidak cocok.',
        //     'min' => [
        //         'string'  => 'Isian ini harus minimal :min karakter.',
        //     ]
        // ];

        // $validator = Validator::make($request->all(), $rules, $messages);

        // if ($validator->fails()) {
            // return response()->json(['error'=>$validator->errors()]);
        // } else {
            DB::beginTransaction();

            try {
                $fileLaporan = null;
                $time = Carbon\Carbon::now()->format('d-m-Y_H-i-s');
                // dd($time);

                $transaksi = new Transaksi;
                $transaksi->keterangan = $request->keterangan;
                $transaksi->id_upt = Auth::user()->id_upt;
                $transaksi->id_laporan = 1;
                $transaksi->detil_laporan = $request->detillaporan;
                $transaksi->status = 1;

                $transaksi->tahun = $request->tahun;


                $transaksi->created_by = Auth::user()->id;

                // dd($request->file('file_laporan'));
                if ($request->hasFile('file_laporan')) {
                    $file = $request->file('file_laporan');
                    $filename = 'file_laporan_'.$time.'.'.$file->getClientOriginalExtension();
                    Storage::disk('local')->putFileAs('file_laporan/bulanan', $file, $filename);
                    $fileLaporan = 'file_laporan/bulanan/'.$filename;
                }


                $transaksi->path = $fileLaporan;
                $transaksi->save();

                DB::commit();
                // \Session::flash('success_flash_message','Data Mahasiswa Berhasil Ditambah.');
                return redirect('laporan/bulanan');

            } catch (Exception $e) {
                return response()->json(['error' => 'silahkan coba lagi']);
                DB::rollback();
            }
    }
}