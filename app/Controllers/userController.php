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

        // Get the file content as binary data for 'foto'
        $fotoData = $this->getFileContent($foto);

        // Choose model based on user category
        if (strcasecmp($kategori, 'klien') === 0) {
            $klienModel->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoData
            ]);
        } elseif (strcasecmp($kategori, 'mhs') === 0) {
            $mahasiswaModel->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoData,
                'nim' => $this->request->getPost('nim'),
                'asal_univ' => $this->request->getPost('asal_univ'),
                'fotoKTM' => $this->getFileContent($this->request->getFile('fotoKTM')) // KTM file as binary
            ]);
        } elseif (strcasecmp($kategori, 'psikolog') === 0) {
            $psikologModel->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'domisili' => $this->request->getPost('domisili'),
                'ktp' => $this->getFileContent($this->request->getFile('ktp')), // KTP file as binary
                'lisensi' => $this->getFileContent($this->request->getFile('license')), // License file as binary
                'foto' => $fotoData
            ]);
        }

        return redirect()->to('login');
    }

    // Function to get file content as binary data
    private function getFileContent($file)
    {
        if ($file && $file->isValid() && !$file->hasMoved()) {
            return file_get_contents($file->getTempName()); // Read file content as binary data
        }
        return null;
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