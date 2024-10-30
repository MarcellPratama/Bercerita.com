<?php

namespace App\Controllers;

use App\Models\klienModel;
use App\Models\mahasiswaModel;
use App\Models\psikologModel;

class homeController extends BaseController
{

    public function viewHomepage()
    {
        return view('homepage');
    }

    public function index()
    {
        $loggedInUsername = session()->get('username');

        // Inisialisasi model untuk setiap peran
        $klienModel = new KlienModel();
        $mahasiswaModel = new MahasiswaModel();
        $psikologModel = new PsikologModel();

        // Cek akun yang cocok dengan username yang login
        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        if ($klienData) {
            return view('homeKlien', ['userData' => $klienData]);
        }

        $mahasiswaData = $mahasiswaModel->where('username', $loggedInUsername)->first();
        if ($mahasiswaData) {
            return view('homeMahasiswa', ['userData' => $mahasiswaData]);
        }

        $psikologData = $psikologModel->where('username', $loggedInUsername)->first();
        if ($psikologData) {
            return view('homePsikolog', ['userData' => $psikologData]);
        }

        // Jika tidak ada data yang ditemukan, redirect ke halaman login dengan pesan error
        return redirect()->to('/login')->with('error', 'Akun tidak ditemukan.');
    }

    public function getProfilePicture($username)
    {
        $model = new klienModel();
        $user = $model->where('username', $username)->first(); // Fetch user by username

        if ($user && $user['foto']) {
            // Set the appropriate header
            $this->response->setHeader('Content-Type', 'image/jpg'); // Change to the correct image type if necessary
            echo $user['foto'];
        } else {
            // Handle the case where the user or picture is not found
            return redirect()->to('/path/to/default/image.jpg'); // Fallback image
        }
    }
}
