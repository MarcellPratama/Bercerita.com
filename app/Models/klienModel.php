<?php
namespace App\Models;

use CodeIgniter\Model;

class klienModel extends Model
{
    protected $table = 'klien';
    protected $primaryKey = 'kd_klien';
    protected $useAutoIncrement = false; // Tidak menggunakan auto increment
    protected $allowedFields = ['username', 'password', 'email', 'foto'];
    protected $keyType = 'string'; // Primary key berupa string

    // Override fungsi `insert` untuk membuat ID otomatis
    public function insert($data = null, $returnID = true)
    {
        // Jika ID tidak diberikan, buat ID baru
        if (!isset($data['kd_klien']) || empty($data['kd_klien'])) {
            $data['kd_klien'] = $this->generateNewId();
        }

        // Panggil fungsi insert asli milik Model
        return parent::insert($data, $returnID);
    }

    // Fungsi untuk menghasilkan ID klien baru
    private function generateNewId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        // Ambil ID terakhir dari database
        $lastRow = $builder->select($this->primaryKey)
            ->orderBy($this->primaryKey, 'DESC')
            ->get(1)
            ->getRow();

        if (!$lastRow) {
            $nextIdNumber = 1; // ID pertama
        } else {
            // Ekstrak angka dari ID terakhir
            $lastIdNumber = (int) str_replace('KL', '', $lastRow->kd_klien);
            $nextIdNumber = $lastIdNumber + 1;
        }

        // Kembalikan ID baru dengan format "KL[number]"
        return 'KL' . str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT); // Contoh: KL0001
    }
}
