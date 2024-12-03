<?php
namespace App\Models;

use CodeIgniter\Model;

class adminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'kd_admin';
    protected $useAutoIncrement = false; // Tidak menggunakan auto increment
    protected $allowedFields = ['username', 'password'];
    protected $keyType = 'string'; // Primary key berupa string

    // Override fungsi `insert` untuk menghasilkan ID otomatis
    public function insert($data = null, $returnID = true)
    {
        // Jika ID belum ada di data, buat ID baru
        if (!isset($data['kd_admin']) || empty($data['kd_admin'])) {
            $data['kd_admin'] = $this->generateNewId();
        }

        // Panggil fungsi insert asli milik Model
        return parent::insert($data, $returnID);
    }

    // Fungsi untuk menghasilkan ID admin baru
    private function generateNewId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        // Ambil ID admin terakhir dari tabel
        $lastRow = $builder->select($this->primaryKey)
            ->orderBy($this->primaryKey, 'DESC')
            ->get(1)
            ->getRow();

        if (!$lastRow) {
            $nextIdNumber = 1; // Jika tidak ada data, ID pertama dimulai dari 1
        } else {
            // Ekstrak angka dari ID terakhir
            $lastIdNumber = (int) str_replace('ADM', '', $lastRow->kd_admin);
            $nextIdNumber = $lastIdNumber + 1;
        }

        // Kembalikan ID baru dengan format "ADM[number]"
        return 'AD' . str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT); // Contoh: ADM0001
    }
}
