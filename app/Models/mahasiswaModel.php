<?php
namespace App\Models;

use CodeIgniter\Model;

class mahasiswaModel extends Model
{
    protected $table = 'mhspsikologi';
    protected $primaryKey = 'kd_mahasiswa';
    protected $useAutoIncrement = false; // Tidak menggunakan auto increment
    protected $allowedFields = ['username', 'password', 'email', 'nim', 'asal_univ', 'fotoKTM', 'foto'];
    protected $keyType = 'string'; // Primary key berupa string

    // Override fungsi `insert` untuk menghasilkan ID otomatis
    public function insert($data = null, $returnID = true)
    {
        // Jika ID belum ada di data, buat ID baru
        if (!isset($data['kd_mahasiswa']) || empty($data['kd_mahasiswa'])) {
            $data['kd_mahasiswa'] = $this->generateNewId();
        }

        // Panggil fungsi insert asli milik Model
        return parent::insert($data, $returnID);
    }

    // Fungsi untuk menghasilkan ID mahasiswa baru
    private function generateNewId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        // Ambil ID mahasiswa terakhir dari tabel
        $lastRow = $builder->select($this->primaryKey)
            ->orderBy($this->primaryKey, 'DESC')
            ->get(1)
            ->getRow();

        if (!$lastRow) {
            $nextIdNumber = 1; // Jika tidak ada data, ID pertama dimulai dari 1
        } else {
            // Ekstrak angka dari ID terakhir
            $lastIdNumber = (int) str_replace('MHS', '', $lastRow->kd_mahasiswa);
            $nextIdNumber = $lastIdNumber + 1;
        }

        // Kembalikan ID baru dengan format "MHS[number]"
        return 'MHS' . str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT); // Contoh: MHS0001
    }
}
