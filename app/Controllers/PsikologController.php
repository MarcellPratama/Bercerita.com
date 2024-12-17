<?php

namespace App\Controllers;

use App\Models\PsikologModel;

class PsikologController extends BaseController
{

    public function updateProfilePhoto()
{
    $psikologModel = new PsikologModel();

    // Ambil data user berdasarkan username yang ada di session
    $loggedInUsername = session()->get('username');
    $userData = $psikologModel->where('username', $loggedInUsername)->first();
    
    if (!$userData) {
        return redirect()->back()->with('error', 'Data psikolog tidak ditemukan.');
    }

    // Ambil input dari form
    $tentangSaya = $this->request->getPost('tentang_saya');
    $pendekatanKlinis = $this->request->getPost('pendekatan_klinis');
    $profilePicture = $this->request->getFile('foto');

    // Siapkan data untuk diupdate
    $dataToUpdate = [];

    // Update field "Tentang Saya"
    if (isset($tentangSaya)) { // Tangani baik isi kosong maupun ada input
        $dataToUpdate['tentang_saya'] = $tentangSaya === '' ? null : $tentangSaya;
    }

    // Update field "Pendekatan Klinis"
    if (isset($pendekatanKlinis)) { // Tangani baik isi kosong maupun ada input
        $dataToUpdate['pendekatan_klinis'] = $pendekatanKlinis === '' ? null : $pendekatanKlinis;
    }

    // Update Foto Profil
    if ($profilePicture && $profilePicture->isValid()) {
        // Proses upload foto profil
        $newProfilePicture = $profilePicture->getRandomName();
        $profilePicture->move('uploads/FOTO/', $newProfilePicture);
        $dataToUpdate['foto'] = '/uploads/FOTO/' . $newProfilePicture;
    }

    // Update data jika ada perubahan
    if (!empty($dataToUpdate)) {
        $psikologModel->update($userData['kd_psikolog'], $dataToUpdate);
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    return redirect()->back()->with('info', 'Tidak ada perubahan pada profil.');
}

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