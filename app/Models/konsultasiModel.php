<?php
namespace App\Models;
use CodeIgniter\Model;

class kosnultasiModel extends Model {
    protected $table = 'konsultasi';
    protected $primaryKey = 'kd_konsultasi';
    protected $useAutoIncrement = true;
    protected $allowed_fields = ['total_harga', 'tanggal_konsultasi', 'metode_pembayaran','kd_psikolog', 'kd_mahasiswa', 'kd_klien'];

     // Get jadwal by psychologist code
     public function getKonsultasibyPsikolog($kd_psikolog) {
        return $this->where('kd_psikolog', $kd_psikolog)->findAll();
    }
}
?>