<?php
namespace App\Models;

use CodeIgniter\Model;

class registrasiModel extends Model
{
    protected $table = 'registrasi'; // Nama tabel
    protected $primaryKey = 'kd_registrasi'; // Primary key
    protected $useAutoIncrement = false; // Tidak menggunakan auto increment
    protected $allowedFields = [
        'kd_registrasi',
        'tanggal_registrasi',
        'kd_psikolog',
        'kd_klien',
        'kd_mahasiswa'
    ];
    protected $keyType = 'string'; // Primary key berupa string

    // Override fungsi `insert` untuk menghasilkan ID otomatis
    public function insert($data = null, $returnID = true)
    {
        // Atur timezone Jakarta
        date_default_timezone_set('Asia/Jakarta');

        // Jika ID belum ada di data, buat ID baru
        if (!isset($data['kd_registrasi']) || empty($data['kd_registrasi'])) {
            $data['kd_registrasi'] = $this->generateNewId();
        }

        // Set tanggal registrasi ke waktu sekarang dengan format Y-m-d H:i:s
        if (!isset($data['tanggal_registrasi'])) {
            $data['tanggal_registrasi'] = date('Y-m-d H:i:s');  // Format: 2024-12-04 15:30:45
        }

        // Panggil fungsi insert asli milik Model
        return parent::insert($data, $returnID);
    }

    // Fungsi untuk menghasilkan ID registrasi baru
    private function generateNewId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        // Ambil ID registrasi terakhir dari tabel
        $lastRow = $builder->select($this->primaryKey)
            ->orderBy($this->primaryKey, 'DESC')
            ->get(1)
            ->getRow();

        if (!$lastRow) {
            $nextIdNumber = 1; // Jika tidak ada data, ID pertama dimulai dari 1
        } else {
            // Ekstrak angka dari ID terakhir
            $lastIdNumber = (int) str_replace('REG', '', $lastRow->kd_registrasi);
            $nextIdNumber = $lastIdNumber + 1;
        }

        // Kembalikan ID baru dengan format "REG[number]"
        return 'REG' . str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT); // Contoh: REG0001
    }

    public function psikolog()
    {
        return $this->belongsTo(PsikologModel::class, 'kd_psikolog', 'kd_psikolog');
    }
}