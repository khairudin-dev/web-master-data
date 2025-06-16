<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LahanController extends Controller
{
    public function getDetail($no_blok): Response
    {
        $lahan = Datatani::select('id', 'no_blok', 'nama', 'alamat', 'varietas', 'kb', 'musim', 'lokasi', 'i_label', 'label_sumber', 'semai', 'tanam', 'luas')->where('no_blok', $no_blok)->firstOrFail();
        // dd($lahan);
        return response()->view('partials.detail-lahan', compact('lahan'));
    }
}
