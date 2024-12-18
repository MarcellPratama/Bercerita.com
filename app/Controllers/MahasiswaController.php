<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    // Halaman Edit Profil
    public function editProfile()
    {
        $loggedInUsername = session()->get('username');
        log_message('debug', 'Logged-in username: ' . $loggedInUsername);

        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaData = $mahasiswaModel->where('username', $loggedInUsername)->first();

        if ($mahasiswaData) {
            return view('editProfileMHS', ['data' => $mahasiswaData]);
        }

        log_message('error', 'No mahasiswa data found for username: ' . $loggedInUsername);
        return redirect()->to('/login')->with('error', 'Akun tidak ditemukan.');
    }

    // Mengupdate data profil mahasiswa
    public function updateProfile()
    {
        $kodeMahasiswa = $this->request->getPost('kode_mahasiswa');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $email = $this->request->getPost('email');
        $asalUniversitas = $this->request->getPost('asal_universitas');
        $nim = $this->request->getPost('nim');
    
        $mahasiswaModel = new MahasiswaModel();
    
        // Cek apakah username sudah digunakan oleh mahasiswa lain
        $existingUser = $mahasiswaModel->where('username', $username)->first();
        if ($existingUser && $existingUser['kd_mahasiswa'] != $kodeMahasiswa) {
            return redirect()->back()->with('error', 'Username sudah digunakan oleh mahasiswa lain.');
        }
    
        // Inisialisasi data yang akan diupdate
        $data = [];
    
        if (!empty($username)) {
            $data['username'] = $username;
        }
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }
        if (!empty($email)) {
            $data['email'] = $email;
        }
        if (!empty($asalUniversitas)) {
            $data['asal_univ'] = $asalUniversitas;
        }
        if (!empty($nim)) {
            $data['nim'] = $nim;
        }
    
        // Update hanya jika ada data
        if (!empty($data)) {
            $mahasiswaModel->update($kodeMahasiswa, $data);
            return redirect()->to('/mahasiswa/profile')->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada data yang diperbarui.');
        }
    }
    // Mengupdate foto profil mahasiswa
    public function uploadProfilePicture()
    {
        $kdMahasiswa = session()->get('kd_mahasiswa');

        // Cek apakah file sudah diupload
        $file = $this->request->getFile('profile_pic');

        if (!$file->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid.']);
        }

        // Tentukan folder untuk menyimpan file
        $uploadPath = WRITEPATH . 'uploads/FOTO/';

        // Cek apakah folder upload ada, jika tidak buat folder
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Tentukan nama file yang baru
        $newName = $file->getRandomName();

        // Pindahkan file ke folder tujuan
        if ($file->move($uploadPath, $newName)) {
            // Update foto profil mahasiswa di database
            $mahasiswaModel = new MahasiswaModel();
            $mahasiswaModel->update($kdMahasiswa, [
                'foto' => '/uploads/FOTO/' . $newName
            ]);

            return $this->response->setJSON(['success' => true, 'message' => 'Foto berhasil diupdate.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengupload foto.']);
        }
    }
}