<?php 
namespace App\Models;
use CodeIgniter\Model;

class pemesananModel extends Model {
    protected $table = 'pemesanan_konsultasi';
    protected $primaryKey = 'kd_pesan';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['tanggal_pesan', 'waktu_konsultasi', 'tanggal_konsultasi', 
    'total_harga', 'metode_pembayaran', 'status_pesanan', 'kd_psikolog', 
    'kd_mahasiswa', 'kd_mahasiswa', 'kd_klien', 'jenis_konsultasi', 'tempat'];
    
    protected $validationRules = [
        'jenis_konsultasi'   => 'required|in_list[chat,tatap muka]',
        'tanggal_konsultasi' => 'required|valid_date',
        'waktu_konsultasi'   => 'required',
        'total_harga'        => 'required|numeric',
        'metode_pembayaran'  => 'required|in_list[Transfer Bank,E-Wallet]',
    ];

    protected $validationMessages = [
        'total_harga' => [
            'required' => 'Total harga harus diisi.',
            'numeric'  => 'Total harga harus berupa angka.'
        ],
        'metode_pembayaran' => [
            'required' => 'Metode pembayaran harus dipilih.',
            'in_list'  => 'Metode pembayaran tidak valid.'
        ]
    ];
}