<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id';
    // protected $fillable = ['nip_dosen', 'sidang_ta_id', 'slot_id', 'status', 'proposal_id', 'created_at', 'updated_at', 'deleted_at'];
     public function transaksi(){
    	return $this->hasOne('App\Model\Transaksi','id_laporan', 'id');
    }
}
