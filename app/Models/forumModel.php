<?php

namespace App\Models;

use CodeIgniter\Model;

class forumModel extends Model
{
    protected $table = 'forum';
    protected $primaryKey = 'kode_forum';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['kode_forum', 'nama_forum', 'kategori_forum', 'tanggal', 'jumlah_peserta', 'foto', 'deskripsi'];
}