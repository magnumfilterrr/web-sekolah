<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Models\Setting;

class ProfilController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('urutan')->get();
        $settings = Setting::pluck('value', 'key');

        return view('frontend.profil', compact('fasilitas', 'settings'));
    }
}
