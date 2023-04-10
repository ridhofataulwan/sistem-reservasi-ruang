<?php

namespace App\Controllers;

use App\Models\OpdModel;
use App\Models\UsersModel;
use App\Models\AcaraModel;
use App\Models\BidangModel;

class Opd extends BaseController
{
  public function __construct()
  {
    //Model tabel opd dan tabel user
    $this->opdModel = new OpdModel();
    $this->usersModel = new UsersModel();
    $this->acaraModel = new AcaraModel();
    $this->bidangModel = new BidangModel();
  }

  /**
   * -------------------------------------------------------------------
   * listOpd()
   * -------------------------------------------------------------------
   * Controller untuk menampilkan list opd oleh superadmin
   */
  public function listOpd()
  {
    if (session()->get('group') == 'superadmin') {
      $data = [
        'title' => 'Daftar OPD',
        'listopd' => $this->opdModel->getOpd(),
      ];
      return view('/pages/list.opd.field.php', $data);
    }
    //klo ada role admin/PNS yang coba akses
    return redirect()->to('/dashboard');
  }

  /**
   * -------------------------------------------------------------------
   * opd($opd_kode) DETAIL
   * -------------------------------------------------------------------
   * Controller untuk menampilkan satu opd
   * 
   * Jika param $opd_kode tidak diisi, berarti dia adalah admin.
   * Admin hanya bisa melihat OPD sesuai dengan OPD admin
   * 
   * Jika admin memiliki $opd_kode dari opd lain,
   * maka akan langsung dikembalikan ke halaman dashboard
   * 
   * Jika param $opd_kode diisi dan dia superadmin, maka bisa melihat data OPD
   * sesuai $opd_kode.
   */
  public function detail(string $opd_kode = '')
  {
    $data['jenis_acara'] = $this->acaraModel->getJenisAcara();
    $data['title'] = 'Detail OPD';

    if ($opd_kode == '') { //detail profile opd sendiri (sesuai admin/superadmin)
      if (session()->get('group') != 'user') {
        //Cari tau, admin/superadmin yang login opd nya apa
        $admin = $this->usersModel->getUsers(session()->get('nip'));
        $opdAdmin = $admin['opd_kode'];

        //Ambil opd sesuai opd admin/superadmin
        $data['opd'] = $this->opdModel->getOpd($opdAdmin);

        //Data bidang
        $data['bidang'] = $this->bidangModel->getBidangByOPD($opdAdmin);

        return view('/pages/detail.opd.field.php', $data);
      }
    } else if (session()->get('group') == 'superadmin') {
      $data['opd'] = $this->opdModel->getOpd($opd_kode);
      $data['bidang'] = $this->bidangModel->getBidangByOPD($opd_kode);
      return view('/pages/detail.opd.field.php', $data);
    }

    return redirect()->to('/dashboard');
  }

  /**
   * -------------------------------------------------------------------
   * insert()
   * -------------------------------------------------------------------
   * Controller untuk masuk ke halaman insert opd.
   * Hanya bisa dibuka oleh superadmin
   * 
   */
  public function insert()
  {
    if (session()->get('group') == 'superadmin') {
      $data['title'] = 'Tambah OPD';
      return view('halaman tambah opd', $data);
    }
    return redirect()->to('/dashboard');
  }

  /**
   * -------------------------------------------------------------------
   * insertAttempt()
   * -------------------------------------------------------------------
   * Controller untuk insert ke opd.
   * Otomatis hanya bisa dibuka oleh superadmin
   * 
   */
  public function insertAttempt()
  {
    $data = [
      'opd_kode' => $this->request->getPost('opd_kode'),
      'opd_nama' => $this->request->getPost('opd_nama'),
      'opd_email' => $this->request->getPost('opd_email'),
      'opd_alamat' => $this->request->getPost('opd_alamat'),
      'opd_telp' => $this->request->getPost('opd_telp')
    ];
    $this->opdModel->insertOpd($data);
    return redirect()->to('/daftar-opd');
  }


  /**
   * -------------------------------------------------------------------
   * updateAttempt()
   * -------------------------------------------------------------------
   * Controller untuk update opd.
   * Hanya bisa dibuka oleh superadmin dan admin.
   * 
   * Superadmin -> bisa update OPD manapun berdasarkan $opd_kode
   * 
   * Admin -> otomatis hanya bisa mleakukan update OPD admin
   * 
   * PNS -> otomatis tidak bisa masuk sini
   */
  public function updateAttempt(string $opd_kode)
  {
    $data = [
      'opd_kode' => $this->request->getPost('opd_kode'),
      'opd_nama' => $this->request->getPost('opd_nama'),
      'opd_email' => $this->request->getPost('opd_email'),
      'opd_alamat' => $this->request->getPost('opd_alamat'),
      'opd_telp' => $this->request->getPost('opd_telp')
    ];
    $this->opdModel->updateOpd($opd_kode, $data);
    return redirect()->to('/daftar-opd');
  }

  /**
   * -------------------------------------------------------------------
   * deleteOpd($opd_kode)
   * -------------------------------------------------------------------
   * Controller untuk hapus opd.
   * Hanya bisa diakses oleh superadmin
   */
  public function deleteOpd(string $opd_kode)
  {
    if (session()->get('group') == 'superadmin') {
      $this->opdModel->deleteOpd($opd_kode);
    }
    return redirect()->to('/daftar-opd');
  }

  /**
   * -------------------------------------------------------------------
   * showOpd()
   * -------------------------------------------------------------------
   * Menampilkan showOpd untuk keperluan Select menggunakan Ajax
   */
  public function showOpd()
  {
    $opd_kode   = $this->request->getPost('opd_kode');
    $result     = $this->opdModel->getOpdByOpdKode($opd_kode);
    $opd = $result;
    if (!$opd['opd_alamat']) {
      $opd['opd_alamat'] = 'Alamat belum tersedia';
    }
    if (!$opd['opd_email']) {
      $opd['opd_email'] = 'Email belum tersedia';
    }
    if (!$opd['opd_telp']) {
      $opd['opd_telp'] = 'Telepon belum tersedia';
    }
    $div = "
    <!--begin::Navs-->
      <div class='col-8 mb-2'>
      <h2>" . $opd['opd_nama'] . "</h2>
      </div>
      <a class='text-dark'>" . $opd['opd_alamat'] . "</a>
      <div class='d-flex overflow-auto pb-5'>
        <div class='text-muted'>
          <a href='#'>" . $opd['opd_email'] . "</a>
          <span class='mx-2'>|</span>
          <a href='#'>" . $opd['opd_telp'] . "</a>
        </div>
      </div>
    <!--begin::Navs-->
    ";
    echo $div;
  }

  public function editOpd()
  {
    $opd_kode = $this->request->getPost('opd_kode');
    $opd = $this->opdModel->getOpdByOpdKode($opd_kode);
    $modal =
      "
    <!--begin::Heading-->
                <div class='text-center mb-13'>
                    <!--begin::Title-->
                    <h1 class='mb-3'>Edit OPD</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class='text-muted fw-bold fs-5'>Pastikan data OPD sudah benar sebelum disimpan.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Separator-->
                <!-- <div class='separator d-flex flex-center mb-8'>
                    <span class='text-uppercase bg-body fs-7 fw-bold text-muted px-3'>OR</span>
                </div> -->
                <!--end::Separator-->
                <form method='POST' action='/opd/update/" . $opd['opd_kode'] . "'>
                    <!-- form input -->
                    <div class='mb-10'>
                        <!-- Begin::Kode OPD -->
                        <input class='form-control form-control-solid mb-8' type='text' placeholder='Kode OPD' name='opd_kode' required value='" . $opd['opd_kode'] . "'>
                        <!-- End::Kode OPD -->
                        <!-- Begin::Nama OPD -->
                        <input class='form-control form-control-solid mb-8' type='text' placeholder='Nama OPD' name='opd_nama' required value='" . $opd['opd_nama'] . "'>
                        <!-- End::Nama OPD -->
                        <!-- Begin::Email OPD -->
                        <input class='form-control form-control-solid mb-8' type='email' placeholder='Email OPD' name='opd_email' required value='" . $opd['opd_email'] . "'>
                        <!-- End::Email OPD -->
                        <!-- Begin::Telp OPD -->
                        <input class='form-control form-control-solid mb-8' type='text' placeholder='Telp OPD' name='opd_telp' required value='" . $opd['opd_telp'] . "'>
                        <!-- End::Telp OPD -->
                        <!-- Begin::Telp OPD -->
                        <input class='form-control form-control-solid mb-8' type='text' placeholder='Alamat OPD' name='opd_alamat' required value='" . $opd['opd_alamat'] . "'>
                        <!-- End::Telp OPD -->
                    </div>
                    <!--begin::Notice-->
                    <div class='d-flex flex-stack'>
                        <!--begin::Label-->
                        <div class='me-5 fw-bold'>
                            <label class='fs-6'>Cek terlebih dahulu</label>
                            <div class='fs-7 text-muted'>Pastikan data yang anda masukan sudah benar</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class='form-check form-switch form-check-custom form-check-solid'>
                            <button type='submit' class='btn btn-primary'>Simpan Perubahan</button>
                        </label>
                </form>
                <!--end::Switch-->
            </div>
            <!--end::Notice-->
    ";
    $data = [
      'modal' => $modal,
    ];
    $response = json_encode($data);
    return $response;
  }
}
