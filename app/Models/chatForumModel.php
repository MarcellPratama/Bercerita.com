<?php

namespace App\Models;

use CodeIgniter\Model;

class chatForumModel extends Model
{
    protected $table      = 'chat_forum';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_forum', 'pengirim', 'pesan', 'waktu'];
}