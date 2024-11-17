<?php

namespace App\Controllers;

use App\Models\klienModel;
use App\Models\mahasiswaModel;
use App\Models\psikologModel;
use App\Models\adminModel;

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

        // Check if username is already taken
        $isUsernameTaken = $klienModel->where('username', $username)->first() ||
            $mahasiswaModel->where('username', $username)->first() ||
            $psikologModel->where('username', $username)->first();

        if ($isUsernameTaken) {
            return redirect()->back()->with('error', 'Maaf, username ini sudah terpakai. Silakan gunakan yang lain.');
        }

        // Handle the upload of 'foto'
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fileFoto = $foto->getName();
            $foto->move('uploads/FOTO/', $fileFoto);
            $fotoPath = '/uploads/FOTO/' . $fileFoto; // Path yang akan disimpan di database
        } else {
            return redirect()->back()->with('error', 'Gagal mengunggah foto.');
        }

        // Choose model based on user category
        if (strcasecmp($kategori, 'klien') === 0) {
            $klienModel->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoPath
            ]);
        } elseif (strcasecmp($kategori, 'mhs') === 0) {
            $fotoKTM = $this->request->getFile('fotoKTM');

            if ($fotoKTM && $fotoKTM->isValid() && !$fotoKTM->hasMoved()) {
                $fotoKTMName = $fotoKTM->getName();
                $fotoKTM->move('uploads/KTM/', $fotoKTMName);
                $fotoKTMPath = '/uploads/KTM/' . $fotoKTMName;
            }

            $mahasiswaModel->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoPath,
                'nim' => $this->request->getPost('nim'),
                'asal_univ' => $this->request->getPost('asal_univ'),
                'fotoKTM' => $fotoKTMPath
            ]);
        } elseif (strcasecmp($kategori, 'psikolog') === 0) {
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

            $psikologModel->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'domisili' => $this->request->getPost('domisili'),
                'ktp' => $ktpPath,
                'lisensi' => $licensePath,
                'foto' => $fotoPath
            ]);
        }

        return redirect()->to('login');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $klienModel = new klienModel();
        $mahasiswaModel = new mahasiswaModel();
        $psikologModel = new psikologModel();
        $adminModel = new adminModel();

        // Check if user is admin
        $admin = $adminModel->where('username', $username)->first();
        if ($admin) {
            if ($password == trim($admin['password'])) { // Use trim to remove extra spaces
                session()->set([
                    'username' => $username,
                    'role' => 'admin'
                ]);
                return redirect()->to('/beranda');
            } else {
                session()->setFlashdata('error', 'Nama pengguna/kata sandi tidak sesuai.');
                return redirect()->to('/login');
            }
        }

        // Check if user is a client, student, or psychologist
        $user = $klienModel->where('username', $username)->first() ??
            $mahasiswaModel->where('username', $username)->first() ??
            $psikologModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'username' => $username,
                'role' => 'user'
            ]);
            return redirect()->to('/beranda');
        }
        session()->setFlashdata('error', 'Nama pengguna/kata sandi tidak sesuai.');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
