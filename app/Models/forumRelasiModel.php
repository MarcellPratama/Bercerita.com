<?php

namespace App\Models;

use CodeIgniter\Model;

class forumRelasiModel extends Model
{
    protected $table = 'forum_klien';
    protected $primaryKey = 'id_relasi';
    protected $allowedFields = ['kd_klien', 'kode_forum'];
}
