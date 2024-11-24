<?php

namespace App\Controllers;


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
        
            // Tambahkan ID registrasi
            if (!empty($userData)) {
                $userData['id'] = $registrasi['kd_registrasi']; // Pastikan key 'id' ada
                $data['pengguna'][] = $userData;
            }
        }
        
        // Kirim data ke view
        return view('viewVerifikasi', $data);  // Kirim array 'pengguna' ke view
    }

    public function lihatDetailMhs($id)
    {
        $registrasiModel = new registrasiModel();
        $mahasiswaModel = new mahasiswaModel();
    
        // Cari data registrasi untuk mendapatkan kd_mahasiswa
        $registrasi = $registrasiModel->where('kd_registrasi', $id)->first();
    
        if (!$registrasi || empty($registrasi['kd_mahasiswa'])) {
            return redirect()->to('/adminVerifikasi')->with('error', 'Data mahasiswa tidak ditemukan.');
        }
    
        // Cari data mahasiswa berdasarkan kd_mahasiswa
        $data['mahasiswa'] = $mahasiswaModel->find($registrasi['kd_mahasiswa']);
    
        if (!$data['mahasiswa']) {
            return redirect()->to('/adminVerifikasi')->with('error', 'Data mahasiswa tidak ditemukan.');
        }
    
        return view('viewLihatDetailMhsPsikologi', $data);
    }
    
    public function lihatDetailPsikolog($id)
    {
        $registrasiModel = new registrasiModel();
        $psikologModel = new psikologModel();
        
         // Cari data registrasi untuk mendapatkan kd_mahasiswa
         $registrasi = $registrasiModel->where('kd_registrasi', $id)->first();
    
         if (!$registrasi || empty($registrasi['kd_psikolog'])) {
             return redirect()->to('/adminVerifikasi')->with('error', 'Data psikolog tidak ditemukan.');
         }
     
         // Cari data mahasiswa berdasarkan kd_mahasiswa
         $data['psikolog'] = $psikologModel->find($registrasi['kd_psikolog']);
     
         if (!$data['psikolog']) {
             return redirect()->to('/adminVerifikasi')->with('error', 'Data psikolog tidak ditemukan.');
         }
     
         return view('viewLihatDetailPsikolog', $data);
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