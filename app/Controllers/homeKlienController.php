<?php

namespace App\Controllers;
use App\Models\klienModel;
use App\Models\forumModel;
use App\Models\forum_klienModel;
use App\Models\mahasiswaModel;

class homeKlienController extends BaseController
{
    public function forum(): string
    {
        $loggedInUsername = session()->get('username');
    
        $klienModel = new KlienModel();
        $forumModel = new forumModel();
        //$this->forumKlienModel = new forum_klienModel();
        $mahasiswaModel = new mahasiswaModel();


        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        $forums = $forumModel->getAllForums();
        $mahasiswa = $mahasiswaModel->find(session()->get('kd_mahasiswa'));

        return view('forumKlien', [
            'userData' => $klienData,
            'forums' => $forums,
            'mahasiswa' => $mahasiswa
        ]);
    }

}
