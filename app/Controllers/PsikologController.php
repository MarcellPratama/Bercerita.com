<?php

namespace App\Controllers;

use App\Models\PsikologModel;

class PsikologController extends BaseController
{
    public function dashboard()
    {
        $userId = session()->get('kd_psikolog');
    
        // Check if user ID exists in the session
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $psikologModel = new PsikologModel();
        $psikolog = $psikologModel->find($userId);
    
        // Check if psikolog data exists
        if (!$psikolog) {
            return redirect()->to('/login')->with('error', 'Data psikolog tidak ditemukan.');
        }
    
        // Set default values for missing fields
        $psikolog['username'] = $psikolog['username'] ?? 'Guest';
        $psikolog['tentang_saya'] = $psikolog['tentang_saya'] ?? '-';
        $psikolog['pendekatan_klinis'] = $psikolog['pendekatan_klinis'] ?? '-';
        $psikolog['domisili'] = $psikolog['domisili'] ?? 'Masukkan domisili Anda di sini.';
    
        return view('dashboardpsikolog', ['psikolog' => $psikolog]);
    }
    

  
    public function updateProfile()
    {
        $session = session();
        $userId = session()->get('kd_psikolog');
        
        $tentang_saya = $this->request->getPost('tentang_saya');
        $pendekatan_klinis = $this->request->getPost('pendekatan_klinis');
        $foto = $this->request->getFile('foto');
        
        $data = [
            'tentang_saya' => $tentang_saya,
            'pendekatan_klinis' => $pendekatan_klinis,
        ];
    
        // Cek jika ada foto yang di-upload
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName(); // Dapatkan nama file acak
            $foto->move('uploads', $newName); // Pindahkan file ke folder uploads
            $data['foto'] = $newName; // Update path foto di database
        }
    
        $psikologModel = new PsikologModel();
        $psikologModel->update($userId, $data); // Perbarui data psikolog di database
    
        // Mengirim respons sukses
        return $this->response->setJSON(['success' => true, 'message' => 'Profil berhasil diperbarui.']);
    }

    public function simpanLayanan()
{
    $session = session();
    $userId = session()->get('kd_psikolog'); // Ambil ID psikolog dari sesi

    if (!$userId) {
        return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
    }

    $layanan = $this->request->getPost('kasus'); // Ambil array layanan yang diceklis

    // Validasi jika layanan kosong atau lebih dari 4
    if (!$layanan || count($layanan) > 4) {
        return redirect()->back()->with('error', 'Anda hanya dapat memilih hingga 4 layanan.');
    }

    // Simpan ke database sebagai string JSON
    $data = [
        'layanan' => json_encode($layanan) // Mengubah array menjadi JSON
    ];

    $psikologModel = new PsikologModel();
    $psikologModel->update($userId, $data);

    // Set flashdata sukses
    return redirect()->back()->with('success', 'Layanan berhasil disimpan.');

}




}