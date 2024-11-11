<?php
namespace App\Controllers;

use App\Models\forumModel;
use App\Models\forum_klienModel;
use App\Models\mahasiswaModel;

class ForumController extends BaseController {
    protected $forumModel;
    protected $forumKlienModel;
    protected $mahasiswaModel;

    public function __construct() {
        // Inisialisasi model
        $this->forumModel = new forumModel();
        //$this->forumKlienModel = new forum_klienModel();
        $this->mahasiswaModel = new mahasiswaModel();
    }

    // Halaman utama CRUD Forum
    public function index() {
        $forums = $this->forumModel->getAllForums();
        $mahasiswa = $this->mahasiswaModel->find(session()->get('kd_mahasiswa'));

        // Mengirim data ke view
        return view('CRUD_Forum', [
            'forums' => $forums,
            'mahasiswa' => $mahasiswa
        ]);
    }

    // Menambah forum baru
    public function addForum() {
        // Validasi input
        if (!$this->validate([
            'nama_forum' => 'required|min_length[3]',
            'kategori_forum' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|valid_date',
            'jumlah_peserta' => 'required|numeric|greater_than[0]',
            'foto' => 'uploaded[foto]|is_image[foto]|max_size[foto,2048]'
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'nama_forum' => $this->request->getPost('nama_forum'),
            'kategori_forum' => $this->request->getPost('kategori_forum'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah_peserta' => $this->request->getPost('jumlah_peserta'),
            'foto' => $this->request->getFile('foto')->getName(),
        ];

        // Upload file
        $foto = $this->request->getFile('foto');
        if ($foto->isValid() && !$foto->hasMoved()) {
            $foto->move('uploads/forum/', $data['foto']);
        } else {
            return redirect()->back()->with('error', 'Gagal mengunggah foto');
        }

        $this->forumModel->addForum($data);
        return redirect()->to('/forum')->with('success', 'Forum berhasil ditambahkan');
    }

    public function deleteForum($kode_forum) {
        // Pastikan forum ada
        $forum = $this->forumModel->find($kode_forum);
        if (!$forum) {
            return redirect()->to('/forum')->with('error', 'Forum tidak ditemukan');
        }
    
        // Hapus forum
        $this->forumModel->deleteForum($kode_forum);
        return redirect()->to('/forum')->with('success', 'Forum berhasil dihapus');
    }
    

    // Menghapus anggota forum
    public function removeAnggota($kode_forum, $kd_klien) {
        $this->forumKlienModel->removeAnggotaFromForum($kode_forum, $kd_klien);
        return redirect()->to('/forum')->with('success', 'Anggota berhasil dihapus dari forum');
    }
}
