<?php

namespace App\Controllers;

use App\Models\AcaraModel;
use App\Controllers\BaseController;
use App\Models\UsersModel;

class Acara extends BaseController
{
    public function __construct()
    {
        $this->acaraModel = new AcaraModel();
        $this->usersModel = new UsersModel();
    }

    /**
     * -------------------------------------------------------------------
     * listAcara()
     * -------------------------------------------------------------------
     * Method untuk menampilkan list acara oleh superadmin
     * 
     * Jika admin atau user biasa akses, maka yang ditampilkan adalah daftar acara
     * yang sesuai dengan opd mereka
     */
    public function listAcara()
    {
        $listAcara = $this->acaraModel->getAcara();
        if (session()->get('group') == 'superadmin') {
            $data = [
                'title' => 'Daftar Acara',
                'listacara' => $listAcara,
                'jenis_acara' => $this->acaraModel->getJenisAcara()
            ];
            return view('/pages/list.acara.field.php', $data);
        } else { //Untuk admin dan user biasa
            //Perlu tahu dulu, yang login berasal dari OPD mana
            $user = $this->usersModel->getUsers(session()->get('nip'));
            $opdUser = $user['opd_kode'];

            //Array untuk simpan daftar acara
            $sortedAcara = [];

            //Filter. Acara yang dibuat oleh user yang berasal dari opd yang sama dengan yang sedang login
            foreach ($listAcara as $acara) {
                if ($acara['opd_kode'] == $opdUser) {
                    array_push($sortedAcara, $acara);
                }
            }
            $data = [
                'title' => 'Daftar Acara',
                'listacara' => $sortedAcara,
                'jenis_acara' => $this->acaraModel->getJenisAcara()
            ];
            return view('/pages/list.acara.field.php', $data);
        }
    }

    /**
     * -------------------------------------------------------------------
     * acara($acara_id) DETAIL
     * -------------------------------------------------------------------
     * Method untuk menampilkan satu acara
     */
    public function detail(string $acara_id = '')
    {
        $data['acara'] = $this->acaraModel->getAcara($acara_id);
        $data['jenis_acara'] = $this->acaraModel->getJenisAcara();
        $data['title'] = 'Detail Acara';
        return view('/pages/detail.acara.field.php', $data);
    }

    /**
     * -------------------------------------------------------------------
     * insertAttempt()
     * -------------------------------------------------------------------
     * Method untuk insert Acara pada database
     * 
     * Setiap group memiliki fitur ini
     */
    public function insertAttempt()
    {
        $data = [
            'acara_nama'            => $this->request->getPost('acara_nama'),
            'users_nip'             => session()->get('nip'),
            'jenis_acara_kode'      => $this->request->getPost('jenis_acara_kode'),
            'acara_keterangan'      => $this->request->getPost('acara_keterangan'),
            'acara_jumlah_peserta'  => $this->request->getPost('acara_jumlah_peserta'),
            'status_acara_kode'     => $this->request->getPost('status_acara_kode'),
        ];
        $this->acaraModel->insertAcara($data);
        return redirect()->to('/daftar-acara');
    }

    /**
     * -------------------------------------------------------------------
     * update()
     * -------------------------------------------------------------------
     * Method untuk masuk ke halaman update acara.
     * 
     * Bisa diaskes oleh semua group
     */
    public function update(string $acara_id)
    {
        $data['acara'] = $this->acaraModel->getAcara($acara_id);
        $data['jenis_acara'] = $this->acaraModel->getJenisAcara();
        $data['title'] = 'Sunting Acara';
        return view('/pages/edit.acara.field.php', $data);
    }

    /**
     * -------------------------------------------------------------------
     * updateAttempt()
     * -------------------------------------------------------------------
     * Method untuk update acara.
     * 
     * Bisa diaskes oleh semua group
     */
    public function updateAttempt(string $acara_id)
    {
        $data = [
            'acara_nama'            => $this->request->getPost('acara_nama'),
            'users_nip'             => session()->get('nip'),
            'jenis_acara_kode'        => $this->request->getPost('jenis_acara_kode'),
            'acara_keterangan'      => $this->request->getPost('acara_keterangan'),
            'acara_jumlah_peserta'  => $this->request->getPost('acara_jumlah_peserta'),
            'status_acara_kode'       => $this->request->getPost('status_acara_kode'),
        ];
        $this->acaraModel->updateAcara($acara_id, $data);
        return redirect()->to('/daftar-acara');
    }

    /**
     * -------------------------------------------------------------------
     * deleteAcara($acara_id)
     * -------------------------------------------------------------------
     * Method untuk hapus acara.
     * 
     * Bisa diaskes oleh semua group
     */
    public function deleteAcara(string $acara_id)
    {
        if (session()->get('group') == 'superadmin' || 'admin') {
            $this->acaraModel->deleteAcara($acara_id);
        }
        return redirect()->to('/daftar-acara');
    }

    /**
     * -------------------------------------------------------------------
     * setStatusAcara($acara_id)
     * -------------------------------------------------------------------
     * Method untuk set acara.
     * 
     * Bisa diaskes oleh semua group
     */
    public function setStatusAcara(string $acara_id)
    {
        $data = [
            'status_acara_kode' => $this->request->getPost('status_acara_kode'),
        ];
        $this->acaraModel->setStatusAcara($acara_id, $data);
        return redirect()->to('/daftar-acara');
    }

    /**
     * -------------------------------------------------------------------
     * setStatusAcaraAjax()
     * -------------------------------------------------------------------
     * Method untuk set status acara.
     * 
     * Bisa diaskes oleh semua group
     */
    public function setStatusAcaraAjax()
    {
        $acara_id = $this->request->getPost('acara_id');
        if ($this->request->getPost('status_acara_kode') == 1) {
            $status_acara_kode = 2;
        } else {
            $status_acara_kode = 1;
        }
        $acara = $this->acaraModel->setStatusAcaraAjax($acara_id, $status_acara_kode);
        if ($acara['status_acara_kode'] == 1) {
            $switch_button = "<input class='form-check-input status-acara' type='checkbox' role='switch' id='" . $acara['acara_id'] . "' value='" . $acara['status_acara_kode'] . "' checked><span class='badge badge-light-warning' id='badge-status-acara-'" . $acara['acara_id'] . "'>Belum Selesai</span>";
        } else {
            $switch_button = "<input class='form-check-input status-acara' type='checkbox' role='switch' id='" . $acara['acara_id'] . "' value='" . $acara['status_acara_kode'] . "'><span class='badge badge-light-success' id='badge-status-acara-'" . $acara['acara_id'] . "'>Selesai</span>";
        }
        $data = [
            'switch_button' => $switch_button
        ];
        $response = json_encode($data);
        return $response;
    }
}