<?php

namespace App\Models;
use CodeIgniter\Model;

class verifikasiModel extends Model
{
    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'verifikasi';

    // Menentukan primary key dari tabel
    protected $primaryKey = 'kd_verifikasi';

    // Menentukan apakah model menggunakan auto increment
    protected $useAutoIncrement = false; // We are generating custom IDs, not auto-increment

    // Menentukan kolom yang dapat diisi atau diubah oleh pengguna
    protected $allowedFields = ['kd_verifikasi', 'tanggal_verifikasi', 'status', 'kd_admin', 'kd_registrasi'];

    // Override fungsi `insert` untuk menghasilkan ID otomatis dengan format "VER[number]"
    public function insert($data = null, $returnID = true)
    {
        // Jika ID belum ada di data, buat ID baru
        if (!isset($data['kd_verifikasi']) || empty($data['kd_verifikasi'])) {
            $data['kd_verifikasi'] = $this->generateNewId();
        }

        // Panggil fungsi insert asli milik Model
        return parent::insert($data, $returnID);
    }

    // Fungsi untuk menghasilkan ID verifikasi baru dengan format "VER[number]"
    private function generateNewId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        // Ambil ID verifikasi terakhir dari tabel
        $lastRow = $builder->select($this->primaryKey)
            ->orderBy($this->primaryKey, 'DESC')
            ->get(1)
            ->getRow();

        if (!$lastRow) {
            $nextIdNumber = 1; // Jika tidak ada data, ID pertama dimulai dari 1
        } else {
            // Ekstrak angka dari ID terakhir
            $lastIdNumber = (int) str_replace('VER', '', $lastRow->kd_verifikasi);
            $nextIdNumber = $lastIdNumber + 1;
        }

        // Kembalikan ID baru dengan format "VER[number]"
        return 'VER' . str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT); // Contoh: VER0001
    }

    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'kd_admin', 'kd_admin');
    }

    // Relasi dengan Registrasi
    public function registrasi()
    {
        return $this->belongsTo(RegistrasiModel::class, 'kd_registrasi', 'kd_registrasi');
    }
    
    public function getByUsername($username)
{
    // Ambil data verifikasi berdasarkan username
    return $this->where('username', $username)->first();
}

public function getByRegistrasi($kd_registrasi)
{
    // Ambil data verifikasi berdasarkan kd_registrasi
    return $this->where('kd_registrasi', $kd_registrasi)->first();
}
public function psikolog()
{
    return $this->hasOneThrough(PsikologModel::class, RegistrasiModel::class, 'kd_psikolog', 'kd_psikolog', 'kd_registrasi', 'kd_psikolog');
}
    
}