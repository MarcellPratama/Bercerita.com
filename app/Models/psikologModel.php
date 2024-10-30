<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class psikologModel extends Model {
        protected $table = 'psikolog';
        protected $primaryKey = 'kd_psikolog';
        protected $useAutoIncrement = true;
        protected $allowedFields = ['username', 'password', 'email', 'domisili', 'ktp', 'foto', 'lisensi'];
    }