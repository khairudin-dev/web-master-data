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
        'permohonan',
        'luas_akhir',
        'tg_pendahuluan',
        'i_pendahuluan',
        'k_pendahuluan',
        's_pendahuluan',
        'h_pendahuluan',
        'tg_pl1',
        'i_pl1',
        'k_pl1',
        's_pl1',
        'h_pl1',
        'tg_pl2',
        'i_pl2',
        'k_pl2',
        's_pl2',
        'h_pl2',
        'tg_pl3',
        'i_pl3',
        'k_pl3',
        's_pl3',
        'h_pl3',
        'panen',
        'lulus',
        'taksasi',
        'tonase',
        'umur_padi',
        'gkp',
        'cbb',
        'tg_p_spl',
        'p_spl',
        'tg_pengambilan',
        'doc_pengambilan',
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
        'bm',
        'bantuan',
        't_bantuan',
        'market',
        't_market',
        'penangkaran',
        't_penangkaran',
        'stok',
        'qcl'
    ];
    public function getAlamatPartsAttribute()
    {
        return explode(', ', $this->alamat);
    }
}
