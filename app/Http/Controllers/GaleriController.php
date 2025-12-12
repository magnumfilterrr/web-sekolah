<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\Setting;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $tipe = $request->get('tipe', 'foto');

        $galeris = Galeri::where('tipe', $tipe)
            ->orderBy('urutan')
            ->get();

        $settings = Setting::pluck('value', 'key');

        return view('frontend.galeri', compact('galeris', 'settings', 'tipe'));
    }
}
