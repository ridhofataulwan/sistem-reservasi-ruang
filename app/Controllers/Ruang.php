<?php

namespace App\Controllers;

use App\Models\OpdModel;
use App\Models\RuangModel;
use App\Models\UsersModel;
use App\Models\GedungModel;

class Ruang extends BaseController
{
  public function __construct()
  {
    $this->ruangModel = new RuangModel();
    $this->usersModel = new UsersModel();
    $this->gedungModel = new GedungModel();
    $this->opdModel = new OpdModel();
  }

  /**
   * -------------------------------------------------------------------
   * listRuang()
   * -------------------------------------------------------------------
   * Controller untuk menampilkan list ruang oleh semua user
   * 
   * NOTE: $ruang['allowUpdate'] merupakan data tambahan yang DISEMATKAN
   * PADA SETIAP RUANG. Variable ini digunakan untuk cek apakah user merupakan
   * user yang diperbolehkan untuk melakukan update dan delete ruang tersebut.
   * Variable ini dapat digunakan di bagian frontend
   * 
   * Superadmin -> bisa update dan delete semua ruang
   * 
   * Admin -> bisa update dan delete HANYA ruang dalam satu opd dengan admin
   * 
   * PNS -> user umum tidak bisa melakukan update maupun delete
   * 
   * $ruang['allowUpdate] dapat digunakan untuk conditional menampilkan tombol update dan delete
   * pada halaman frontend, sehingga tombol update dan delete hanya tampil pada user dengan role tertentu
   */
  public function listRuang()
  {
    //Semua daftar ruang dapat diedit oleh superadmiin
    $data = [
      'opd' => $this->opdModel->getOpd(),
    ];
    $allRuang = $this->ruangModel->getRuang();
    $data['list_ruang'] = [];

    if (session()->get('group') == 'superadmin') {

      foreach ($allRuang as $ruang) {
        $ruang['allowUpdate'] = true;
        array_push($data['list_ruang'], $ruang);
      }

      $data['title'] = 'Daftar Ruang';
      $data['gedung'] = $this->gedungModel->getGedungByOpd(session()->get('opd_kode'));

      return view('/pages/list.ruangan.field.php', $data);

      //Pada saat admin melihat daftar ruang,
      //Ruang yang ada di opd admin, akan muncul tombol edit,
      //Yang bukan opd sesuai admin, tidak dimucnulkan tombol edit
    } else if (session()->get('group') == 'admin') {
      //Tentukan opd dari admin
      $admin = $this->usersModel->getUsers(session()->get('nip'));
      $opdAdmin = $admin['opd_kode'];

      //Ambil semua data ruang
      $allRuang = $this->ruangModel->getRuang();

      //Menyiapkan array untuk dikirimkan ke frontend
      $data['title'] = 'List Ruang';
      $data['gedung'] = $this->gedungModel->getGedungByOpd($opdAdmin);

      //Filter supaya hanya ruang yang memiliki opd sama dengan admin yang diberikan tombol edit
      foreach ($allRuang as $ruang) {
        if ($ruang['opd_kode'] == $opdAdmin) {
          $ruang['allowUpdate'] = true;
        } else {
          $ruang['allowUpdate'] = false;
        }
        array_push($data['list_ruang'], $ruang);
      }
      // dd($data['list_ruang']);
      return view('/pages/list.ruangan.field.php', $data);
    }

    //Untuk PNS jika melihat semua daftar ruang
    $user = $this->usersModel->getUsers(session()->get('nip'));
    $opdUser = $user['opd_kode'];
    //Maka tidak akan muncul tombol edit
    $allRuang = $this->ruangModel->getRuang();
    $data['list_ruang'] = [];
    $data['title'] = 'Daftar Ruang';
    $data['gedung'] = $this->gedungModel->getGedungByOpd($opdUser);
    foreach ($allRuang as $ruang) {
      $ruang['allowUpdate'] = false;
      array_push($data['list_ruang'], $ruang);
    }
    return view('/pages/list.ruangan.field.php', $data);
  }

  /**
   * -------------------------------------------------------------------
   * insertAttempt()
   * -------------------------------------------------------------------
   * Controller untuk insert data ruang ke tabel lib_ruang
   * 
   * Hanya superadmin dan admin yang bisa menambah ruang.
   */
  public function insertAttempt()
  {
    if (session()->get('group') != 'user') {
      $data = [
        'ruang_kode' => $this->request->getPost('ruang_kode'),
        'ruang_nama' => $this->request->getPost('ruang_nama'),
        'ruang_deskripsi' => $this->request->getPost('ruang_deskripsi'),
        'ruang_kapasitas' => $this->request->getPost('ruang_kapasitas'),
        'gedung_kode' => $this->request->getPost('gedung_kode')
      ];
      $this->ruangModel->insertRuang($data);
    }

    return redirect()->to('/daftar-ruang');
  }

  /**
   * -------------------------------------------------------------------
   * updateAttempt()
   * -------------------------------------------------------------------
   * Controller untuk update data ruang ke tabel lib_ruang
   * 
   * Hanya superadmin dan admin yang bisa update ruang.
   */
  public function updateAttempt($ruang_kode)
  {
    if (session()->get('group') != 'user') {
      $data = [
        'ruang_kode' => $this->request->getPost('ruang_kode'),
        'ruang_nama' => $this->request->getPost('ruang_nama'),
        'ruang_deskripsi' => $this->request->getPost('ruang_deskripsi'),
        'ruang_kapasitas' => $this->request->getPost('ruang_kapasitas'),
        'gedung_kode' => $this->request->getPost('gedung_kode')
      ];

      $this->ruangModel->updateRuang($ruang_kode, $data);
    }
    return redirect()->to('/daftar-ruang');
  }

  /**
   * -------------------------------------------------------------------
   * delete()
   * -------------------------------------------------------------------
   * Controller untuk delete data ruang ke tabel lib_ruang
   * 
   * Hanya superadmin dan admin yang bisa delete ruang.
   */
  public function deleteRuang($ruang_kode)
  {
    $ruang =  $this->ruangModel->getRuang($ruang_kode);

    $admin = $this->usersModel->getUsers(session()->get('nip'));
    $opdAdmin = $admin['opd_kode'];

    //Jika dia superadmin atau jika dia adalah admin ber-opd sama dengan opd ruang, bisa delete
    if (session()->get('group') == 'superadmin' || (session()->get('group') == 'admin' && $ruang['opd_kode'] == $opdAdmin)) {
      $this->ruangModel->deleteRuang($ruang_kode);
      return redirect()->to('/daftar-ruang');
    }

    //Jika PNS atau admin yang opd nya berbeda dengan opd_kode nya ruang, langsung ke sini dan tidak delete
    return redirect()->to('/daftar-ruang');
  }

  /**
   * -------------------------------------------------------------------
   * showRuang()
   * -------------------------------------------------------------------
   * Menampilkan showRuang untuk keperluan Select menggunakan Ajax
   */
  public function showRuang()
  {
    $gedung_kode   = $this->request->getPost('gedung_kode');
    $result     = $this->ruangModel->getRuangByGedung($gedung_kode);
    if (session()->get('group') != 'user') {
      foreach ($result as $ruang) {
        if ($ruang['opd_kode'] == session()->get('opd_kode') || session()->get('group') == 'superadmin') {
          $actionButton = "
        <a href='#' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-ruang' id='" . $ruang['ruang_kode'] . "'>
        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
        <span class='svg-icon svg-icon-3'>
            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                <path opacity='0.3' d='M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z' fill='black' />
                <path d='M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z' fill='black' />
            </svg>
        </span>
        <!--end::Svg Icon-->
        </a>
        <a href='#' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm'>
            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
            <span class='svg-icon svg-icon-3'>
                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                    <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black' />
                    <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black' />
                    <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black' />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </a>";
        } else {
          $actionButton = "";
        }
        $tr[] = "
        <tr>
          <td>
            <a href='#' class='text-dark fw-bolder text-hover-primary fs-6' data-bs-toggle='modal' data-bs-target='" . $ruang['ruang_kode'] . "'>" . $ruang['ruang_kode'] . "</a>
          </td>
          <td>
            <a href='#' class='text-dark fw-bolder text-hover-primary d-block mb-1 fs-6'>" . $ruang['ruang_nama'] . "</a>
          </td>
          <td class='text-dark fw-bolder text-hover-primary fs-6'>" . $ruang['ruang_kapasitas'] . "</td>
          <td class='text-end'>
            <a href='#' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 detail-ruang' id='" . $ruang['ruang_kode'] . "'>
              <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
              <span class='svg-icon svg-icon-3'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                <path opacity='0.8' d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z' fill='black' />
                <path opacity='0.8' d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z' fill='black' />
                </svg>
              </span>
              <!--end::Svg Icon-->
            </a>
            " . $actionButton . "
          </td>
        </tr>";
      }
    } else {
      $tr = [];
      foreach ($result as $ruang) {
        $tr[] = "
        <tr>
          <td>
            <a href='#' class='text-dark fw-bolder text-hover-primary fs-6' data-bs-toggle='modal' data-bs-target='" . $ruang['ruang_kode'] . "'>" . $ruang['ruang_kode'] . "</a>
          </td>
          <td>
            <a href='#' class='text-dark fw-bolder text-hover-primary d-block mb-1 fs-6'>" . $ruang['ruang_nama'] . "</a>
          </td>
          <td class='text-dark fw-bolder text-hover-primary fs-6'>" . $ruang['ruang_kapasitas'] . "</td>
          <td class='text-end'>
            <a href='#' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 detail-ruang' id='" . $ruang['ruang_kode'] . "'>
              <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
              <span class='svg-icon svg-icon-3'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                <path opacity='0.8' d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z' fill='black' />
                <path opacity='0.8' d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z' fill='black' />
                </svg>
              </span>
              <!--end::Svg Icon-->
            </a>
          </td>
        </tr>";
      }
    }

    $data = [
      'tr' => $tr,
      'count' => count($result),
    ];
    $response = json_encode($data);
    return $response;
  }

  public function showRuangOpd()
  {
    $opd_kode   = $this->request->getPost('opd_kode');
    $result     = $this->ruangModel->getRuangByOpd($opd_kode);
    if (session()->get('group') != 'user') {
      foreach ($result as $ruang) {
        if ($ruang['opd_kode'] == session()->get('opd_kode') || session()->get('group') == 'superadmin') {
          $actionButton = "
        <a href='#' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-ruang' id='" . $ruang['ruang_kode'] . "'>
        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
        <span class='svg-icon svg-icon-3'>
            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                <path opacity='0.3' d='M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z' fill='black' />
                <path d='M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z' fill='black' />
            </svg>
        </span>
        <!--end::Svg Icon-->
        </a>
        <a href='#' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm'>
            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
            <span class='svg-icon svg-icon-3'>
                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                    <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black' />
                    <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black' />
                    <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black' />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </a>";
        } else {
          $actionButton = "";
        }
        $tr[] = "
        <tr>
          <td>
            <a href='#' class='text-dark fw-bolder text-hover-primary fs-6' data-bs-toggle='modal' data-bs-target='" . $ruang['ruang_kode'] . "'>" . $ruang['ruang_kode'] . "</a>
          </td>
          <td>
            <a href='#' class='text-dark fw-bolder text-hover-primary d-block mb-1 fs-6'>" . $ruang['ruang_nama'] . "</a>
          </td>
          <td class='text-dark fw-bolder text-hover-primary fs-6'>" . $ruang['ruang_kapasitas'] . "</td>
          <td class='text-end'>
            <a href='#' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 detail-ruang' id='" . $ruang['ruang_kode'] . "'>
              <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
              <span class='svg-icon svg-icon-3'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                <path opacity='0.8' d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z' fill='black' />
                <path opacity='0.8' d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z' fill='black' />
                </svg>
              </span>
              <!--end::Svg Icon-->
            </a>
            " . $actionButton . "
          </td>
        </tr>";
      }
    } else {
      $tr = [];
      foreach ($result as $ruang) {
        $tr[] = "
        <tr>
          <td>
            <a href='#' class='text-dark fw-bolder text-hover-primary fs-6' data-bs-toggle='modal' data-bs-target='" . $ruang['ruang_kode'] . "'>" . $ruang['ruang_kode'] . "</a>
          </td>
          <td>
            <a href='#' class='text-dark fw-bolder text-hover-primary d-block mb-1 fs-6'>" . $ruang['ruang_nama'] . "</a>
          </td>
          <td class='text-dark fw-bolder text-hover-primary fs-6'>" . $ruang['ruang_kapasitas'] . "</td>
          <td class='text-end'>
            <a href='#' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 detail-ruang' id='" . $ruang['ruang_kode'] . "'>
              <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
              <span class='svg-icon svg-icon-3'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                <path opacity='0.8' d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z' fill='black' />
                <path opacity='0.8' d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z' fill='black' />
                </svg>
              </span>
              <!--end::Svg Icon-->
            </a>
          </td>
        </tr>";
      }
    }

    $data = [
      'tr' => $tr,
      'count' => count($result),
    ];
    $response = json_encode($data);
    return $response;
  }
  /**
   * -------------------------------------------------------------------
   * detailRuang()
   * -------------------------------------------------------------------
   * Menampilkan detailRuang menggunakan Ajax
   */
  public function detailRuang()
  {
    $ruang_kode = $this->request->getPost('ruang_kode');
    $ruang      = $this->ruangModel->getRuang($ruang_kode);
    $modal = "
    <!--begin::Heading-->
      <div class='text-center mb-13'>
          <!--begin::Title-->
          <h1 class='mb-3'>Detail Ruangan</h1>
          <!--end::Title-->
      </div>
      <!--end::Heading-->
      <!--begin::Separator-->
      <!-- <div class='separator d-flex flex-center mb-8'>
          <span class='text-uppercase bg-body fs-7 fw-bold text-muted px-3'>OR</span>
      </div> -->
      <!--end::Separator-->
        <div class='mb-10'>
          <!-- Begin::Ruang Kode -->
          <span class='text-muted fs-7'>
            Kode Ruang
          </span>
          <input class='form-control form-control-solid mb-3' type='text' placeholder='Kode Ruang' name='ruang_kode' value='" . $ruang['ruang_kode'] . "' disabled>
          <!-- End::Ruang Kode -->
          <!-- Begin::Nama Ruang -->
          <span class='text-muted fs-7'>
            Nama Ruang
          </span>
          <input class='form-control form-control-solid mb-3' type='text' placeholder='Nama Ruangan' name='ruang_nama' value='" . $ruang['ruang_nama'] . "' disabled>
          <!-- End::Nama Ruang -->
          <!-- Begin::Deskripsi Ruang -->
          <span class='text-muted fs-7'>
            Deskripsi Ruang
          </span>
          <textarea class='form-control form-control-solid mb-3' type='text' placeholder='Deskripsi ruang' name='ruang_deskripsi' disabled>" . $ruang['ruang_deskripsi'] . "</textarea>
          <!-- End::Deskripsi Ruang -->
          <!-- Begin::Kapasitas Ruang -->
          <span class='text-muted fs-7'>
            Kapasitas Ruang
          </span>
          <input class='form-control form-control-solid mb-3' type='number' min='1' onkeypress='return event.charCode >= 48' placeholder='Kapasitas Ruangan' name='ruang_kapasitas' value='" . $ruang['ruang_kapasitas'] . "' disabled>
          <!-- End::Kapasitas Ruang -->
          <!--begin::Gedung kode-->
          <span class='text-muted fs-7'>
            Kode Gedung
          </span>
          <div class='mb-3'>
              <select name='gedung_kode' class='form-select form-select-solid form-select-md' data-control='select2' data-hide-search='true' disabled>
                  <option class value='' selected>" . $ruang['gedung_kode'] . "</option>
              </select>
          </div>
          <!--end::Gedung Kode-->
        </div>
      </div>
    <!--end::Modal body-->";
    $data = [
      'modal' => $modal,
      'ruang_kode' => $ruang_kode,
    ];
    $response = json_encode($data);
    return $response;
  }
  /**
   * -------------------------------------------------------------------
   * editRuang()
   * -------------------------------------------------------------------
   * Menampilkan editRuang menggunakan Ajax
   */
  public function editRuang()
  {
    $ruang_kode = $this->request->getPost('ruang_kode');
    $ruang      = $this->ruangModel->getRuang($ruang_kode);
    $gedung      = $this->gedungModel->getGedungByOpd(session()->get('opd_kode'));
    foreach ($gedung as $g) {
      $option[] = "<option class value='" . $g['gedung_kode'] . "'>" . $g['gedung_nama'] . "</option>";
    }
    $modal = "
    <!--begin::Heading-->
                <div class='text-center mb-13'>
                    <!--begin::Title-->
                    <h1 class='mb-3'>Edit Ruangan</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class='text-muted fw-bold fs-5'>Sebelum mengedit ruangan pastikan sudah ada data
                        <a href='/daftar-gedung' class='link-primary fw-bolder'>Gedung</a>.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Separator-->
                <!-- <div class='separator d-flex flex-center mb-8'>
                    <span class='text-uppercase bg-body fs-7 fw-bold text-muted px-3'>OR</span>
                </div> -->
                <!--end::Separator-->
                <form method='POST' action='ruang/update/" . $ruang['ruang_kode'] . "'>
                    <!-- form input -->
                    <div class='mb-10'>
                      <!-- Begin::Ruang Kode -->
                      <input class='form-control form-control-solid mb-8' type='text' placeholder='Kode Ruang' name='ruang_kode' value='" . $ruang['ruang_kode'] . "'>
                      <!-- End::Ruang Kode -->
                      <!-- Begin::Nama Ruang -->
                      <input class='form-control form-control-solid mb-8' type='text' placeholder='Nama Ruangan' name='ruang_nama' value='" . $ruang['ruang_nama'] . "'>
                      <!-- End::Nama Ruang -->
                      <!-- Begin::Deskripsi Ruang -->
                      <textarea class='form-control form-control-solid mb-8' type='text' placeholder='Deskripsi ruang' name='ruang_deskripsi'>" . $ruang['ruang_deskripsi'] . "</textarea>
                      <!-- End::Deskripsi Ruang -->
                      <!-- Begin::Kapasitas Ruang -->
                      <input class='form-control form-control-solid mb-8' type='number' min='1' onkeypress='return event.charCode >= 48' placeholder='Kapasitas Ruangan' name='ruang_kapasitas' value='" . $ruang['ruang_kapasitas'] . "'>
                      <!-- End::Kapasitas Ruang -->
                      <!--begin::Gedung kode-->
                      <div class='mb-8'>
                          <select name='gedung_kode' class='form-select form-select-solid form-select-md' data-control='select2' data-hide-search='true' id='select-gedung'>
                          </select>
                      </div>
                      <!--end::Gedung Kode-->
                    </div>
                    <!--begin::Notice-->
                    <div class='d-flex flex-stack'>
                        <!--begin::Label-->
                        <div class='me-5 fw-bold'>
                            <label class='fs-6'>Cek terlebih dahulu</label>
                            <div class='fs-7 text-muted'>Pastikan data ruangan yang dimasukkan sesuai dengan ruangan yang ada</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class='form-check form-switch form-check-custom form-check-solid'>
                            <button type='submit' class='btn btn-primary'>Edit</button>
                        </label>
                </form>
                <!--end::Switch-->
            </div>
            <!--end::Notice-->
        </div>
        <!--end::Modal body-->";
    $data = [
      'modal' => $modal,
      'ruang_kode' => $ruang_kode,
      'option' => $option,
    ];
    $response = json_encode($data);
    return $response;
  }

  /**
   * -------------------------------------------------------------------
   * selectRuang()
   * -------------------------------------------------------------------
   * Menampilkan selectRuang untuk keperluan Select menggunakan Ajax
   */
  public function selectRuang()
  {
    $gedung_kode   = $this->request->getPost('gedung_kode');
    $result     = $this->ruangModel->getRuangByGedung($gedung_kode);
    if ($result != false) {
      echo "<option value=''>--- Pilih Ruang ---</option>";
      foreach ($result as $ruang) {
        echo "<option value=" . $ruang['ruang_kode'] . ">" . $ruang["ruang_nama"] . "</option>";
      };
    } else {
      echo "<option value='' disabled>Ruang belum tersedia</option>";
    }
  }
}
