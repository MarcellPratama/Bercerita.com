<?php

namespace App\Models;

use CodeIgniter\Model;

class catatanModel extends Model
{
    protected $table = 'catatanonline';
    protected $primaryKey = 'kode_catatan';
    protected $useAutoIncrement = false; // Tidak menggunakan auto increment
    protected $allowedFields = ['tanggal_dibuat', 'isi_catatan'];
    protected $keyType = 'string'; // Primary key berupa string

    // Override fungsi `insert` untuk menghasilkan ID otomatis
    public function insert($data = null, $returnID = true)
    {
        // Jika ID belum ada di data, buat ID baru
        if (!isset($data['kode_catatan']) || empty($data['kode_catatan'])) {
            $data['kode_catatan'] = $this->generateNewId();
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
            $lastIdNumber = (int) str_replace('CT', '', $lastRow->kode_catatan);
            $nextIdNumber = $lastIdNumber + 1;
        }

        // Kembalikan ID baru dengan format "ADM[number]"
        return 'CT' . str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT); // Contoh: ADM0001
    }

    public function deleteExpiredNotes()
    {
        // Waktu sekarang dalam format datetime
        $currentTime = date('Y-m-d H:i:s');

        // Hapus catatan yang `tanggal_dibuat` kurang dari 24 jam lalu
        $this->where('tanggal_dibuat <', date('Y-m-d H:i:s', strtotime('-24 hours', strtotime($currentTime))))
            ->delete();
    }
}
