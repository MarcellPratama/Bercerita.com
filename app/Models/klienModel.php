<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class klienModel extends Model {
        protected $table = 'klien';
        protected $primaryKey = 'kd_klien';
        protected $useAutoIncrement = true;
        protected $allowedFields = ['username', 'password', 'email', 'foto'];
    }