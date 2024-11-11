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

        // Upload profile picture
        $fotoPath = null;
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $fotoPath = 'uploads/' . $fotoName;
            $foto->move('public/uploads', $fotoName);
        }

        if (strcasecmp($kategori, 'Klien') === 0) {
            $model = new klienModel();
            $model->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoPath
            ]);
        } else if (strcasecmp($kategori, 'mhs') === 0) {
            $nim = $this->request->getPost('nim');
            $asalUniv = $this->request->getPost('asal_univ');
            $ktm = $this->request->getFile('fotoKTM');

            $model = new mahasiswaModel();

            $ktmPath = $this->uploadFile('fotoKTM');

            $model->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'nim' => $nim,
                'asal_univ' => $asalUniv,
                'fotoKTM' => $ktmPath,
                'foto' => $fotoPath
            ]);
        } else if (strcasecmp($kategori, 'psikolog') === 0) {
            $domisili = $this->request->getPost('domisili');
            $ktp = $this->request->getFile('ktp');
            $lisensi = $this->request->getFile('license');

            $model = new psikologModel();

            $ktpPath = $this->uploadFile('ktp');
            $lisensiPath = $this->uploadFile('license');

            $model->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'domisili' => $domisili,
                'ktp' => $ktpPath,
                'lisensi' => $lisensiPath,
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
        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'username' => $username,
                'role' => 'admin'
            ]);
            return redirect()->to('/beranda');
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
