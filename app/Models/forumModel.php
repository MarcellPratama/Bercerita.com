<?php
namespace App\Models;
use CodeIgniter\Model;

class forumModel extends Model {
    protected $table = 'forum';
    protected $primaryKey = 'kode_forum';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_forum', 'kategori_forum', 'tanggal', 'jumlah_peserta', 'foto'];
    // Fungsi untuk mengambil semua forum
    public function getAllForums() {
        return $this->findAll();
    }

    // Fungsi untuk menambah forum baru
    public function addForum($data) {
        return $this->insert($data);
    }

    // Fungsi untuk menghapus forum berdasarkan kode_forum
    public function deleteForum($kode_forum) {
        return $this->delete($kode_forum);
    }

    // Fungsi untuk mengedit data forum
    public function updateForum($kode_forum, $data) {
        return $this->update($kode_forum, $data);
    }
 }
