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
    protected $useAutoIncrement = true;

    // Menentukan kolom yang dapat diisi atau diubah oleh pengguna
    protected $allowedFields = ['tanggal_verifikasi', 'status', 'kd_admin', 'kd_registrasi'];
}
