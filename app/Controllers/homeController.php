<?php

namespace App\Controllers;

use App\Models\klienModel;
use App\Models\mahasiswaModel;
use App\Models\psikologModel;
use App\Models\adminModel;
use App\Models\forumModel;
use App\Models\catatanModel;
use App\Models\forumRelasiModel;

class homeController extends BaseController
{

    public function viewHomepage()
    {
        $psikologModel = new PsikologModel();
        $forumModel = new forumModel();
        $catatanModel = new catatanModel();

        $forums = $forumModel->orderBy('RAND()')->limit(4)->findAll();
        $catatan = $catatanModel->orderBy('RAND()')->limit(8)->findAll();
        $psikolog = $psikologModel->orderBy('RAND()')->limit(3)->findAll();

        return view('homepage', [
            'forums' => $forums,
            'catatan' => $catatan,
            'listPsikolog' => $psikolog
        ]);
    }
    public function index()
    {
        $loggedInUsername = session()->get('username');

        $klienModel = new KlienModel();
        $mahasiswaModel = new MahasiswaModel();
        $psikologModel = new PsikologModel();
        $adminModel = new AdminModel();
        $forumModel = new forumModel();
        $catatanModel = new catatanModel();

        // Ambil 4 forum secara acak
        $forums = $forumModel->orderBy('RAND()')->limit(4)->findAll();
        $psikolog = $psikologModel->orderBy('RAND()')->limit(3)->findAll();
        $catatan = $catatanModel->orderBy('RAND()')->limit(8)->findAll();

        // Check user role and render the appropriate view
        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        if ($klienData) {
            return view('homeKlien', [
                'userData' => $klienData,
                'forums' => $forums,
                'catatan' => $catatan,
                'listPsikolog' => $psikolog
            ]);
        }

        $mahasiswaData = $mahasiswaModel->where('username', $loggedInUsername)->first();
        if ($mahasiswaData) {
            return view('homeKlien', [
                'userData' => $mahasiswaData,
                'forums' => $forums,
                'catatan' => $catatan,
                'listPsikolog' => $psikolog
            ]);
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

    public function EditProfile()
    {
        $loggedInUsername = session()->get('username');

        $klienModel = new KlienModel();
        $mahasiswaModel = new MahasiswaModel();

        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        if ($klienData) {
            return view('editProfileKlien', ['userData' => $klienData]);
        }

        $mahasiswaData = $mahasiswaModel->where('username', $loggedInUsername)->first();
        if ($mahasiswaData) {
            return view('editprofileMHS', ['data' => $mahasiswaData]);
        }
    }

    public function roomChat()
    {
        $loggedInUsername = session()->get('username');

        $klienModel = new KlienModel();
        $mahasiswaModel = new MahasiswaModel();
        $forumRelasiModel = new forumRelasiModel();
        $forumModel = new forumModel();

        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        if ($klienData) {
            $forums = $forumRelasiModel
                    ->select('forum.*')
                    ->join('forum', 'forum.kode_forum = forum_klien.kode_forum')
                    ->where('forum_klien.kd_klien', $klienData['kd_klien'])
                    ->findAll();

            return view('roomForum', [
                'userData' => $klienData,
                'forums' => $forums
            ]);
        }

        $mahasiswaData = $mahasiswaModel->where('username', $loggedInUsername)->first();
        if ($mahasiswaData) {
            return view('roomForum', ['data' => $mahasiswaData]);
        }
    }

    public function forum(): string
    {
        $loggedInUsername = session()->get('username');

        $klienModel = new KlienModel();
        $forumModel = new forumModel();
        //$this->forumKlienModel = new forum_klienModel();
        $mahasiswaModel = new mahasiswaModel();


        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        $mhsData = $mahasiswaModel->where('username', $loggedInUsername)->first();
        $forums = $forumModel->findAll();

        if ($klienData) {
            $forums = $forumModel->findAll();
            return view('forumKlien', [
                'userData' => $klienData,
                'forums' => $forums,
            ]);
        } elseif ($mhsData) {
            $forums = $forumModel->where('forum.kd_mahasiswa', $mhsData['kd_mahasiswa'])->findAll();
            return view('CRUD_Forum', [
                'mhsData' => $mhsData,
                'forums' => $forums
            ]);
        }
    }

    public function konsultasiPage(): string
    {
        $loggedInUsername = session()->get('username');

        $klienModel = new KlienModel();
        $psikologModel = new PsikologModel();
        $mahasiswaModel = new mahasiswaModel();


        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        $mhsData = $mahasiswaModel->where('username', $loggedInUsername)->first();
        $psikolog = $psikologModel->findAll();

        if ($klienData) {
            return view('viewKonsultasi', [
                'userData' => $klienData,
                'listPsikolog' => $psikolog,
            ]);
        } elseif ($mhsData) {
            return view('viewKonsultasi', [
                'mhsData' => $mhsData,
                'listPsikolog' => $psikolog
            ]);
        }
    }

    public function jejakPerasaan(): string
    {
        $loggedInUsername = session()->get('username');

        $klienModel = new KlienModel();
        $catatanModel = new catatanModel();
        $mahasiswaModel = new mahasiswaModel();

        // Hapus catatan yang sudah lebih dari 24 jam
        $catatanModel->deleteExpiredNotes();

        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        $mhsData = $mahasiswaModel->where('username', $loggedInUsername)->first();
        $catatan = $catatanModel->findAll();

        if ($klienData) {
            return view('jejakPerasaan', [
                'userData' => $klienData,
                'catatan' => $catatan
            ]);
        } elseif ($mhsData) {
            return view('jejakPerasaan', [
                'userData' => $mhsData,
                'catatan' => $catatan
            ]);
        }
    }

    public function detailPsikolog($id)
    {
        $psikologModel = new PsikologModel();

        $psikolog = $psikologModel->where('kd_psikolog', $id)->first();

        return view('detailPsikolog', ['psikolog' => $psikolog]);
    }
}
