<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class mahasiswaModel extends Model {
        protected $table = 'mhspsikologi';
        protected $primaryKey = 'kd_mahasiswa';
        protected $useAutoIncrement = true;
        protected $allowedFields = ['username', 'password', 'email', 'nim', 'asal_univ', 'fotoKTM', 'foto'];
    }