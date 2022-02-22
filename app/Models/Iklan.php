<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
    protected $table = 'data_iklan';
    public $timestamps = false;
    protected $dates = ['tanggal', 'tanggal_setor'];
    // protected $fillable = ['nama', 'tanggal', 'keterangan', 'jumlah', 'metode_pembayaran'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
