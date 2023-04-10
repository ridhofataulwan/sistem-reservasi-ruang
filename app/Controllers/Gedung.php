<?php

namespace App\Controllers;

use App\Models\GedungModel;
use App\Models\OpdModel;
use App\Models\UsersModel;

class Gedung extends BaseController
{
  public function __construct()
  {
    $this->gedungModel = new GedungModel();
    $this->usersModel = new UsersModel();
    $this->opdModel = new OpdModel();
  }

  /**
   * -------------------------------------------------------------------
   * listGedung()
   * -------------------------------------------------------------------
   * Controller untuk menampilkan list gedung oleh superadmin dan admin
   * 
   * Superadmin -> menampilkan semua gedung
   * 
   * Admin -> menampilkan HANYA gedung dalam satu opd dengan admin
   * 
   * PNS -> user umum tidak bisa melihat daftar gedung
   * 
   * $gedung['allowUpdate] dapat digunakan untuk conditional menampilkan tombol update dan delete
   * pada halaman frontend, sehingga tombol update dan delete hanya tampil pada user dengan role tertentu
   */
  public function listGedung()
  {
    //Semua daftar gedung dapat diedit oleh superadmiin
    if (session()->get('group') == 'superadmin') {
      $data = [
        'title' => 'Daftar Gedung',
        'opd' => $this->opdModel->getOpd(),
        'gedung' => $this->gedungModel->getGedung(),
      ];
      // dd($data);
      return view('/pages/list.gedung.field.php', $data);

      //Gedung yang ditampilkan kepada admin hanya gedung yang opdnya sama dengan opd admin
    } else if (session()->get('group') == 'admin') {
      //Tentukan opd dari admin
      $admin = $this->usersModel->getUsers(session()->get('nip'));
      $opdAdmin = $admin['opd_kode'];

      $data = [
        'title' => 'Daftar Gedung',
        'opd' => $this->opdModel->getOpd(),
        'opdAdmin' => $this->opdModel->getOpd($opdAdmin),
        // 'opd' => $this->opdModel->getOpdByOpdKode($opdAdmin),
        'gedung' => $this->gedungModel->getGedungByOpd($opdAdmin),
      ];
      // dd($data);
      return view('/pages/list.gedung.field.php', $data);
    }
    //User PNS biasa tidak bisa melihat daftar gedung
    return redirect()->to('/dashboard');
  }

  /**
   * -------------------------------------------------------------------
   * detail()
   * -------------------------------------------------------------------
   * Controller untuk menampilkan satu gedung.
   * 
   * Superadmin -> bisa menampilkan semua gedung
   * 
   * Admin -> bisa menampilkan gedung yang sama opd nya dengan opd admin
   * 
   * PNS -> tidak akan ada tombol update
   */
  public function detail(string $gedung_kode)
  {
    $gedung = $this->gedungModel->getGedung($gedung_kode);
    //Ambil opd si admin
    $admin = $this->usersModel->getUsers(session()->get('nip'));
    $opdAdmin = $admin['opd_kode'];

    //Jika super admin, atau admin yang opd nya sama dengan opd gedung yang dapat menampilkan detail
    if (session()->get('group') == 'superadmin' || (session()->get('group') == 'admin' && $gedung['opd_kode'] == $opdAdmin)) {
      $data = [
        'title' => 'Detail Gedung',
        'gedung' => $gedung,
      ];

      return view('', $data);
    }

    //PNS tidak bisa masuk ke halaman detail
    return redirect()->to('/dashboard');
  }

  /**
   * -------------------------------------------------------------------
   * insert()
   * -------------------------------------------------------------------
   * Controller untuk menampilkan insert data gedung ke tabel lib_gedung
   * 
   * Hanya superadmin dan admin yang bisa menambah gedung. Admin hanya bisa
   * menambah gedung dengan opd_kode sama dengan opd admin
   */
  public function insert()
  {
    if (session()->get('group') == 'superadmin') {
      $data['opd'] = $this->opdModel->getOpd(); //dipakai untuk dropdown (klo perlu data lagi bisa bilang, tulis komentar di baris bawah ini)
      return view('', $data);
    } else if ('admin') {
      //Ambil opd si admin
      $admin = $this->usersModel->getUsers(session()->get('nip'));
      $opdAdmin = $admin['opd_kode'];

      //Ambil data opd dari tabel lib_opd
      $data['opd'] = $this->opdModel->getOpd($opdAdmin); //dropdown admin isinya hanya satu, sesuai dengan opd admin
      return view('', $data);
    }
    //Jika User PNS biasa mencoba akses
    return redirect()->to('/daftar-gedung');
  }

  /**
   * -------------------------------------------------------------------
   * insertAttempt()
   * -------------------------------------------------------------------
   * Controller untuk insert data gedung ke tabel lib_gedung
   * 
   * Hanya superadmin dan admin yang bisa menambah gedung.
   */
  public function insertAttempt()
  {
    $data = [
      'gedung_kode' => $this->request->getPost('gedung_kode'),
      'gedung_nama' => $this->request->getPost('gedung_nama'),
      'opd_kode' => $this->request->getPost('opd_kode')
    ];
    $this->gedungModel->insertGedung($data);

    return redirect()->to('/daftar-gedung');
  }

  /**
   * -------------------------------------------------------------------
   * update()
   * -------------------------------------------------------------------
   * Controller untuk halmaan update data gedung ke tabel lib_gedung
   * 
   * Hanya superadmin dan admin yang bisa update gedung.
   */
  public function update($gedung_kode)
  {
    $gedung =  $this->gedungModel->getGedung($gedung_kode);

    $admin = $this->usersModel->getUsers(session()->get('nip'));
    $opdAdmin = $admin['opd_kode'];

    //Jika dia superadmin atau jika dia adalah admin ber-opd sama dengan opd gedung
    if (session()->get('group') == 'superadmin' || (session()->get('group') == 'admin' && $gedung['opd_kode'] == $opdAdmin)) {
      $data['gedung'] = $gedung;
      return view('', $data);
    }

    //Jika PNS atau admin yang opd nya berbeda dengan opd_kode nya gedung
    return redirect()->to('/daftar-gedung');
  }

  /**
   * -------------------------------------------------------------------
   * updateAttempt()
   * -------------------------------------------------------------------
   * Controller untuk update data gedung ke tabel lib_gedung
   * 
   * Hanya superadmin dan admin yang bisa update gedung.
   */
  public function updateAttempt($gedung_kode)
  {
    $data = [
      'gedung_kode' => $this->request->getPost('gedung_kode'),
      'gedung_nama' => $this->request->getPost('gedung_nama'),
      'gedung_kode' => $this->request->getPost('gedung_kode'),
      'opd_kode' => $this->request->getPost('opd_kode')
    ];

    $this->gedungModel->updateGedung($gedung_kode, $data);
    return redirect()->to('/daftar-gedung');
  }

  /**
   * -------------------------------------------------------------------
   * delete()
   * -------------------------------------------------------------------
   * Controller untuk delete data gedung ke tabel lib_gedung
   * 
   * Hanya superadmin dan admin yang bisa delete gedung.
   */
  public function deleteGedung($gedung_kode)
  {
    $gedung =  $this->gedungModel->getGedung($gedung_kode);

    $admin = $this->usersModel->getUsers(session()->get('nip'));
    $opdAdmin = $admin['opd_kode'];

    //Jika dia superadmin atau jika dia adalah admin ber-opd sama dengan opd gedung, bisa delete
    if (session()->get('group') == 'superadmin' || (session()->get('group') == 'admin' && $gedung['opd_kode'] == $opdAdmin)) {
      $this->gedungModel->deleteGedung($gedung_kode);
      return redirect()->to('/daftar-gedung');
    }

    //Jika PNS atau admin yang opd nya berbeda dengan opd_kode nya gedung, langsung ke sini dan tidak delete
    return redirect()->to('/daftar-gedung');
  }

  /**
   * -------------------------------------------------------------------
   * selectGedung()
   * -------------------------------------------------------------------
   * Menampilkan selectGedung untuk keperluan Select menggunakan Ajax
   */
  public function selectGedung()
  {
    $opd_kode   = $this->request->getPost('opd_kode');
    $result     = $this->gedungModel->getGedungByOPD($opd_kode);
    if ($result != false) {
      echo "<option value=''>--- Pilih Gedung ---</option>";
    } else {
      echo "<option value=''>Gedung belum tersedia</option>";
    }
    foreach ($result as $gedung) {
      echo "<option value=" . $gedung['gedung_kode'] . ">" . $gedung["gedung_nama"] . "</option>";
    };
  }

  /**
   * -------------------------------------------------------------------
   * showGedung()
   * -------------------------------------------------------------------
   * Menampilkan showGedung untuk keperluan Select menggunakan Ajax
   */
  public function showGedung()
  {
    $opd_kode   = $this->request->getPost('opd_kode');
    $result     = $this->gedungModel->getGedungByOPD($opd_kode);
    foreach ($result as $gedung) {
      $tr[] = "
      <tr>
        <td>
            <span class='text-dark fw-bolder text-hover-primary fs-6'>" . $gedung["gedung_kode"] . "</span>
        </td>
        <td>
            <span class='text-dark fw-bolder text-hover-primary fs-6'>" . $gedung["gedung_nama"] . "</span>
        </td>
        <td>
            <span class='text-dark fw-bolder text-hover-primary fs-6'>" . $gedung['opd_nama'] . "</span>
        </td>
        <td class='text-end'>
            <a href='#' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-gedung' id='" . $gedung['gedung_kode'] . "'>
                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                <span class='svg-icon svg-icon-3'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                        <path opacity='0.3' d='M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z' fill='black' />
                        <path d='M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z' fill='black' />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </a>
            <a href='/gedung/delete/" . $gedung['gedung_kode'] . "' class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' onclick='return confirm(" . '"Apakah anda yakin akan menghapus gedung ini?"' . ");'>
                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                <span class='svg-icon svg-icon-3'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                        <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black' />
                        <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black' />
                        <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black' />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </a>
        </td>
    </tr>";
    }
    $data = [
      'tr' => $tr,
      'count' => count($result),
    ];
    $response = json_encode($data);
    return $response;
  }

  public function editGedung()
  {
    $gedung_kode = $this->request->getPost('gedung_kode');
    $gedung = $this->gedungModel->getGedung($gedung_kode);
    $opd = $this->opdModel->getOpd();
    $opdAdmin = $this->opdModel->getOpd(session()->get('opd_kode'));
    if (session()->get('group') == 'superadmin') {
      $option[0] = "<option class value='" . $gedung['opd_kode'] . "' selected>" . $gedung['opd_nama'] . "</option>";
      foreach ($opd as $o) {
        $option[] = "<option class value='" . $o['opd_kode'] . "'>" . $o['opd_nama'] . "</option>";
      }
    } else if (session()->get('group' == 'admin')) {
      $option = "<option class value='" . $opdAdmin['opd_kode'] . "'>" . $opdAdmin['opd_nama'] . "</option>";
    }
    $modal = "
        <!--begin::Heading-->
        <div class='text-center mb-13'>
            <!--begin::Title-->
            <h1 class='mb-3'>Edit Gedung</h1>
            <!--end::Title-->
            <!--begin::Description-->
            <div class='text-muted fw-bold fs-5'>Perlu menambah gedung terlebih dahulu sebelum melakukan
                <a href='#' class='link-primary fw-bolder'>Reservasi</a>.
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->
        <!--begin::Separator-->
        <!-- <div class='separator d-flex flex-center mb-8'>
            <span class='text-uppercase bg-body fs-7 fw-bold text-muted px-3'>OR</span>
        </div> -->
        <!--end::Separator-->
        <form method='POST' action='/gedung/update/" . $gedung['gedung_kode'] . "'>
            <!-- form input -->
            <div class='mb-10'>
                <!-- Begin::Kode Gedung -->
                <input class='form-control form-control-solid mb-8' type='text' placeholder='Kode Gedung'
                    name='gedung_kode' value='" . $gedung['gedung_kode'] . "'>
                <!-- End::Kode Gedung -->
                <!-- Begin::Nama Gedung -->
                <input class='form-control form-control-solid mb-8' type='text' placeholder='Nama Gedung'
                    name='gedung_nama' value='" . $gedung['gedung_nama'] . "'>
                <!-- End::Nama Gedung -->
                <!--begin::OPD-->
                <div class='mb-8'>
                <select id='select-opd' name='opd_kode' class='form-select form-select-solid form-select-md' data-control='select2' data-placeholder='-- Pilih OPD --'>
                    <option class value='' selected disabled>OPD Gedung</option>
                </select>
                </div>
                <!--end::OPD-->
            </div>
            <!--begin::Notice-->
            <div class='d-flex flex-stack'>
                <!--begin::Label-->
                <div class='me-5 fw-bold'>
                    <label class='fs-6'>Cek terlebih dahulu</label>
                    <div class='fs-7 text-muted'>Pastikan data yang dimasukkan sesuai dengan gedung yang ada
                    </div>
                </div>
                <!--end::Label-->
                <!--begin::Switch-->
                <label class='form-check form-switch form-check-custom form-check-solid'>
                    <button type='submit' class='btn btn-primary'>Ubah</button>
                </label>
        </form>
        <!--end::Switch-->
    </div>
    <!--end::Notice-->
      ";
    $data = [
      'modal' => $modal,
      'option' => $option,
    ];
    $response = json_encode($data);
    return $response;
  }
}
