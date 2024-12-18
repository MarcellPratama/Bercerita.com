<?php
namespace App\Models;

use CodeIgniter\Model;

class psikologModel extends Model
{
    protected $table = 'psikolog';
    protected $primaryKey = 'kd_psikolog';
    protected $useAutoIncrement = false; // Tidak menggunakan auto increment
    protected $allowedFields = ['username', 'password', 'email', 'domisili', 'ktp', 'foto', 'lisensi','tentang_saya', 'pendekatan_klinis', 'layanan', 'tarif'];
    protected $keyType = 'string'; // Primary key berupa string

    // Override fungsi `insert` untuk menghasilkan ID otomatis
    public function insert($data = null, $returnID = true)
    {
        // Jika ID belum ada di data, buat ID baru
        if (!isset($data['kd_psikolog']) || empty($data['kd_psikolog'])) {
            $data['kd_psikolog'] = $this->generateNewId();
        }

        // Panggil fungsi insert asli milik Model
        return parent::insert($data, $returnID);
    } 

    // Fungsi untuk menghasilkan ID psikolog baru
    private function generateNewId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        // Ambil ID psikolog terakhir dari tabel
        $lastRow = $builder->select($this->primaryKey)
            ->orderBy($this->primaryKey, 'DESC')
            ->get(1)
            ->getRow();

        if (!$lastRow) {
            $nextIdNumber = 1; // Jika tidak ada data, ID pertama dimulai dari 1
        } else {
            // Ekstrak angka dari ID terakhir
            $lastIdNumber = (int) str_replace('PSK', '', $lastRow->kd_psikolog);
            $nextIdNumber = $lastIdNumber + 1;
        }

        // Kembalikan ID baru dengan format "PSK[number]"
        return 'PSK' . str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT); // Contoh: PSK0001
    }
}
