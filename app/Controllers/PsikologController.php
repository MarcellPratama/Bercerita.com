<?php

namespace App\Controllers;

use App\Models\jadwalModel;
use App\Models\psikologModel;

class PsikologController extends BaseController
{
    public function dashboard()
    {
        
        $psikologModel = new psikologModel();
        $userId = session()->get('kd_psikolog');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }


        $psikolog = $psikologModel->find($userId);

        if (!$psikolog) {
            return redirect()->to('/login')->with('error', 'Data tidak ditemukan.');
        }

        // Set nilai default jika field kosong
        $psikolog['tentang_saya'] = $psikolog['tentang_saya'] ?? '-';
        $psikolog['pendekatan_klinis'] = $psikolog['pendekatan_klinis'] ?? '-';
        $psikolog['tarif'] = $psikolog['tarif'] ?? '-';

        
        $jadwal = $this->kelolaJadwal();

        return view('dashboardpsikolog', ['psikolog' => $psikolog, 'jadwal' => $jadwal]);
    }
    public function updateProfilePhoto()
{
    $psikologModel = new psikologModel();

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
    $tarif = $this->request->getPost('tarif');

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

    $psikologModel = new psikologModel();
    $psikologModel->update($userId, $data);

    // Set flashdata sukses
    return redirect()->back()->with('success', 'Layanan berhasil disimpan.');

}
public function simpanJadwal()
{
    $session = session();
    $userId = $session->get('kd_psikolog');

    // Ambil data input
    $hari = $this->request->getPost('hari');
    $jamBuka = $this->request->getPost('jam_buka');
    $jamTutup = $this->request->getPost('jam_tutup');

    // Validasi input
    if (empty($hari) || empty($jamBuka) || empty($jamTutup)) {
        $session->setFlashdata('popup', 'error');
        $session->setFlashdata('popupMessage', 'Semua kolom harus diisi.');
        return redirect()->back();
    }

    $jadwalModel = new jadwalModel();
    $jadwalExist = $jadwalModel->where('kd_psikolog', $userId)->where('hari', $hari)->first();

    if ($jadwalExist) {
        $session->setFlashdata('popup', 'error');
        $session->setFlashdata('popupMessage', 'Jadwal untuk hari ini sudah terisi.');
        return redirect()->back();
    }

    // Simpan data jika valid
    $data = [
        'kd_psikolog' => $userId,
        'hari'        => $hari,
        'jam_buka'    => $jamBuka,
        'jam_tutup'   => $jamTutup,
        'status'      => 'Open'
    ];
    $jadwalModel->insert($data);

    // Menambahkan flag session untuk status tampilan
    $session->set('jadwalTersimpan', true); // Set session

    $session->setFlashdata('popup', 'success');
    $session->setFlashdata('popupMessage', 'Jadwal berhasil disimpan.');
    return redirect()->back();
}





public function kelolaJadwal()
{
    // Fetch the JadwalModel
    $jadwalModel = model(jadwalModel::class);

    // Retrieve psychologist ID (kd_psikolog) from session
    $kd_psikolog = session()->get('kd_psikolog'); // Assuming 'kd_psikolog' is stored in session
    // Fetch the schedule data for the specific psychologist (using kd_psikolog)
    $jadwal = $jadwalModel->getJadwalByPsikolog($kd_psikolog); // Pass only the psychologist's ID to get the schedule
    // Return the view with the data
    return $jadwal;
}
}