<?php

namespace App\Controllers;

use App\Models\klienModel;
use App\Models\forumRelasiModel;
use App\Models\chatForumModel;
use CodeIgniter\HTTP\Response;

class ChatController extends BaseController
{
    public function index()
    {
        $loggedInUsername = session()->get('username');

        $klienModel = new KlienModel();
        $forumRelasiModel = new forumRelasiModel();

        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        if ($klienData) {
            $forums = $forumRelasiModel
                ->select('forum.*')
                ->join('forum', 'forum.kode_forum = forum_klien.kode_forum')
                ->where('forum_klien.kd_klien', $klienData['kd_klien'])
                ->findAll();

            return view('roomForum', [
                'userData' => $klienData,
                'forums' => $forums,
            ]);
        }
    }

    public function train()
    {
        return view('chat');
    }

    public function saveMessage()
    {
        $chatModel = new chatForumModel();
        $data = $this->request->getJSON();

        $chatModel->insert([
            'kode_forum' => $data->kode_forum,
            'pengirim'   => $data->pengirim,
            'pesan'      => $data->pesan,
            'waktu'      => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }
}
