<?php

namespace App\Controllers;

use App\Models\catatanModel;

class catatanController extends BaseController {
    public function addCatatan() {
        helper('form');

        $catatan = $this->request->getPost('isi_catatan');

        $catatanModel = new catatanModel();

        // Set timezone ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');

        // Format waktu saat ini
        $tanggalDibuat = date('Y-m-d H:i');

        $catatanModel->insert([
            'tanggal_dibuat' => $tanggalDibuat,
            'isi_catatan' => $catatan
        ]);

        return redirect()->to('/jejakPerasaan');
    }
}
