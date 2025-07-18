<?php

namespace App\Http\Controllers;

use App\Models\Datatani;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    function index(): View
    {
        $hasil = "";
        if (Auth::user()->role == 'superadmin') {
            $hasil = Datatani::select('varietas', DB::raw('SUM(luas_akhir) as total_luas'))
                ->whereNotNull('lapang')
                ->whereNull('panen')
                ->groupBy('varietas')
                ->get();
            // dd($hasil->toArray());
        }


        return view('app', ['title' => 'Dashboard', 'hasil' => $hasil]);
    }
}
