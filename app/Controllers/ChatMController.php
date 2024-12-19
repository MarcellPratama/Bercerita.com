<?php

namespace App\Controllers;

use App\Models\ChatModel;

class ChatMController extends BaseController
{
    public function index()
    {
        return view('ChatM');
    }

    public function saveMessage()
    {
        $kdKlien = session()->get('kd_klien');
        $kdMahasiswa = session()->get('kd_mahasiswa');

        log_message('debug', 'Session: kd_klien=' . $kdKlien . ' kd_mahasiswa=' . $kdMahasiswa);

        if (!$kdKlien || !$kdMahasiswa) {
            log_message('error', 'Session data tidak lengkap.');
            return $this->response->setJSON(['status' => 'error', 'message' => 'Session data tidak lengkap']);
        }

        $message = $this->request->getPost('message');

        log_message('debug', 'Pesan yang diterima: ' . $message);

        if (empty($message)) {
            log_message('error', 'Pesan tidak ditemukan.');
            return $this->response->setJSON(['status' => 'error', 'message' => 'Pesan tidak ditemukan']);
        }

        $chatModel = new ChatModel();

        $saveResult = $chatModel->saveMessage($kdKlien, $kdMahasiswa, $message);

        if ($saveResult) {
            log_message('info', 'Pesan berhasil disimpan: ' . $message);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            log_message('error', 'Gagal menyimpan pesan: ' . $message);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan pesan']);
        }
    }
}
