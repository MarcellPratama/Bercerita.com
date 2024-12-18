<?php

namespace App\Models;

use CodeIgniter\Model;

class forumRelasiModel extends Model
{
    protected $table = 'forum_klien';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kd_klien', 'kode_forum'];
}
