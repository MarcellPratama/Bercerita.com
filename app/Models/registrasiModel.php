<?php

namespace App\Models;
use CodeIgniter\Model;

class registrasiModel extends Model
{
    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'registrasi';

    // Menentukan primary key dari tabel
    protected $primaryKey = 'kd_registrasi';

    // Menentukan apakah model menggunakan auto increment
    protected $useAutoIncrement = true;

    // Menentukan kolom yang dapat diisi atau diubah oleh pengguna
    protected $allowedFields = ['tanggal_registrasi', 'kd_psikolog', 'kd_klien', 'kd_mahasiswa'];
}
