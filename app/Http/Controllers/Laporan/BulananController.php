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

class BulananController extends Controller
{
    public function index()
    {

        // $data['laporan'] = Transaksi::where('id_laporan',1)->get();
        
        return view('bulanan.index');
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

    public function hapus(Request $request)
    {
        $data = Transaksi::findOrFail($id);
        return $data;
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

    public function dataTablesBulanan(Request $request)
    {
        $limit = intval($request->length);
        $start = intval($request->start);
        $draw = intval($request->draw);
        $searchKey = $request->search['value'];
        $no = $start;

        $laporan = Transaksi::where('id_laporan', 1)
                        ->join('bulan', 'detil_laporan', '=', 'bulan.id')
                        ->join('laporan', 'id_laporan', '=', 'laporan.id')
                        ->join('status', 'id_status', '=', 'status.id')
                        ->get();

        $data = array();
        $totalData = intval(count($laporan));

        if(empty($searchKey)) {
            // $showLaporan = Transaksi::where('id_laporan', 1)->with('bulan', 'laporan', 'status')->limit($limit)->offset($start)->get();
            $showLaporan = Transaksi::select(DB::raw('id_transaksi, keterangan, bulan.nama AS nama_bulan, tahun, laporan.nama AS nama_laporan, status.nama AS nama_status, path'))
                                ->join('bulan', 'detil_laporan', '=', 'bulan.id')
                                ->join('laporan', 'id_laporan', '=', 'laporan.id')
                                ->join('status', 'id_status', '=', 'status.id')
                                ->where('id_laporan', 1)
                                ->limit($limit)
                                ->offset($start)
                                ->get();
            $totalFiltered = $totalData;
        } else {
            $showLaporan = Transaksi::select(DB::raw('id_transaksi, keterangan, bulan.nama AS nama_bulan, tahun, laporan.nama AS nama_laporan, status.nama AS nama_status, path'))
                                ->join('bulan', 'detil_laporan', '=', 'bulan.id')
                                ->join('laporan', 'id_laporan', '=', 'laporan.id') 
                                ->join('status', 'id_status', '=', 'status.id')
                                ->where(function($query) use($searchKey) {
                                    $query->where('keterangan', 'like', '%'.$searchKey.'%')
                                            ->orWhere('bulan.nama', 'like', '%'.$searchKey.'%')
                                            ->orWhere('tahun', 'like', '%'.$searchKey.'%')
                                            ->orWhere('status.nama', 'like', '%'.$searchKey.'%');
                                            ////nambah disini kalo mau nambah jenis laporan dtambahkan laporan.nama
                                })
                                ->where('id_laporan', 1);
            
            $totalFiltered = $showLaporan->count();
            $showLaporan = $showLaporan->limit($limit)->offset($start)->get();
        }

        foreach($showLaporan as $row) {
            $no = $no + 1;
            $data[] = [
                $no,
                $row->keterangan,
                !is_null($row->nama_laporan) ? $row->nama_laporan : '-',
                !is_null($row->nama_bulan) ? $row->nama_bulan : '-',
                $row->tahun,
                $row->path,
                !is_null($row->nama_status) ? $row->nama_status : '-',
                '<div>
                    <a href="'.url('laporan/bulanan/ubah/'.$row->id_transaksi.'').'" class="btn btn-sm btn-warning btn-flat">Ubah</a> 
                    <button type="button" class="btn btn-sm btn-danger btn-flat btn-delete" data-toggle="modal" data-id="'.$row->id_transaksi.'">Hapus</button>
                <div>',
            ];
        }
        
        $json_data = array(
            "draw"            => $draw,
            "recordsTotal"    => $totalData,  
            "recordsFiltered" => $totalFiltered, 
            "data"            => $data
        );

        return json_encode($json_data);
    }
}