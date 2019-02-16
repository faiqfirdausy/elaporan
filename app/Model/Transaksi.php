<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    // protected $fillable = ['nip_dosen', 'sidang_ta_id', 'slot_id', 'status', 'proposal_id', 'created_at', 'updated_at', 'deleted_at'];

        public function upt(){
    	return $this->hasOne('App\Model\Upt','id_upt', 'id');
    }
        public function laporan(){
    	return $this->hasOne('App\Model\Laporan','id', 'id_laporan');
    }
         public function bulan(){
    	return $this->hasOne('App\Model\Bulan','id', 'detil_laporan');
    }
        public function semester(){
    	return $this->hasOne('App\Model\Semester','id', 'detil_laporan');
    }
        public function triwulan(){
    	return $this->hasOne('App\Model\Triwulan','id', 'detil_laporan');
    }
        public function status(){
    	return $this->hasOne('App\Model\Status','id', 'id_status');
    }
}
