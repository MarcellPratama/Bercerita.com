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

        // Cek apakah username sudah ada yang menggunakan
        $mahasiswaModel = new MahasiswaModel();
        $existingUser = $mahasiswaModel->where('username', $username)->first();
        if ($existingUser && $existingUser['kd_mahasiswa'] != $kodeMahasiswa) {
            return redirect()->back()->with('error', 'Username sudah digunakan oleh mahasiswa lain.');
        }

        // Update data mahasiswa
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'email' => $email,
            'asal_univ' => $asalUniversitas,
            'nim' => $nim,
        ];

        $mahasiswaModel->update($kodeMahasiswa, $data);

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->to('/mahasiswa/profile')->with('success', 'Profil berhasil diperbarui.');
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
