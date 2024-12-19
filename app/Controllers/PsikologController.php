<?php

namespace App\Controllers;

use App\Models\jadwalModel;
use App\Models\klienModel;
use App\Models\mahasiswaModel;
use App\Models\pemesananModel;
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
        $kalendar = $this->kalenderTatapMuka();
        $sessionchat = $this->sessionChat();

        return view('dashboardpsikolog', ['psikolog' => $psikolog, 
        'jadwal' => $jadwal, 'hariJadwal' => $kalendar['hariJadwal'], 
        'chatSchedules' => $kalendar['chatSchedules'], 'offlineSchedules' => $kalendar['offlineSchedules'], 'sessionChat' => $sessionchat]);
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
    $tarif = $this->request->getPost('tarif-text');
    $layanan = $this->request->getPost('layanan');

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
    if (isset($tarif) && $tarif !== '') {
        $tarifClean = preg_replace('/[^\d.,]/', '', str_replace(',', '.', $tarif)); 
        if (!is_numeric($tarifClean) || floatval($tarifClean) <= 0) {
            return redirect()->back()->with('error', 'Tarif harus berupa angka positif.');
        }
        $dataToUpdate['tarif'] = floatval($tarifClean);
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
    $userId = $session->get('kd_psikolog'); // Ambil ID psikolog dari session

    // Ambil data jadwal dari form
    $jadwalInput = $this->request->getPost('jadwal');

    if (empty($jadwalInput)) {
        $session->setFlashdata('popup', 'error');
        $session->setFlashdata('popupMessage', 'Data jadwal tidak ditemukan.');
        return redirect()->back();
    }

    $jadwalModel = new JadwalModel(); // Model untuk jadwal

    // Iterasi setiap hari dan simpan data jika valid
    foreach ($jadwalInput as $hari => $data) {
        // Pastikan jam buka, jam tutup, dan status tidak kosong
        if (!empty($data['jam_buka']) && !empty($data['jam_tutup']) && !empty($data['status'])) {

            // Cek apakah jadwal untuk hari tersebut sudah ada
            $jadwalExist = $jadwalModel
                ->where('kd_psikolog', $userId)
                ->where('hari', $hari)
                ->first();

            if ($jadwalExist) {
                continue; // Lewati jika jadwal hari ini sudah ada
            }

            // Simpan data jadwal
            $jadwalData = [
                'kd_psikolog' => $userId,
                'hari'        => $hari,
                'jam_buka'    => $data['jam_buka'],
                'jam_tutup'   => $data['jam_tutup'],
                'status'      => $data['status']
            ];
            $jadwalModel->insert($jadwalData);
        }
    }

    // Set session flag agar form hilang di view
    $session->set('jadwalTersimpan', true);

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
public function kalenderTatapMuka()
{
    $jadwalModel = new jadwalModel();
    $konsultasiModel = new pemesananModel();
    $klienModel = new klienModel();
    $mahasiswaModel = new mahasiswaModel();

    $kd_psikolog = session()->get('kd_psikolog'); // ID psikolog yang login

    // Ambil hari dan jam kerja psikolog
    $jadwalPraktek = $jadwalModel->where('kd_psikolog', $kd_psikolog)->where('status', 'Buka')->findAll();

    // Ambil konsultasi chat
    $konsultasiChat = $konsultasiModel
        ->where('kd_psikolog', $kd_psikolog)
        ->where('jenis_konsultasi', 'chat')
        ->findAll();

    // Ambil konsultasi tatap muka
    $konsultasiTM = $konsultasiModel
        ->where('kd_psikolog', $kd_psikolog)
        ->where('jenis_konsultasi', 'tatap muka')
        ->findAll();

    // Format hari jadwal
    $hariJadwal = [];
    foreach ($jadwalPraktek as $jadwal) {
        $hariJadwal[] = $jadwal['hari'];
    }

    // Format konsultasi chat
    $chatSchedules = [];
    foreach ($konsultasiChat as $chat) {
        // Ambil nama dari tabel mahasiswa atau klien
        $nama = null;
        if (!empty($chat['kd_mahasiswa'])) {
            $user = $mahasiswaModel->find($chat['kd_mahasiswa']);
            $nama = $user['username'] ?? 'Mahasiswa Tidak Diketahui';
        } elseif (!empty($chat['kd_klien'])) {
            $user = $klienModel->find($chat['kd_klien']);
            $nama = $user['username'] ?? 'Klien Tidak Diketahui';
        }

        $chatSchedules[] = [
            'tanggal' => $chat['tanggal_konsultasi'],
            'nama'    => $nama,
            'waktu'   => $chat['waktu_konsultasi'],
            'tempat'  => null
        ];
    }

    // Format konsultasi tatap muka
    $offlineSchedules = [];
    foreach ($konsultasiTM as $offline) {
        $nama = null;
        if (!empty($offline['kd_mahasiswa'])) {
            $user = $mahasiswaModel->find($offline['kd_mahasiswa']);
            $nama = $user['username'] ?? 'Mahasiswa Tidak Diketahui';
        } elseif (!empty($offline['kd_klien'])) {
            $user = $klienModel->find($offline['kd_klien']);
            $nama = $user['username'] ?? 'Klien Tidak Diketahui';
        }

        $offlineSchedules[] = [
            'id'      => $offline['kd_pesan'],
            'tanggal' => $offline['tanggal_konsultasi'],
            'nama'    => $nama,
            'waktu'   => $offline['waktu_konsultasi'],
            'tempat'  => $offline['tempat']
        ];
    }

    // Kirim data ke view
    $data = [
        'hariJadwal'       => json_encode($hariJadwal),
        'chatSchedules'    => json_encode($chatSchedules),
        'offlineSchedules' => json_encode($offlineSchedules)
    ];

    return $data;
}
public function updateStatusSelesai()
{
    $konsultasiModel = new pemesananModel();
    
    // Ambil ID dari POST biasa
    $id_pesan = $this->request->getPost('kd_pesan'); 

    // Update status menjadi 'selesai'
    if ($konsultasiModel->update($id_pesan, ['status_pesanan' => 'selesai'])) {
        return redirect()->back()->with('success', 'Status berhasil diubah menjadi selesai!');
    } else {
        return redirect()->back()->with('error', 'Gagal mengubah status');
    }
}
public function sessionChat()
{
    $pemesananModel = new pemesananModel();
    $klienModel = new klienModel();
    $mahasiswaModel = new mahasiswaModel();

    $today = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));


    // Ambil sesi hari ini
    $todaySessions = $pemesananModel
        ->select('waktu_konsultasi AS time, jenis_konsultasi, kd_mahasiswa, kd_klien')
        ->where('tanggal_konsultasi', $today)
        ->where('jenis_konsultasi', 'chat')
        ->findAll();

    // Ambil sesi besok
    $tomorrowSessions = $pemesananModel
        ->select('waktu_konsultasi AS time, jenis_konsultasi, kd_mahasiswa, kd_klien')
        ->where('tanggal_konsultasi', $tomorrow)
        ->where('jenis_konsultasi', 'chat')
        ->findAll();

    // Tambahkan nama pengguna (klien atau mahasiswa)
    foreach ($todaySessions as &$session) {
        $session['time'] = date('H:i', strtotime($session['time']));
        $session['name'] = $this->getUserName($session['kd_mahasiswa'], $session['kd_klien'], $klienModel, $mahasiswaModel);
    }

    foreach ($tomorrowSessions as &$session) {
        $session['time'] = date('H:i', strtotime($session['time']));
        $session['name'] = $this->getUserName($session['kd_mahasiswa'], $session['kd_klien'], $klienModel, $mahasiswaModel);
    }
    $data = (['todaySessions' => $todaySessions,
        'tomorrowSessions' => $tomorrowSessions]);

    // Kirim data ke view
    return $data;
}

// Fungsi untuk mendapatkan nama pengguna
private function getUserName($kd_mahasiswa, $kd_klien, $klienModel, $mahasiswaModel)
{
    if (!empty($kd_mahasiswa)) {
        $mahasiswa = $mahasiswaModel->find($kd_mahasiswa);
        return $mahasiswa['username'] ?? 'Mahasiswa Tidak Diketahui';
    }

    if (!empty($kd_klien)) {
        $klien = $klienModel->find($kd_klien);
        return $klien['username'] ?? 'Klien Tidak Diketahui';
    }

    return 'Tidak Diketahui';
}

}