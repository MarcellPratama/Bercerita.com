<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chat_messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kd_klien', 'kd_mahasiswa', 'message', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function saveMessage($kd_klien, $kd_mahasiswa, $message)
    {
        if (empty($kd_klien) || empty($kd_mahasiswa) || empty($message)) {
            return false;
        }

        $data = [
            'kd_klien' => $kd_klien,
            'kd_mahasiswa' => $kd_mahasiswa,
            'message' => $message,
        ];

        try {
            return $this->insert($data);
        } catch (\Exception $e) {
            log_message('error', 'Gagal menyimpan pesan: ' . $e->getMessage());
            return false;
        }
    }
}
