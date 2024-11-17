<?php

namespace App\Controllers;

class adminController extends BaseController
{
    // Method untuk menampilkan halaman verifikasi
    public function verifikasi()
    {
        return view('viewVerifikasi');
    }

    // Method untuk halaman Dashboard
    public function dashboard()
    {
        return view('viewDashboard'); // pastikan view Dashboard ada di app/Views
    }

    public function lihatPsikolog()
    {
        return view('viewPsikolog'); // pastikan view Dashboard ada di app/Views
    }

    public function lihatMhs()
    {
        return view('viewMhsPsikologi'); // pastikan view Dashboard ada di app/Views
    }
}
