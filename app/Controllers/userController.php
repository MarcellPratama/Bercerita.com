<?php

namespace App\Controllers;

use App\Models\klienModel;
use App\Models\mahasiswaModel;
use App\Models\psikologModel;
use App\Models\adminModel;
use App\Models\registrasiModel;
use App\Models\verifikasiModel;

class userController extends BaseController
{
    public function viewRegistrasi()
    {
        return view('registrasi');
    }

    public function viewLogin()
    {
        return view('login');
    }

    public function registrasi()
    {
        helper('form');

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $email = $this->request->getPost('email');
        $foto = $this->request->getFile('file-upload');
        $kategori = $this->request->getPost('category');

        $klienModel = new klienModel();
        $mahasiswaModel = new mahasiswaModel();
        $psikologModel = new psikologModel();
        $registrasiModel = new registrasiModel();

        // Check if username is already taken
        $isUsernameTaken = $klienModel->where('username', $username)->first() ||
            $mahasiswaModel->where('username', $username)->first() ||
            $psikologModel->where('username', $username)->first();

        if ($isUsernameTaken) {
            return redirect()->back()->with('error', 'Username ini sudah terpakai.');
        }

        // Handle the upload of 'foto'
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fileFoto = $foto->getName();
            $foto->move('uploads/FOTO/', $fileFoto);
            $fotoPath = '/uploads/FOTO/' . $fileFoto; // Path yang akan disimpan di database
        } else {
            return redirect()->back()->with('error', 'Gagal mengunggah foto.');
        }

        $kd_user = null; // Variable to hold user ID for registration
        $tanggal_registrasi = date('Y-m-d'); // Current date

        // Choose model based on user category
        if (strcasecmp($kategori, 'klien') === 0) {
            // Insert klien data
            $kd_klien = $klienModel->insert([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoPath
            ], true);

            if (!$kd_klien) {
                return redirect()->back()->with('error', 'Gagal menyimpan data klien.');
            }

            // Insert to registrasi table with correct ID and set others to null
            $registrasiModel->insert([
                'tanggal_registrasi' => $tanggal_registrasi,
                'kd_klien' => $kd_klien, // Save ID of klien in registrasi
                'kd_psikolog' => null, // Set null for psikolog
                'kd_mahasiswa' => null  // Set null for mahasiswa
            ]);
        } elseif (strcasecmp($kategori, 'mhs') === 0) {
            // Handle mahasiswa
            $fotoKTM = $this->request->getFile('fotoKTM');
            if ($fotoKTM && $fotoKTM->isValid() && !$fotoKTM->hasMoved()) {
                $fotoKTMName = $fotoKTM->getName();
                $fotoKTM->move('uploads/KTM/', $fotoKTMName);
                $fotoKTMPath = '/uploads/KTM/' . $fotoKTMName;
            }

            // Insert mahasiswa data
            $kd_mahasiswa = $mahasiswaModel->insert([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoPath,
                'nim' => $this->request->getPost('nim'),
                'asal_univ' => $this->request->getPost('asal_univ'),
                'fotoKTM' => $fotoKTMPath
            ], true);

            if (!$kd_mahasiswa) {
                return redirect()->back()->with('error', 'Gagal menyimpan data mahasiswa.');
            }

            // Insert to registrasi table with correct ID and set others to null
            $registrasiModel->insert([
                'tanggal_registrasi' => $tanggal_registrasi,
                'kd_mahasiswa' => $kd_mahasiswa, // Save ID of mahasiswa in registrasi
                'kd_psikolog' => null, // Set null for psikolog
                'kd_klien' => null  // Set null for klien
            ]);
        } elseif (strcasecmp($kategori, 'psikolog') === 0) {
            // Handle psikolog
            $ktp = $this->request->getFile('ktp');
            $license = $this->request->getFile('license');

            if ($ktp && $ktp->isValid() && !$ktp->hasMoved()) {
                $ktpName = $ktp->getName();
                $ktp->move('uploads/KTP/', $ktpName);
                $ktpPath = '/uploads/KTP/' . $ktpName;
            }

            if ($license && $license->isValid() && !$license->hasMoved()) {
                $licenseName = $license->getName();
                $license->move('uploads/LisensiPsikolog/', $licenseName);
                $licensePath = '/uploads/LisensiPsikolog/' . $licenseName;
            }

            // Insert psikolog data
            $kd_psikolog = $psikologModel->insert([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'domisili' => $this->request->getPost('domisili'),
                'ktp' => '/uploads/KTP/' . $ktpName,
                'lisensi' => '/uploads/LisensiPsikolog/' . $licenseName,
                'foto' => $fotoPath
            ], true);

            if (!$kd_psikolog) {
                return redirect()->back()->with('error', 'Gagal menyimpan data psikolog.');
            }

            // Insert to registrasi table with correct ID and set others to null
            $registrasiModel->insert([
                'tanggal_registrasi' => $tanggal_registrasi,
                'kd_psikolog' => $kd_psikolog, // Save ID of psikolog in registrasi
                'kd_klien' => null, // Set null for klien
                'kd_mahasiswa' => null  // Set null for mahasiswa
            ]);
        }

        return redirect()->to('login');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $klienModel = new KlienModel();
        $verifikasiModel = new VerifikasiModel();
        $registrasiModel = new RegistrasiModel();
        $mahasiswaModel = new MahasiswaModel();
        $psikologModel = new PsikologModel();
        $adminModel = new adminModel();

        // Check if user is admin
        $admin = $adminModel->where('username', $username)->first();
        if ($admin) {
            if ($password == trim($admin['password'])) { // Use trim to remove extra spaces
                session()->set([
                    'admin_id' => $admin['kd_admin'], // Save admin ID to session
                    'username' => $username,
                    'role' => 'admin'
                ]);
                return redirect()->to('/beranda');
            } else {
                session()->setFlashdata('error', 'Nama pengguna/kata sandi tidak sesuai.');
                return redirect()->to('/login');
            }
        }
        // Check if user is a psychologist
        $psikolog = $psikologModel->where('username', $username)->first();
        if ($psikolog) {
            if (password_verify($password, $psikolog['password'])) {
                session()->set([
                    'username' => $username,
                    'role' => 'psikolog',
                    'kd_psikolog' => $psikolog['kd_psikolog'] // Pastikan ini disimpan di sesi
                ]);
                return redirect()->to('/beranda');
            } else {
                session()->setFlashdata('error', 'Nama pengguna/kata sandi tidak sesuai.');
                return redirect()->to('/login');
            }
        }


    
    // Login untuk Klien
    $client = $klienModel->where('username', $username)->first();
    if ($client) {
        if (password_verify($password, $client['password'])) {
            session()->set([
                'user_id' => $client['kd_klien'],
                'username' => $client['username'],
                'role' => 'client'
            ]);

            return redirect()->to('/beranda');
        } else {
            session()->setFlashdata('error', 'Nama pengguna/kata sandi tidak sesuai.');
            return redirect()->to('/login');
        }
    }

    // Login untuk Psikolog
    $psikolog = $psikologModel->where('username', $username)->first();
    if ($psikolog) {
        $kd_registrasi = $registrasiModel->where('kd_psikolog', $psikolog['kd_psikolog'])->first();

        if (!$kd_registrasi) {
            session()->setFlashdata('error', 'Data registrasi tidak ditemukan.');
            return redirect()->to('/login');
        }

        $verifikasi = $verifikasiModel->where('kd_registrasi', $kd_registrasi['kd_registrasi'])->first();

        if (!$verifikasi) {
            session()->setFlashdata('error', 'Akun Anda belum diverifikasi.');
            return redirect()->to('/login');
        }

        // Proses validasi verifikasi
        switch ($verifikasi['status']) {
            case 'Ditolak':
                session()->setFlashdata('error', 'Maaf, akun Anda ditolak.');
                return redirect()->to('/login');
            case 'Diterima':
                if (password_verify($password, $psikolog['password'])) {
                    session()->set([
                        'user_id' => $psikolog['kd_psikolog'],
                        'username' => $psikolog['username'],
                        'role' => 'psychologist'
                    ]);
                    return redirect()->to('/beranda');
                } else {
                    session()->setFlashdata('error', 'Nama pengguna/kata sandi tidak sesuai.');
                    return redirect()->to('/login');
                }
        }
    }
// Login untuk Mahasiswa Psikologi
$mahasiswa = $mahasiswaModel->where('username', $username)->first();
if ($mahasiswa) {
    $kd_registrasi = $registrasiModel->where('kd_mahasiswa', $mahasiswa['kd_mahasiswa'])->first();

    if (!$kd_registrasi) {
        session()->setFlashdata('error', 'Data registrasi tidak ditemukan.');
        return redirect()->to('/login');
    }

    $verifikasi = $verifikasiModel->where('kd_registrasi', $kd_registrasi['kd_registrasi'])->first();

    if (!$verifikasi) {
        session()->setFlashdata('error', 'Akun Anda belum diverifikasi.');
        return redirect()->to('/login');
    }

    // Proses validasi verifikasi
    switch ($verifikasi['status']) {
        case 'Ditolak':
            session()->setFlashdata('error', 'Maaf, akun Anda ditolak.');
            return redirect()->to('/login');
        case 'Diterima':
            if (password_verify($password, $mahasiswa['password'])) {
                session()->set([
                    'user_id' => $mahasiswa['kd_mahasiswa'],
                    'username' => $mahasiswa['username'],
                    'role' => 'student'
                ]);
                return redirect()->to('/beranda');
            } else {
                session()->setFlashdata('error', 'Nama pengguna/kata sandi tidak sesuai.');
                return redirect()->to('/login');
            }
    }
}

// Jika tidak ditemukan
session()->setFlashdata('error', 'Nama pengguna/kata sandi tidak sesuai.');
return redirect()->to('/login');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function update()
    {
        $klienModel = new klienModel();
        $klienModel = new klienModel();
        $mahasiswaModel = new mahasiswaModel();
        $psikologModel = new psikologModel();

        // Ambil input dari form
        $username = $this->request->getPost('username');
        $newPassword = $this->request->getPost('new-password');
        $confirmPassword = $this->request->getPost('confirm-password');
        $email = $this->request->getPost('email');
        $profilePicture = $this->request->getFile('profile_picture');

        // Ambil data user berdasarkan username yang ada di session
        $loggedInUsername = session()->get('username');
        $userData = $klienModel->where('username', $loggedInUsername)->first();

        // Siapkan data untuk diupdate
        $dataToUpdate = [];

        // Cek apakah ada perubahan pada masing-masing field
        if (!empty($username) && $username != $userData['username']) {
            // Check if username is already taken
            $isUsernameTaken = $klienModel->where('username', $username)->first() ||
                $mahasiswaModel->where('username', $username)->first() ||
                $psikologModel->where('username', $username)->first();

            if ($isUsernameTaken) {
                return redirect()->back()->with('error', 'Username ini sudah terpakai.');
            }

            $dataToUpdate['username'] = $username;
        }

         // Cek apakah ada perubahan password
    if (!empty($newPassword)) {
        if ($newPassword == $confirmPassword) {
            // Hash password sebelum disimpan
            $dataToUpdate['password'] = password_hash($newPassword, PASSWORD_BCRYPT);  // Update password (hashed)
        } else {
            return redirect()->back();
        }
    }

        if (!empty($email) && $email != $userData['email']) {
            $dataToUpdate['email'] = $email;
        }

        if ($profilePicture && $profilePicture->isValid()) {
            // Proses upload foto profil
            $newProfilePicture = $profilePicture->getName();
            $profilePicture->move('uploads/FOTO/', $newProfilePicture);
            $dataToUpdate['foto'] = '/uploads/FOTO/' . $newProfilePicture;
        }

        if (!empty($dataToUpdate)) {
            $klienModel->update($userData['kd_klien'], $dataToUpdate); // Update berdasarkan kd_klien
        }

        // Clear session data to log the user out after username or password change
        if (!empty($dataToUpdate['username']) || !empty($dataToUpdate['password'])) {
            session()->destroy();  // Destroy the session to force the user to log in again
            return redirect()->to('/login');
        }

        return redirect()->back();
    }
}
