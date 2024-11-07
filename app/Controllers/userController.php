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
<<<<<<< HEAD
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
=======
            return redirect()->back()->with('error', 'Maaf, username ini sudah terpakai. Silakan gunakan yang lain.');
>>>>>>> ae3808d23618273f6ad8e19b4479bdfc68d4e5a1
        }

        // Upload profile picture
        $fotoPath = null;
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $fotoPath = 'uploads/' . $fotoName;
            $foto->move('public/uploads', $fotoName);
        }

        // Choose model based on user category
        $model = null;
        if (strcasecmp($kategori, 'klien') === 0) {
            $model = $klienModel;
        } elseif (strcasecmp($kategori, 'mhs') === 0) {
            $model = $mahasiswaModel;
            $model->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoPath,
                'nim' => $this->request->getPost('nim'),
                'asal_univ' => $this->request->getPost('asal_univ'),
                'fotoKTM' => $this->uploadFile('fotoKTM')
            ]);
            return redirect()->to('login');
        } elseif (strcasecmp($kategori, 'psikolog') === 0) {
            $model = $psikologModel;
            $model->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'domisili' => $this->request->getPost('domisili'),
                'ktp' => $this->uploadFile('ktp'),
                'lisensi' => $this->uploadFile('license'),
                'foto' => $fotoPath
            ]);
            return redirect()->to('login');
        }

        // Save user data for 'klien' category
        if ($model) {
            $model->save([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoPath
            ]);
            return redirect()->to('login');
        }
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
        // dd($admin);
        if ($admin) {
            // dd("masuk");
            // Debugging to check if password matches
            // if (password_verify($password, $admin['password'])) {
            if ($password == $admin['password']) {
                session()->set([
                    'username' => $username,
                    'role' => 'admin'
                ]);
                return redirect()->to('/beranda');
            } else {
                // dd("ini masuk else");
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
