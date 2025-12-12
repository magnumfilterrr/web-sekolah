<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelulusanController extends Controller
{
    /**
     * Tampilkan form input token
     */
    public function index()
    {
        return view('frontend.kelulusan.index');
    }

    /**
     * Cek kelulusan berdasarkan NIS/Token
     */
    public function cek(Request $request)
    {
        $request->validate([
            'token' => 'required|string|min:3',
        ], [
            'token.required' => 'Token NIS wajib diisi',
            'token.min' => 'Token NIS minimal 3 karakter',
        ]);

        // Cari siswa berdasarkan NIS (case-insensitive)
        $kelulusan = Kelulusan::where('nis', strtoupper($request->token))
            ->orWhere('nis', strtolower($request->token))
            ->orWhere('nis', $request->token)
            ->with('jurusan')
            ->first();

        // Jika token tidak ditemukan
        if (!$kelulusan) {
            return redirect()
                ->route('kelulusan.index')
                ->with('error', 'Token NIS tidak ditemukan! Pastikan Anda memasukkan NIS dengan benar.');
        }

        // Redirect ke halaman hasil
        return view('frontend.kelulusan.hasil', [
            'kelulusan' => $kelulusan
        ]);
    }

    /**
     * Download PDF kelulusan
     */
    public function download($id)
    {
        $kelulusan = Kelulusan::findOrFail($id);

        // Validasi: Siswa LULUS LUNAS atau TIDAK LULUS yang bisa download
        // LULUS tapi BELUM BAYAR tidak bisa download
        if ($kelulusan->isLulusBelumBayar()) {
            return redirect()
                ->route('kelulusan.index')
                ->with('error', 'Anda tidak memiliki akses untuk download file ini. Silakan selesaikan administrasi pembayaran terlebih dahulu.');
        }

        // Validasi: File PDF harus ada
        if (!$kelulusan->file_pdf) {
            return redirect()
                ->route('kelulusan.index')
                ->with('error', 'File PDF tidak ditemukan.');
        }

        // Generate nama file untuk download
        $fileName = 'Kelulusan_' . str_replace(' ', '_', $kelulusan->nama_siswa) . '_' . $kelulusan->tahun_lulus . '.pdf';

        // Cek di disk 'public' dulu
        if (Storage::disk('public')->exists($kelulusan->file_pdf)) {
            $filePath = Storage::disk('public')->path($kelulusan->file_pdf);
            return response()->download($filePath, $fileName);
        }

        // Fallback: cek di default disk (storage/app)
        if (Storage::exists($kelulusan->file_pdf)) {
            $filePath = Storage::path($kelulusan->file_pdf);
            return response()->download($filePath, $fileName);
        }

        // File benar-benar tidak ada
        return redirect()
            ->route('kelulusan.index')
            ->with('error', 'File PDF tidak ditemukan di server. Silakan hubungi administrasi.');
    }
}
