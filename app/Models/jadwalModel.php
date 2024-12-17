<?php
namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model {
    protected $table = 'jadwal_praktek';
    protected $primaryKey = 'id_jadwal';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['hari', 'jam_buka', 'jam_tutup', 'status', 'kd_psikolog'];
    protected $returnType = 'array';

    public function getAllJadwal() {
        return $this->findAll();
    }

    // Get jadwal by psychologist code
    public function getJadwalByPsikolog($kd_psikolog) {
        return $this->where('kd_psikolog', $kd_psikolog)->findAll();
    }

    // Save new schedule or update if it already exists
    public function simpanJadwal($data) {
        // You can add additional logic here to handle specific cases, like checking overlapping schedules.
        return $this->save($data);
    }

    // Insert a new jadwal
    public function insertJadwal($data) {
        return $this->insert($data);
    }

    // Update an existing jadwal
    public function updateJadwal($id, $data) {
        return $this->update($id, $data);
    }
}
?>
