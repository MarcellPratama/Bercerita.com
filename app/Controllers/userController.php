<?php

namespace App\Controllers;

use App\Models\klienModel;
use App\Models\mahasiswaModel;
use App\Models\psikologModel;

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

        $isUsernameTaken = $klienModel->where('username', $username)->first() ||
            $mahasiswaModel->where('username', $username)->first() ||
            $psikologModel->where('username', $username)->first();

        if ($isUsernameTaken) {
            return redirect()->back()->with('error', 'Maaf username kamu sudah terpakai, tolong ganti yahh');
        }

        if (strcasecmp($kategori, 'Klien') === 0) {
            $model = new klienModel();

            $model->save([
                'username' => $username,
                'password' => md5($password),
                'email' => $email,
                'foto' => $foto
            ]);
        } else if (strcasecmp($kategori, 'mhs') === 0) {
            $nim = $this->request->getPost('nim');
            $asalUniv = $this->request->getPost('asal_univ');
            $ktm = $this->request->getFile('fotoKTM');

            $model = new mahasiswaModel();

            $model->save([
                'username' => $username,
                'password' => md5($password),
                'email' => $email,
                'nim' => $nim,
                'asal_univ' => $asalUniv,
                'fotoKTM' => $ktm,
                'foto' => $foto
            ]);
        } else if (strcasecmp($kategori, 'psikolog') === 0) {
            $domisili = $this->request->getPost('domisili');
            $ktp = $this->request->getFile('ktp');
            $lisensi = $this->request->getFile('license');

            $model = new psikologModel();

            $model->save([
                'username' => $username,
                'password' => md5($password),
                'email' => $email,
                'domisili' => $domisili,
                'fotoKTP' => $ktp,
                'fotolisensi' => $lisensi,
                'foto' => $foto
            ]);
        }

        return redirect()->to('/login');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        //loads the models
        $klienModel = new klienModel();
        $mahasiswaModel = new mahasiswaModel();
        $psikologModel = new psikologModel();

<<<<<<< HEAD
        // Check if user is admin
        $admin = $adminModel->where('username', $username)->first();
        // dd($admin);
        if ($admin) {
            if ($password == trim($admin['password'])) { // Menggunakan trim untuk menghilangkan spasi tambahan
                session()->set([
                    'username' => $username,
                    'role' => 'admin'
                ]);
                return redirect()->to('/beranda');
            } else {
                session()->setFlashdata('error', 'Nama pengguna/kata sandi tidak sesuai.');
                return redirect()->to('/login');
=======
        // Check if username exists in any of the tables
        $user = $klienModel->where('username', $username)->first() ??
            $mahasiswaModel->where('username', $username)->first() ??
            $psikologModel->where('username', $username)->first();

        if ($user) {
            if ($user['password'] === md5($password)) {
                session()->set('username', $username);
                return redirect()->to('/beranda');
            } else {
                return redirect()->back()->with('error', 'Password salah');
>>>>>>> 60e9589871ec77822125e1cc8f6d4da7fbe54496
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }
<<<<<<< HEAD

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
=======
>>>>>>> 60e9589871ec77822125e1cc8f6d4da7fbe54496
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
<<<<<<< HEAD

    private function uploadFile($fileInputName)
    {
        $file = $this->request->getFile($fileInputName);
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $filePath = 'uploads/' . $fileName;
            $file->move('public/uploads', $fileName);
            return $filePath;
        }
        return null;
    }
}
=======
}
>>>>>>> 60e9589871ec77822125e1cc8f6d4da7fbe54496
