<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Jurusan;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)
            ->orderBy('urutan')
            ->get();

        $jurusans = Jurusan::where('is_active', true)
            ->orderBy('urutan')
            ->take(3)
            ->get();

        $beritas = Berita::where('is_published', true)
            ->where('kategori', 'berita')
            ->latest('published_at')
            ->take(3)
            ->get();

        $galeris = Galeri::where('tipe', 'foto')
            ->orderBy('urutan')
            ->take(6)
            ->get();

        $settings = Setting::pluck('value', 'key');

        return view('frontend.home', compact('sliders', 'jurusans', 'beritas', 'galeris', 'settings'));
    }
}
