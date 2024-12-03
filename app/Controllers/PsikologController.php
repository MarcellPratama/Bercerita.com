<?php

namespace App\Controllers;

use App\Models\PsikologModel;

class PsikologController extends BaseController
{
    public function dashboard()
    {
        
        $psikologModel = new PsikologModel();
        // echo '<pre>';
        // print_r(session()->get());
        // echo '</pre>';
        // exit;
        $userId = session()->get('kd_psikolog');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }


        $psikolog = $psikologModel->find($userId);

        if (!$psikolog) {
            return redirect()->to('/login')->with('error', 'Data tidak ditemukan.');
        }

        // Set nilai default jika field kosong
        $psikolog['tentang_saya'] = $psikolog['tentang_saya'] ?? '-';
        $psikolog['pendekatan_klinis'] = $psikolog['pendekatan_klinis'] ?? '-';
        $psikolog['domisili'] = $psikolog['domisili'] ?? 'Masukkan domisili Anda di sini.';

        return view('dashboardpsikolog', ['psikolog' => $psikolog]);
    }

    public function updateProfile()
    {
        $session = session();
        $userId = session()->get('kd_psikolog');
        
        $tentang_saya = $this->request->getPost('tentang_saya');
        $pendekatan_klinis = $this->request->getPost('pendekatan_klinis');
        $foto = $this->request->getFile('foto');
        
        $data = [
            'tentang_saya' => $tentang_saya,
            'pendekatan_klinis' => $pendekatan_klinis,
        ];

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads', $newName);
            $updateData['foto'] = $newName;
        }
        $psikologModel = new PsikologModel();
        $psikologModel->update($userId, $data);

        // Mengirim respons sukses
        return $this->response->setJSON(['success' => true, 'message' => 'Profil berhasil diperbarui.']);
    }
}
