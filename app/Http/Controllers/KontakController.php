<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class KontakController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');

        return view('frontend.kontak', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'pesan' => 'required',
        ]);

        // TODO: Kirim email atau simpan ke database
        // Untuk sekarang, return success message

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
