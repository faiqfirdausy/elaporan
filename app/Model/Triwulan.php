<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Triwulan extends Model
{
    protected $table = 'triwulan';
    protected $primaryKey = 'id';
    // protected $fillable = ['nip_dosen', 'sidang_ta_id', 'slot_id', 'status', 'proposal_id', 'created_at', 'updated_at', 'deleted_at'];
     public function transaksi(){
    	return $this->hasOne('App\Model\Transaksi','detil_laporan', 'id');
    }
}
