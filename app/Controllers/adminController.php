<?php

namespace App\Controllers;

use App\Models\mahasiswaModel;
use App\Models\psikologModel;
use App\Models\registrasiModel;
use App\Models\verifikasiModel;
use App\Models\adminModel;
use App\Models\catatanModel;

class adminController extends BaseController
{
    public function verifikasi()
    {
        $registrasiModel = new registrasiModel();
        $psikologModel = new psikologModel();
        $mahasiswaModel = new mahasiswaModel();
        $verifikasiModel = new verifikasiModel();
    
        // Ambil parameter pencarian dari request
        $searchQuery = $this->request->getVar('search'); // Ambil parameter "search" dari input
    
        // Ambil semua data registrasi
        $registrasiData = $registrasiModel->findAll();
        $data['pengguna'] = [];
    
        foreach ($registrasiData as $registrasi) {
            $userData = [];
    
            if ($registrasi['kd_psikolog']) {
                $userData = $psikologModel->find($registrasi['kd_psikolog']);
                $userData['kategori'] = 'Psikolog';
            } elseif ($registrasi['kd_mahasiswa']) {
                $userData = $mahasiswaModel->find($registrasi['kd_mahasiswa']);
                $userData['kategori'] = 'Mahasiswa Psikologi';
            } else {
                continue;
            }
    
            if (!empty($userData)) {
                $userData['id'] = $registrasi['kd_registrasi'];
                $verifikasi = $verifikasiModel->where('kd_registrasi', $registrasi['kd_registrasi'])->first();
                $userData['status_verifikasi'] = $verifikasi ? $verifikasi['status'] : 'Belum Diverifikasi';
    
                // Filter berdasarkan pencarian username
                if ($searchQuery) {
                    if (stripos($userData['username'], $searchQuery) !== false) {
                        $data['pengguna'][] = $userData;
                    }
                } else {
                    $data['pengguna'][] = $userData;
                }
            }
        }
    
        // Urutkan data sehingga status "Belum Diverifikasi" ada di bagian atas
        usort($data['pengguna'], function ($a, $b) {
            if ($a['status_verifikasi'] === 'Belum Diverifikasi' && $b['status_verifikasi'] !== 'Belum Diverifikasi') {
                return -1; // "Belum Diverifikasi" harus di atas
            } elseif ($a['status_verifikasi'] !== 'Belum Diverifikasi' && $b['status_verifikasi'] === 'Belum Diverifikasi') {
                return 1; // Status lain di bawah
            } else {
                return strcmp($a['username'], $b['username']); // Urutkan abjad jika status sama
            }
        });
    
        $data['search'] = $searchQuery; // Kirimkan query pencarian ke view
        return view('viewVerifikasi', $data);
    }
    
    
    public function approve($id)
    {
        $verifikasiModel = new verifikasiModel();
        $registrasiModel = new registrasiModel();
        // $adminModel = new adminModel();

        // Pastikan admin_id ada di session
        $adminId = session()->get('admin_id');
        
        if (!$adminId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Admin tidak ditemukan dalam session.']);
        }

        $registrasi = $registrasiModel->find($id);
        if (!$registrasi) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found.']);
        }

        // Periksa apakah admin sudah memverifikasi pengguna ini
        $existingVerifikasi = $verifikasiModel->where('kd_admin', $adminId)
                                              ->where('kd_registrasi', $id)
                                              ->first();
                                              
        if ($existingVerifikasi) {
    return $this->response->setJSON(['success' => false, 'message' => 'Admin sudah memverifikasi pengguna ini.'])
                          ->setStatusCode(400); // Gunakan kode HTTP 400 (Bad Request)
}

        // Siapkan data untuk verifikasi
        $data = [
            'kd_verifikasi' => 'VER' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            'status' => 'Diterima',
            'kd_admin' => $adminId,
            'kd_registrasi' => $id
        ];

        // Simpan data verifikasi
        if ($verifikasiModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'User approved successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Approval failed.']);
        }
    }

    public function reject($id)
    {
        $verifikasiModel = new verifikasiModel();
        $registrasiModel = new registrasiModel();
        // $adminModel = new AdminModel();
    
        // Pastikan admin_id ada di session
        $adminId = session()->get('admin_id');
        
        if (!$adminId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Admin tidak ditemukan dalam session.']);
        }
    
        $registrasi = $registrasiModel->find($id);
        if (!$registrasi) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pengguna tidak ditemukan.']);
        }
    
        // Periksa apakah admin sudah memverifikasi atau menolak pengguna ini
        $existingVerifikasi = $verifikasiModel->where('kd_admin', $adminId)
                                              ->where('kd_registrasi', $id)
                                              ->first();
        
        
        if ($existingVerifikasi) {
            return $this->response->setJSON(['success' => false, 'message' => 'Admin sudah memverifikasi atau menolak pengguna ini.'])
                    ->setStatusCode(400); // Gunakan kode HTTP 400 (Bad Request)
                                            }
                                            
    
        // Siapkan data untuk penolakan
        $data = [
            'kd_verifikasi' => 'VER' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            'status' => 'Ditolak',
            'kd_admin' => $adminId,
            'kd_registrasi' => $id
        ];
    
        // Simpan data penolakan
        if ($verifikasiModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Pengguna berhasil ditolak.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Penolakan gagal.']);
        }
    }
   
    public function lihatDetailPsikolog($id)
    {
        $psikologModel = new psikologModel();
        $registrasiModel = new registrasiModel();
        // $verifikasiModel = new verifikasiModel();
    
        // Cari data registrasi berdasarkan ID registrasi
        $registrasi = $registrasiModel->where('kd_registrasi', $id)->first();
        
        if (!$registrasi) {
            // Jika tidak ada data registrasi
            return $this->response->setJSON(['success' => false, 'message' => "No registration found for the given ID: $id"]);
        }
    
        // Pastikan 'kd_psikolog' ada dalam registrasi
        if (!isset($registrasi['kd_psikolog']) || empty($registrasi['kd_psikolog'])) {
            // Jika tidak ada psikolog ID
            return $this->response->setJSON(['success' => false, 'message' => "Psikolog ID is missing in registration data for ID: $id"]);
        }
    
        // Cari data psikolog berdasarkan kd_psikolog di registrasi
        $psikolog = $psikologModel->find($registrasi['kd_psikolog']);
        
        if (!$psikolog) {
            // Jika psikolog tidak ditemukan
            return $this->response->setJSON(['success' => false, 'message' => "Psikolog not found for the given ID: " . $registrasi['kd_psikolog']]);
        }
    
        // Jika semua data ditemukan, siapkan data untuk view
        $data = [
            'psikolog' => $psikolog,
            'registrasi' => $registrasi,
        ];
    
        return view('viewLihatDetailPsikolog', $data);
    }
    public function cekVerifikasiPsikolog($id)
{
    // Membuat instance model psikologModel
    $psikologModel = new psikologModel();

    // Cari data psikolog berdasarkan ID
    $psikolog = $psikologModel->find($id); // Gunakan $psikologModel di sini

    // // Jika tidak ditemukan, tampilkan halaman error atau redirect
    // if (!$psikolog) {
    //     return redirect()->to('/adminLihatDetailPsiko')->with('error', 'Psikolog tidak ditemukan.');
    // }

    // Kirim data psikolog ke view detail
    return view('lihatDetailPsiko', ['psikolog' => $psikolog]);
}


  
public function lihatDetailMhs($id)
{
    $mahasiswaModel = new mahasiswaModel();
    $registrasiModel = new registrasiModel();
    
    // Cari data registrasi berdasarkan ID registrasi
    $registrasi = $registrasiModel->where('kd_registrasi', $id)->first();

    // Cari data mahasiswa berdasarkan kd_mahasiswa di registrasi
    $mahasiswa = $mahasiswaModel->find($registrasi['kd_mahasiswa']);

    // Siapkan data untuk dikirimkan ke view
    $data = [
        'mahasiswa' => $mahasiswa,
        'registrasi' => $registrasi, // Pastikan data registrasi dikirimkan ke view
    ];

    // Return view dengan data
    return view('viewLihatDetailMhsPsikologi', $data);
}


public function cekVerifikasiMhsPsikologi($id)
{
    
    // Membuat instance model mahasiswa
    $mahasiswaModel = new mahasiswaModel(); // Pastikan model mahasiswa sudah ada

    // Cari data mahasiswa berdasarkan ID
    $mahasiswa = $mahasiswaModel->find($id);

    // // Jika tidak ditemukan, tampilkan halaman error atau redirect
    // if (!$mahasiswa) {
    //     return redirect()->to('/adminLihatMhs')->with('error', 'Mahasiswa Psikologi tidak ditemukan.');
    // }

    // Kirim data mahasiswa ke view detail
    return view('lihatDetailMhs', ['mahasiswa' => $mahasiswa]);
}


public function lihatPengguna($kategori)
{
    $userModel = $kategori === 'psikolog' ? new psikologModel() : new mahasiswaModel();
    $verifikasiModel = new verifikasiModel();
    $registrasiModel = new registrasiModel();

    // Ambil parameter halaman dari request
    $page = (int)($this->request->getVar('page') ?? 1); // Default halaman 1
    $rowsPerPage = 10; // Jumlah data per halaman
    $offset = ($page - 1) * $rowsPerPage; // Hitung offset data berdasarkan halaman

    // Ambil data verifikasi pengguna yang sudah diterima
    $verifikasiData = $verifikasiModel->where('status', 'Diterima')->findAll();

    $filteredUsers = [];
    foreach ($verifikasiData as $verifikasi) {
        $registrasi = $registrasiModel->find($verifikasi['kd_registrasi']);
        $kd_user = $kategori === 'psikolog' ? $registrasi['kd_psikolog'] : $registrasi['kd_mahasiswa'];

        if ($registrasi && !empty($kd_user)) {
            $userData = $userModel->find($kd_user);
            if ($userData) {
                $userData['kategori'] = $kategori === 'psikolog' ? 'Psikolog' : 'Mahasiswa Psikologi';
                $userData['tanggal_verifikasi'] = $verifikasi['tanggal_verifikasi'];
                $userData['id'] = $kd_user;
                $filteredUsers[] = $userData;
            }
        }
    }

    // Urutkan data pengguna berdasarkan abjad pada username
    usort($filteredUsers, function ($a, $b) {
        return strcmp($a['username'], $b['username']);
    });

    // Filter data untuk halaman saat ini
    $data['pengguna'] = array_slice($filteredUsers, $offset, $rowsPerPage);

    // Hitung total halaman
    $totalRows = count($filteredUsers);
    $totalPages = ceil($totalRows / $rowsPerPage);

    $data['pagination'] = [
        'currentPage' => $page,
        'totalPages' => $totalPages,
    ];

    // Hitung nomor urut awal untuk halaman ini
    $data['startNo'] = $offset + 1; // Nomor urut dimulai dari offset + 1

    // Tentukan nama view berdasarkan kategori
    $viewName = $kategori === 'psikolog' ? 'viewPsikolog' : 'viewMhsPsikologi';
    return view($viewName, $data);
}


// Fungsi untuk melihat daftar mahasiswa
public function lihatMhs()
{
    return $this->lihatPengguna('mahasiswa');
}

// Fungsi untuk melihat daftar psikolog
public function lihatPsikolog()
{
    return $this->lihatPengguna('psikolog');
}

public function kelolaMading()
{
    $catatanModel = new CatatanModel(); // Sesuaikan dengan model Anda
    $perPage = 10; // Jumlah data per halaman
    $currentPage = (int)($this->request->getVar('page') ?? 1); // Ambil halaman dari query parameter, default 1
    $search = $this->request->getVar('search') ?? ''; // Ambil search query jika ada

    // Hitung total data yang sesuai dengan query pencarian
    if ($search) {
        $totalRows = $catatanModel->like('kode_catatan', $search)->countAllResults();
        $catatan = $catatanModel->like('kode_catatan', $search)
            ->orderBy('tanggal_dibuat', 'DESC')
            ->findAll($perPage, ($currentPage - 1) * $perPage);
    } else {
        $totalRows = $catatanModel->countAllResults();
        $catatan = $catatanModel->orderBy('tanggal_dibuat', 'DESC')
            ->findAll($perPage, ($currentPage - 1) * $perPage);
    }

    // Hitung total halaman
    $totalPages = (int)ceil($totalRows / $perPage);

    // Kirimkan data pagination ke view
    $data = [
        'catatan' => $catatan,
        'pagination' => [
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ],
        'search' => $search, // Pass the search term to the view
    ];

    return view('viewKelolaMading', $data); // Kirim data ke view
}


public function deleteMading($id)
{
    $madingModel = new catatanModel();

    // Cari data mading berdasarkan ID
    $mading = $madingModel->find($id);
    if (!$mading) {
        return $this->response->setJSON(['success' => false, 'message' => 'Data mading tidak ditemukan.']);
    }

    // Lakukan penghapusan data
    if ($madingModel->delete($id)) {
        return $this->response->setJSON(['success' => true, 'message' => 'Data mading berhasil dihapus.']);
    } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data mading.']);
    }
}

    public function dashboard()
    {
        return view('viewDashboard');
    }

    
}