<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil berita utama
        $query = Berita::where('is_published', true);

        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $beritas = $query->latest('published_at')->paginate(9);

        // Ambil berita populer (berdasarkan jumlah views)
        $populer = Berita::where('is_published', true)
            ->orderByDesc('views')
            ->take(3)
            ->get();

        // Ambil daftar kategori unik dari field kategori di tabel berita
        $kategori = Berita::select('kategori')
            ->whereNotNull('kategori')
            ->distinct()
            ->get();

        // Ambil arsip bulanan (misalnya Oktober 2025)
        $arsip = Berita::selectRaw('DATE_FORMAT(published_at, "%M %Y") as bulan, COUNT(*) as jumlah')
            ->where('is_published', true)
            ->groupBy('bulan')
            ->orderByRaw('MIN(published_at) DESC')
            ->pluck('jumlah', 'bulan');

        $settings = Setting::pluck('value', 'key');

        return view('frontend.berita.index', compact('beritas', 'populer', 'kategori', 'arsip', 'settings'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Tambah jumlah views
        $berita->increment('views');

        // Berita terkait
        $related = Berita::where('is_published', true)
            ->where('kategori', $berita->kategori)
            ->where('id', '!=', $berita->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $settings = Setting::pluck('value', 'key');

        return view('frontend.berita.show', compact('berita', 'related', 'settings'));
    }
}
