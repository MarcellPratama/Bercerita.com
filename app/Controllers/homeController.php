<?php

namespace App\Controllers;

use App\Models\klienModel;
use App\Models\mahasiswaModel;
use App\Models\psikologModel;
use App\Models\adminModel;

class homeController extends BaseController
{

    public function viewHomepage()
    {
        return view('homepage');
    }
    public function index()
    {
        $loggedInUsername = session()->get('username');

        $klienModel = new KlienModel();
        $mahasiswaModel = new MahasiswaModel();
        $psikologModel = new PsikologModel();
        $adminModel = new AdminModel();

        // Check user role and render the appropriate view
        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        if ($klienData) {
            return view('homeKlien', ['userData' => $klienData]);
        }

        $mahasiswaData = $mahasiswaModel->where('username', $loggedInUsername)->first();
        if ($mahasiswaData) {
            return view('homeKlien', ['userData' => $mahasiswaData]);
        }

        $psikologData = $psikologModel->where('username', $loggedInUsername)->first();
        if ($psikologData) {
            return view('homePsikolog', ['userData' => $psikologData]);
        }

        $adminData = $adminModel->where('username', $loggedInUsername)->first();
        if ($adminData) {
            // Render the view for admin without needing a separate route
            return view('viewDashboard', ['userData' => $adminData]);
        }

        // Redirect to login if no user data is found
        return redirect()->to('/login')->with('error', 'Akun tidak ditemukan.');
    }
}
