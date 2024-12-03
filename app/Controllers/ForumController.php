<?php

namespace App\Controllers;

use App\Models\forumModel;

class ForumController extends BaseController
{
    protected $forumModel;

    public function __construct()
    {
        $this->forumModel = new forumModel();
    }

    public function index()
    {
        $forums = $this->forumModel->findAll();
        return view('CRUD_Forum', ['forums' => $forums]);
    }
    public function forumKlien()
    {
        $forums = $this->forumModel->findAll();
        return view('forumKlien', ['forums' => $forums]);
    }

    public function addForum()
    {
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

        $lastForum = $this->forumModel->orderBy('kode_forum', 'DESC')->first();
        if ($lastForum) {
            $lastNumber = (int) substr($lastForum['kode_forum'], 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kodeForum = 'KF' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        $foto = $this->request->getFile('foto');
        $fotoName = $foto->getName();
        if ($foto->isValid() && !$foto->hasMoved()) {
            $foto->move('uploads/forum/', $fotoName);
        }
        $this->forumModel->save([
            'kode_forum' => $kodeForum,
            'nama_forum' => $this->request->getPost('nama_forum'),
            'kategori_forum' => $this->request->getPost('kategori_forum'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah_peserta' => $this->request->getPost('jumlah_peserta'),
            'foto' => 'uploads/forum/' . $fotoName,
        ]);

        return redirect()->to('/forum')->with('success', 'Forum berhasil ditambahkan');
    }

    public function deleteForum($kode_forum)
    {
        $forum = $this->forumModel->find($kode_forum);

        if (!$forum) {
            return redirect()->to('/forum')->with('error', 'Forum tidak ditemukan');
        }

        if (!empty($forum['foto']) && file_exists($forum['foto'])) {
            unlink($forum['foto']);
        }

        $this->forumModel->delete($kode_forum);
        return redirect()->to('/forum')->with('success', 'Forum berhasil dihapus');
    }
}
