<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RegisLapangController extends Controller
{
    public function lapang(): View
    {
        $title = "Daftar Lahan";
        $lahans = Datatani::latest()->get(['id', 'no_blok', 'nama', 'varietas', 'alamat', 'luas', 'semai', 'tanam']);
        // // Kirim data ke view
        return view('lahan', compact('title', 'lahans'));
    }
}
