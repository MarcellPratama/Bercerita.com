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

        // Generate unique ID based on category
        $newId = $this->generateUniqueId($kategori);

        // Choose model based on user category
        if (strcasecmp($kategori, 'klien') === 0) {
            $klienModel->save([
                'kd_klien' => $newId,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'foto' => $fotoData
            ]);
        } elseif (strcasecmp($kategori, 'mhs') === 0) {
            $mahasiswaModel->save([
                'kd_mahasiswa' => $newId,
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
                'kd_psikolog' => $newId,
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

    // Function to generate unique ID based on user category
    private function generateUniqueId($kategori)
    {
        $db = \Config\Database::connect();

        if (strcasecmp($kategori, 'klien') === 0) {
            $builder = $db->table('klien');
            $lastEntry = $builder->select('kd_klien')->orderBy('kd_klien', 'DESC')->get(1)->getRow();
            $lastId = $lastEntry ? intval(str_replace('KL', '', $lastEntry->kd_klien)) : 0;
            return 'KL' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT); // Example: KL0001
        }

        if (strcasecmp($kategori, 'mhs') === 0) {
            $builder = $db->table('mhspsikologi');
            $lastEntry = $builder->select('kd_mahasiswa')->orderBy('kd_mahasiswa', 'DESC')->get(1)->getRow();
            $lastId = $lastEntry ? intval(str_replace('MHS', '', $lastEntry->kd_mahasiswa)) : 0;
            return 'MHS' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT); // Example: MHS0001
        }

        if (strcasecmp($kategori, 'psikolog') === 0) {
            $builder = $db->table('psikolog');
            $lastEntry = $builder->select('kd_psikolog')->orderBy('kd_psikolog', 'DESC')->get(1)->getRow();
            $lastId = $lastEntry ? intval(str_replace('PSK', '', $lastEntry->kd_psikolog)) : 0;
            return 'PSK' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT); // Example: PSK0001
        }

        return null; // Fallback
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
