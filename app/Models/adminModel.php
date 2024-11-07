<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class adminModel extends Model {
        protected $table = 'admin';
        protected $primaryKey = 'kd_admin';
        protected $useAutoIncrement = true;
        protected $allowedFields = ['username', 'password'];
    }