<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\OpdModel;
use App\Models\UsersModel;

class Bidang extends BaseController
{
  public function __construct()
  {
    $this->bidangModel = new BidangModel();
    $this->userModel = new UsersModel();
    $this->opdModel = new OpdModel();
  }

  /**
   * -------------------------------------------------------------------
   * insertAttempt()
   * -------------------------------------------------------------------
   * Method untuk menambah bidang oleh superadmin dan admin
   * 
   * Superadmin => Tambah semua daftar bidang
   * 
   * Admin = > Tambah bidang sesuai denga OPD Admin
   */
  public function insertAttempt()
  {
    if (session()->get('group') == 'superadmin' || 'admin') {
      $data = [
        'bidang_kode' => $this->request->getPost('bidang_kode'),
        'bidang_nama' => $this->request->getPost('bidang_nama'),
        'opd_kode' => $this->request->getPost('opd_kode')
      ];
      $this->bidangModel->insertBidang($data);
    }
    return redirect()->to('/opd/' . $data['opd_kode']);
  }

  /**
   * -------------------------------------------------------------------
   * updateAttempt()
   * -------------------------------------------------------------------
   * Method untuk update bidang oleh superadmin dan admin
   * 
   * Superadmin => Update semua daftar bidang
   * 
   * Admin = > Update bidang sesuai denga OPD Admin
   */
  public function updateAttempt()
  {
    if (session()->get('group') == 'superadmin' || 'admin') {
      $oldBidang_kode = $this->request->getPost('old_bidang');
      $data = [
        'bidang_kode' => $this->request->getPost('bidang_kode'),
        'bidang_nama' => $this->request->getPost('bidang_nama'),
      ];

      $this->bidangModel->updateBidang($oldBidang_kode, $data);
    }
    return redirect()->back();
  }

  /**
   * -------------------------------------------------------------------
   * delete()
   * -------------------------------------------------------------------
   * Method untuk delete bidang oleh superadmin dan admin
   * 
   */
  public function delete(string $bidang_kode)
  {
    if (session()->get('group') == 'superadmin' || (session()->get('group') == 'admin')) {
      $this->bidangModel->deleteBidang($bidang_kode);
    }
    return redirect()->to('controller listBidang');
  }
  /**
   * -------------------------------------------------------------------
   * update()
   * -------------------------------------------------------------------
   * Method untuk delete bidang oleh superadmin dan admin
   * 
   */

  public function update()
  {
    $bidang_kode = $this->request->getPost('bidang_kode');
    $bidang = $this->bidangModel->getBidang($bidang_kode);
    $modal =
      "
                <!--begin::Heading-->
                <div class='text-center mb-13'>
                    <!--begin::Title-->
                    <h1 class='mb-3'>Ubah Bidang</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class='text-muted fw-bold fs-5'>Mengubah bidang opd anda</div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Separator-->
                <!-- <div class='separator d-flex flex-center mb-8'>
                    <span class='text-uppercase bg-body fs-7 fw-bold text-muted px-3'>OR</span>
                </div> -->
                <!--end::Separator-->
                <form method='POST' action='/bidang/update'>
                    <!-- form input -->
                    <div class='mb-10'>
                        <!-- Begin Nama Acara -->
                        <input class='form-control form-control-solid mb-8' type='text' placeholder='Kode Bidang' name='bidang_kode' value='" . $bidang['bidang_kode'] . "' required>
                        <!-- End Nama Acara -->
                        <!-- Begin Nama Acara -->
                        <input class='form-control form-control-solid mb-8' type='text' placeholder='Nama Bidang' name='bidang_nama' value='" . $bidang['bidang_nama'] . "' required>
                        <!-- End Nama Acara -->
                        <!-- Begin Nama Acara -->
                        <input class='form-control form-control-solid mb-8' type='hidden' value='" . $bidang['bidang_kode'] . "' name='old_bidang'>
                        <!-- End Nama Acara -->
                    </div>
                    <!--begin::Notice-->
                    <div class='d-flex flex-stack'>
                        <!--begin::Label-->
                        <div class='me-5 fw-bold'>
                            <label class='fs-6'>Cek terlebih dahulu</label>
                            <div class='fs-7 text-muted'>Pastikan data yang dimasukkan sesuai dengan bidang yang ada di OPD.</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class='form-check form-switch form-check-custom form-check-solid'>
                            <button type='submit' class='btn btn-primary'>Ubah</button>
                        </label>
                </form>
                <!--end::Switch-->
    ";
    $data = [
      'modal' => $modal,
    ];
    $response = json_encode($data);
    return $response;
  }
}
