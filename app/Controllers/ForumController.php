<?php

namespace App\Controllers;

use App\Models\forumModel;
use App\Models\mahasiswaModel;

class ForumController extends BaseController
{
    protected $forumModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->forumModel = new forumModel();
        $this->mahasiswaModel = new mahasiswaModel();
    }

    public function index()
    {
        $kd_mahasiswa = session()->get('kd_mahasiswa');

        if (!$kd_mahasiswa) {
            return redirect()->to('/login')->with('error', 'Anda harus login sebagai mahasiswa.');
        }

        $forums = $this->forumModel->where('kd_mahasiswa', $kd_mahasiswa)->findAll();

        return view('CRUD_Forum', ['forums' => $forums]);
    }

    public function addForum()
    {
        // Ambil data kd_mahasiswa dari sesi login
        $kd_mahasiswa = session()->get('kd_mahasiswa');
        if (!$kd_mahasiswa) {
            return redirect()->to('/login')->with('error', 'DEBUG');
        }

        if (!$this->validate([
            'nama_forum' => 'required|min_length[3]',
            'kategori_forum' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|valid_date',
            'jumlah_peserta' => 'required|numeric|greater_than[0]',
            'foto' => 'uploaded[foto]|is_image[foto]|max_size[foto,2048]',
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Generate kode forum baru
        $lastForum = $this->forumModel->orderBy('kode_forum', 'DESC')->first();
        $newNumber = $lastForum ? (int) substr($lastForum['kode_forum'], 2) + 1 : 1;
        $kodeForum = 'KF' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Upload file foto
        $foto = $this->request->getFile('foto');
        $fotoName = $foto->getRandomName();
        if ($foto->isValid() && !$foto->hasMoved()) {
            $foto->move('uploads/forum/', $fotoName);
        } else {
            return redirect()->back()->with('error', 'Gagal mengunggah foto.');
        }

        // Simpan data ke database
        $saved = $this->forumModel->save([
            'kode_forum' => $kodeForum,
            'nama_forum' => $this->request->getPost('nama_forum'),
            'kategori_forum' => $this->request->getPost('kategori_forum'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah_peserta' => $this->request->getPost('jumlah_peserta'),
            'foto' => 'uploads/forum/' . $fotoName,
            'kd_mahasiswa' => $kd_mahasiswa,
        ]);

        if (!$saved) {
            return redirect()->back()->with('error', 'Gagal menyimpan forum ke database.');
        }

        return redirect()->to('/forum')->with('success', 'Forum berhasil ditambahkan');
    }


    public function deleteForum($kode_forum)
    {
        $kd_mahasiswa = session()->get('kd_mahasiswa');
        if (!$kd_mahasiswa) {
            return redirect()->to('/login')->with('error', 'Anda harus login sebagai mahasiswa.');
        }

        $forum = $this->forumModel->where('kode_forum', $kode_forum)
            ->where('kd_mahasiswa', $kd_mahasiswa)
            ->first();

        if (!$forum) {
            return redirect()->to('/forum')->with('error', 'Forum tidak ditemukan atau Anda tidak memiliki akses.');
        }

        if (!empty($forum['foto']) && file_exists($forum['foto'])) {
            unlink($forum['foto']);
        }

        $this->forumModel->delete($kode_forum);
        return redirect()->to('/forum')->with('success', 'Forum berhasil dihapus');
    }

    public function joinForum()
    {
        // Ambil kd_klien dan kode_forum dari form
        $kode_klien = $this->request->getPost('kode_klien');
        $kode_forum = $this->request->getPost('kode_forum');

        // Validasi input
        if (!$kode_klien || !$kode_forum) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Load model untuk validasi foreign key
        $klienModel = new \App\Models\KlienModel();
        $forumModel = new \App\Models\ForumModel();
        $forumRelasiModel = new \App\Models\ForumRelasiModel();

        $klienExists = $klienModel->where('kd_klien', $kode_klien)->first();
        $forumExists = $forumModel->where('kode_forum', $kode_forum)->first();

        if (!$klienExists || !$forumExists) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        // Cek apakah klien sudah bergabung dengan forum
        $existingRelasi = $forumRelasiModel
            ->where('kd_klien', $kode_klien)
            ->where('kode_forum', $kode_forum)
            ->first();

        if ($existingRelasi) {
            // Jika sudah ada relasi, kembalikan pesan error
            return redirect()->back()->with('error', 'Anda sudah bergabung ke forum ini.');
        }

        // Simpan ke tabel relasi jika belum ada
        $data = [
            'kd_klien' => $kode_klien,
            'kode_forum' => $kode_forum
        ];

        $forumRelasiModel->insert($data);

        // Redirect dengan pesan sukses
        return redirect()->to('/forumKlien')->with('success', 'Berhasil bergabung ke forum.');
    }
}
