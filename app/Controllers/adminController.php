<?php

namespace App\Controllers;

use App\Models\klienModel;
use App\Models\mahasiswaModel;
use App\Models\psikologModel;
use App\Models\registrasiModel;

class adminController extends BaseController
{
    public function verifikasi()
    {
        // Load models
        $registrasiModel = new registrasiModel();
        $psikologModel = new psikologModel();
        $mahasiswaModel = new mahasiswaModel();
        
        // Ambil semua data registrasi
        $registrasiData = $registrasiModel->findAll();
        
        // Array untuk menyimpan data lengkap pengguna
        $data['pengguna'] = [];
        
        // Loop melalui data registrasi untuk mendapatkan informasi lengkap
        foreach ($registrasiData as $registrasi) {
            $userData = [];
            
            // Cek apakah pengguna adalah psikolog
            if ($registrasi['kd_psikolog']) {
                $userData = $psikologModel->find($registrasi['kd_psikolog']);
                $userData['kategori'] = 'Psikolog';
            }
            // Cek apakah pengguna adalah mahasiswa
            elseif ($registrasi['kd_mahasiswa']) {
                $userData = $mahasiswaModel->find($registrasi['kd_mahasiswa']);
                $userData['kategori'] = 'Mahasiswa Psikologi';
            }
            // Jika tidak ada kategori (misalnya klien), jangan masukkan data ini
            else {
                continue;  // Skip data klien
            }
        
            // Menambahkan ID registrasi dan kategori
            $userData['kd_registrasi'] = $registrasi['kd_registrasi'];
        
            // Menambahkan ke array pengguna
            $data['pengguna'][] = $userData;
        }
        
        // Kirim data ke view
        return view('viewVerifikasi', $data);  // Kirim array 'pengguna' ke view
    }

    // Method untuk halaman Dashboard
    public function dashboard()
    {
        return view('viewDashboard');
    }

    public function lihatPsikolog()
    {
        return view('viewPsikolog');
    }

    public function lihatMhs()
    {
        return view('viewMhsPsikologi');
    }
}
