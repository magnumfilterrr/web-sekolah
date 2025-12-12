<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Jurusan;
use App\Models\Setting;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        // Validasi minimal 3 karakter
        if (strlen($query) < 3) {
            return redirect()->back()->with('error', 'Pencarian minimal 3 karakter');
        }

        // Search Berita
        $beritas = Berita::where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('konten', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->limit(10)
            ->get();

        // Search Jurusan
        $jurusans = Jurusan::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('nama_jurusan', 'like', "%{$query}%")
                    ->orWhere('deskripsi', 'like', "%{$query}%")
                    ->orWhere('kompetensi_lulusan', 'like', "%{$query}%")
                    ->orWhere('prospek_karir', 'like', "%{$query}%");
            })
            ->orderBy('urutan')
            ->get();

        $totalResults = $beritas->count() + $jurusans->count();

        $settings = Setting::pluck('value', 'key');

        return view('frontend.search', compact('query', 'beritas', 'jurusans', 'totalResults', 'settings'));
    }
}
