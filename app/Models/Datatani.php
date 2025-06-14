<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datatani extends Model
{
    protected $guarded = "id";
    protected $fillable = [
        'no_blok',
        'nama',
        'lapang',
        'varietas',
        'kb',
        'musim',
        'alamat',
        'lokasi',
        'i_label',
        'label_sumber',
        'semai',
        'tanam',
        'luas',
        'tg_pendahuluan',
        'i_pendahuluan',
        'k_pendahuluan',
        'tg_pl1',
        'i_pl1',
        'k_pl1',
        'tg_pl2',
        'i_pl2',
        'k_pl2',
        'tg_p3',
        'i_p3',
        'k_p3',
        'panen',
        'lulus',
        'taksasi',
        'tonase',
        'umur_padi',
        'gkp',
        'cbb',
        'tg_pengambilan',
        'tg_selesai',
        'campuran',
        'kotoran_bersih',
        'ka',
        'kecambah',
        'mutu',
        'tonase_sertifikat',
        'no_sertifikat',
        'tg_kadaluarsa',
        'label',
        'seri_label',
        'bantuan',
        't_bantuan',
        'market',
        't_market',
        'penangkaran',
        't_penangkaran',
        'qcl'
    ];
    public function getAlamatPartsAttribute()
    {
        return explode(', ', $this->alamat);
    }
}
