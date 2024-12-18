<?php 
namespace App\Models;
use CodeIgniter\Model;

class ChatKonsultasiModel extends Model {
    protected $table = 'chat_konsultasi';
    protected $primaryKey = 'kd_chat';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['kd_pesan','sender','sender_id','message','created_at'];
    
}