<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Setting;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::where('is_active', true)
            ->orderBy('urutan')
            ->get();

        $settings = Setting::pluck('value', 'key');

        return view('frontend.jurusan.index', compact('jurusans', 'settings'));
    }

    public function show($slug)
    {
        $jurusan = Jurusan::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $settings = Setting::pluck('value', 'key');

        return view('frontend.jurusan.show', compact('jurusan', 'settings'));
    }
}
