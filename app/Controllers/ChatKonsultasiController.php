<?php
namespace App\Controllers;

use App\Models\ChatKonsultasiModel;

class ChatController extends BaseController
{
    // Simpan pesan ke database
    public function saveMessage()
    {
        $chatModel = new ChatKonsultasiModel();

        $data = [
            'kd_pesan'   => $this->request->getPost('kd_pesan'),   // ID sesi konsultasi
            'sender'     => $this->request->getPost('sender'),    // psikolog/mahasiswa/klien
            'sender_id'  => $this->request->getPost('sender_id'), // ID pengirim
            'message'    => $this->request->getPost('message'),
            'created_at' => date('Y-m-d H:i:s')                   // Waktu pengiriman
        ];

        $chatModel->saveMessage($data);

        return $this->response->setJSON(['status' => 'success']);
    }

    // Ambil pesan berdasarkan sesi konsultasi
    public function getMessages($kd_pesan)
    {
        $chatModel = new ChatKonsultasiModel();
        $messages = $chatModel->getMessagesBySession($kd_pesan);

        return $this->response->setJSON($messages);
    }
}
