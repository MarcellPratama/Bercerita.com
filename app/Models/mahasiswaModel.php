<?php

namespace App\Models;

use CodeIgniter\Model;

class mahasiswaModel extends Model
{
    protected $table = 'mhspsikologi';
    protected $primaryKey = 'kd_mahasiswa';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['username', 'password', 'email', 'nim', 'asal_univ', 'fotoKTM', 'foto'];
    protected $keyType = 'string';

    public function getMahasiswaById($kd_mahasiswa)
    {
        return $this->find($kd_mahasiswa);
    }
    public function insert($data = null, $returnID = true)
    {
        if (!isset($data['kd_mahasiswa']) || empty($data['kd_mahasiswa'])) {
            $data['kd_mahasiswa'] = $this->generateNewId();
        }

        return parent::insert($data, $returnID);
    }

    private function generateNewId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $lastRow = $builder->select($this->primaryKey)
            ->orderBy($this->primaryKey, 'DESC')
            ->get(1)
            ->getRow();

        if (!$lastRow) {
            $nextIdNumber = 1;
        } else {
            $lastIdNumber = (int) str_replace('MHS', '', $lastRow->kd_mahasiswa);
            $nextIdNumber = $lastIdNumber + 1;
        }

        return 'MHS' . str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT);
    }
}
