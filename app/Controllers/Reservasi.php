<?php

namespace App\Controllers;

use App\Models\OpdModel;
use App\Controllers\Auth;
use App\Models\AcaraModel;
use App\Models\RuangModel;
use App\Models\UsersModel;
use App\Models\GedungModel;
use App\Models\ReservasiModel;
use App\Controllers\BaseController;

class Reservasi extends BaseController
{
    public function __construct()
    {
        $this->reservasiModel = new ReservasiModel();
        $this->acaraModel = new AcaraModel();
        $this->gedungModel = new GedungModel();
        $this->ruangModel = new RuangModel();
        $this->usersModel = new UsersModel();
        $this->opdModel = new OpdModel();
        $this->authCnt = new Auth();
    }

    /**
     * -------------------------------------------------------------------
     * listReservasi()
     * -------------------------------------------------------------------
     * Method untuk melihat semua daftar reservasi yang ada di DB
     */
    public function listReservasi()
    {
        $user = $this->usersModel->getUsers(session()->get('nip'));
        $opdUser = $user['opd_kode'];
        $data = [
            'title' => 'Daftar Reservasi',
            'reservasi' => $this->reservasiModel->getReservasi(),
            'acara'     => $this->acaraModel->getAcaraByOpdAndStatus($opdUser, '1'),
            'ruang'     => $this->ruangModel->getRuang(),
            'opd'  => $this->opdModel->getOpd(),
        ];
        return view('/pages/list.reservasi.field.php', $data);
    }

    /**
     * -------------------------------------------------------------------
     * listValidationReservasi()
     * -------------------------------------------------------------------
     * Method untuk melihat daftar reservasi yang akan divalidasi oleh superadmin/admin
     */
    public function listValidationReservasi()
    {
        $user = $this->usersModel->getUsers(session()->get('nip'));
        $opdUser = $user['opd_kode'];
        $listReservasi = $this->reservasiModel->getReservasi();
        $nip = session()->get('nip');
        if (session()->get('group') != 'user') {

            //Perlu tahu dulu, yang login berasal dari OPD mana
            $user = $this->usersModel->getUsers($nip);
            $opdUser = $user['opd_kode'];

            //Array untuk simpan daftar acara
            $sortedReservasi = [];

            //Filter. Acara yang dibuat oleh user yang berasal dari opd yang sama dengan yang sedang login
            foreach ($listReservasi as $reservasi) {
                if ($reservasi['opd_tempat_kode'] == $opdUser) {
                    array_push($sortedReservasi, $reservasi);
                }
            }

            $data = [
                'title' => 'Daftar Reservasi OPD',
                'reservasi' => $sortedReservasi,
                'acara'     => $this->acaraModel->getAcaraByOpdAndStatus($opdUser, '1'),
                'ruang'     => $this->ruangModel->getRuang(),
                'opd'  => $this->opdModel->getOpd(),

            ];
            return view('/pages/list.reservasi.opd.field.php', $data);
        }

        return redirect()->to('/reservasi');
    }
    /**
     * -------------------------------------------------------------------
     * listMyReservasi()
     * -------------------------------------------------------------------
     * Method untuk melihat daftar Reservasi User yang sedang login
     */
    public function listMyReservasi()
    {
        $nip = session()->get('nip');
        $user = $this->usersModel->getUsers(session()->get('nip'));
        $opdUser = $user['opd_kode'];
        $data = [
            'title' => 'Daftar Reservasi Saya',
            'reservasi' => $this->reservasiModel->getMyReservasi($nip),
            'acara'     => $this->acaraModel->getAcaraByOpdAndStatus($opdUser, '1'),
            'ruang'     => $this->ruangModel->getRuang(),
            'opd'  => $this->opdModel->getOpd(),
        ];

        // dd($data['reservasi']);
        return view('/pages/list.myreservasi.field.php', $data);
    }

    public function detail($reservasi_id)
    {
        $data = [
            'title' => 'Detail Reservasi',
            'reservasi' => $this->reservasiModel->getReservasi($reservasi_id),
        ];

        return view('/pages/detail.reservasi.field.php', $data);
    }

    /**
     * -------------------------------------------------------------------
     * insertAttempt()
     * -------------------------------------------------------------------
     * Method untuk insert Reservasi pada database
     * 
     * Setiap group memiliki fitur ini
     */
    public function insertAttempt()
    {
        $data = [
            'ruang_kode'            => $this->request->getPost('ruang_kode'),
            'users_nip'             => session()->get('nip'),
            'acara_id'             => $this->request->getPost('acara_id'),
            'reservasi_deskripsi'   => $this->request->getPost('reservasi_deskripsi'),
            'reservasi_mulai' => $this->request->getPost('reservasi_mulai'),
            'reservasi_berakhir' => $this->request->getPost('reservasi_berakhir'),
            'reservasi_tanggal' => $this->request->getPost('reservasi_tanggal'),
            'reservasi_created_at' => date('Y-m-d h:m:s'),
            'status_reservasi_kode' => '1', //1 ==  diajukan
        ];
        $this->reservasiModel->insertReservasi($data);
        // Note: Route ke daftar reservasi
        return redirect()->to('/reservasi/saya');
    }

    public function deleteAttempt(string $acara_id)
    {
        if (session()->get('group') == 'superadmin' || 'admin') {
            $this->acaraModel->deleteAcara($acara_id);
        }
        return redirect()->to('/daftar-acara');
    }

    public function update(string $reservasi_id)
    {
        $nip = session()->get('nip');
        $user = $this->usersModel->getUsers(session()->get('nip'));
        $opdUser = $user['opd_kode'];
        $data = [
            'title' => 'Ubah Reservasi',
            'reservasi' => $this->reservasiModel->getReservasi($reservasi_id),
            'acara'     => $this->acaraModel->getAcaraByOpdAndStatus($opdUser, '1'),
            'ruang'     => $this->ruangModel->getRuang(),
        ];
        if (session()->get('nip') == $data['reservasi'] || session()->get('group') == ('superadmin' || 'admin')) { //Hanya pemilik / admin / superadmin yang dapat update
            return view('/pages/edit.reservasi.field.php', $data);
        }

        return redirect()->to('/reservasi');
    }

    public function updateAttempt()
    {
        $reservasi_id = $this->request->getPost('reservasi_id');
        $data = [
            'ruang_kode'            => $this->request->getPost('ruang_kode'),
            'users_nip'             => session()->get('nip'),
            'acara_id'             => $this->request->getPost('acara_id'),
            'reservasi_deskripsi'   => $this->request->getPost('reservasi_deskripsi'),
            'reservasi_mulai' => $this->request->getPost('reservasi_mulai'),
            'reservasi_berakhir' => $this->request->getPost('reservasi_berakhir'),
            'reservasi_tanggal' => $this->request->getPost('reservasi_tanggal'),
            'reservasi_update_at' => date('Y-m-d h:m:s'),
            'status_reservasi_kode' => 1, //1 ==  diajukan
        ];
        $this->reservasiModel->updateReservasi($reservasi_id, $data);

        return redirect()->to('/reservasi/saya');
    }

    public function setApprove()
    {
        $data = [
            'status_reservasi_kode' => '2' //2 ==  diterima
        ];
        $reservasi_id = $this->request->getPost('reservasi_id');
        $reservasiAll = $this->reservasiModel->getReservasi();
        $reservasi = $this->reservasiModel->getReservasi($reservasi_id);
        $overlapped = [];
        foreach ($reservasiAll as $ra) {
            // Filter untuk reservasi yang bukan dirinya sendiri (yang sedang divalidasi) dan juga filter untuk reservasi berstatus 1/2/4
            if ($ra['reservasi_id'] != $reservasi['reservasi_id'] && ($ra['status_reservasi_kode'] == 1 || $ra['status_reservasi_kode'] == 2 || $ra['status_reservasi_kode'] == 4)) {
                // Jika dari yang difilter tanggal nya sama dengan reservasi yang sedang divalidasi
                if ($ra['reservasi_tanggal'] == $reservasi['reservasi_tanggal']) {
                    // Pengecekan Ruang
                    if ($ra['ruang_kode'] == $reservasi['ruang_kode']) {
                        // Pengecekan Waktu OVERLAP
                        if ($ra['reservasi_mulai'] < $reservasi['reservasi_berakhir'] && $reservasi['reservasi_mulai'] < $ra['reservasi_berakhir']) {
                            // TODO: Action ketika Overlap 
                            array_push($overlapped, $ra['reservasi_id']);
                        }
                        continue;
                    }
                    continue;
                }
                continue;
            }
            continue;
        }
        if ($overlapped != []) {
            array_push($overlapped, $reservasi_id);
            $result = [
                'id' => $overlapped,
                'class' => 'bg-light-warning hoverable',
                'icon' => 'error',
                'status' => 'danger',
                'message' => 'Terdapat reservasi yang tumpang tindih. Silahkan cek kembali reservasi yang akan divalidasi'
            ];
            $response = json_encode($result);
            return $response;
        }

        if ($this->reservasiModel->setStatusReservasi($reservasi_id, $data) == true) {
            $mail = [
                'subject'   => "Reservasi Diterima - Simaru Wonogiri",
                'to'        => $reservasi['email'],
                'toName'    => $reservasi['nama'],
                'message'   => "<p>Reservasi Anda diterima</p><table>
                <tr>
                    <td>Acara</td>
                    <td>:</td>
                    <td>" . $reservasi['acara_nama'] . "</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>" . $reservasi['reservasi_tanggal'] . "</td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td>" . $reservasi['reservasi_mulai'] . " - " . $reservasi['reservasi_berakhir'] . "</td>
                </tr>
                <tr>
                    <td>Peserta</td>
                    <td>:</td>
                    <td>" . $reservasi['acara_jumlah_peserta'] . "</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>" . $reservasi['ruang_nama'] . ", " . $reservasi['gedung_nama'] . "</td>
                </tr>
             </table>",
            ];
            $this->authCnt->sendEmail($mail);
            $result = [
                'id' => [$reservasi_id],
                'class' => 'bg-light-primary hoverable',
                'icon' => 'success',
                'status' => 'success',
                'message' => 'Reservasi berhasil diterima!',
            ];
            $response = json_encode($result);
            return $response;
        }
    }

    public function setDefApprove()
    {
        $data = [
            'status_reservasi_kode' => '2' //2 ==  diterima
        ];
        $reservasi_id = $this->request->getPost('reservasi_id');
        $reservasiAll = $this->reservasiModel->getReservasi();
        $reservasi = $this->reservasiModel->getReservasi($reservasi_id);
        foreach ($reservasiAll as $ra) {
            // Filter untuk reservasi yang bukan dirinya sendiri (yang sedang divalidasi) dan juga filter untuk reservasi berstatus 1/2/4
            if ($ra['reservasi_id'] != $reservasi['reservasi_id'] && ($ra['status_reservasi_kode'] == 1 || $ra['status_reservasi_kode'] == 2 || $ra['status_reservasi_kode'] == 4)) {
                // Jika dari yang difilter tanggal nya sama dengan reservasi yang sedang divalidasi
                if ($ra['reservasi_tanggal'] == $reservasi['reservasi_tanggal']) {
                    // Pengecekan Ruang
                    if ($ra['ruang_kode'] == $reservasi['ruang_kode']) {
                        // Pengecekan Waktu OVERLAP
                        if ($ra['reservasi_mulai'] < $reservasi['reservasi_berakhir'] && $reservasi['reservasi_mulai'] < $ra['reservasi_berakhir']) {
                            // TODO: Action ketika Overlap 
                            $this->reservasiModel->setStatusReservasi($ra['reservasi_id'], ['status_reservasi_kode' => '3']);
                        }
                        continue;
                    }
                    continue;
                }
                continue;
            }
            continue;
        }
        if ($this->reservasiModel->setStatusReservasi($reservasi_id, $data) == true) {
            $mail = [
                'subject'   => "Reservasi Diterima - Simaru Wonogiri",
                'to'        => $reservasi['email'],
                'toName'    => $reservasi['nama'],
                'message'   => "<p>Reservasi Anda diterima</p><table>
                <tr>
                    <td>Acara</td>
                    <td>:</td>
                    <td>" . $reservasi['acara_nama'] . "</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>" . $reservasi['reservasi_tanggal'] . "</td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td>" . $reservasi['reservasi_mulai'] . " - " . $reservasi['reservasi_berakhir'] . "</td>
                </tr>
                <tr>
                    <td>Peserta</td>
                    <td>:</td>
                    <td>" . $reservasi['acara_jumlah_peserta'] . "</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>" . $reservasi['ruang_nama'] . ", " . $reservasi['gedung_nama'] . "</td>
                </tr>
             </table>",
            ];
            $this->authCnt->sendEmail($mail);
            $result = [
                'id' => [$reservasi_id],
                'class' => 'bg-light-primary hoverable',
                'icon' => 'success',
                'status' => 'success',
                'message' => 'Reservasi berhasil diterima!'
            ];
            $response = json_encode($result);
            return $response;
        }
    }



    /**
     * -------------------------------------------------------------------
     * setDecline()
     * -------------------------------------------------------------------
     * Method menerima atau menolak Reservasi
     */
    public function setDecline()
    {
        $reservasi_id = $this->request->getPost('reservasi_id');
        $data = [
            'status_reservasi_kode' => '3' //3 ==  ditolak
        ];
        $reservasi = $this->reservasiModel->getReservasi($reservasi_id);
        if ($this->reservasiModel->setStatusReservasi($reservasi_id, $data) == true) {
            $mail = [
                'subject'   => "Reservasi Ditolak - Simaru Wonogiri",
                'to'        => $reservasi['email'],
                'toName'    => $reservasi['nama'],
                'message'   => "<p>Reservasi Anda ditolak</p><table>
                <tr>
                    <td>Acara</td>
                    <td>:</td>
                    <td>" . $reservasi['acara_nama'] . "</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>" . $reservasi['reservasi_tanggal'] . "</td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td>" . $reservasi['reservasi_mulai'] . " - " . $reservasi['reservasi_berakhir'] . "</td>
                </tr>
                <tr>
                    <td>Peserta</td>
                    <td>:</td>
                    <td>" . $reservasi['acara_jumlah_peserta'] . "</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>" . $reservasi['ruang_nama'] . ", " . $reservasi['gedung_nama'] . "</td>
                </tr>
             </table>",
            ];
            $this->authCnt->sendEmail($mail);
            $result = [
                'id' => [$reservasi_id],
                'class' => 'bg-light-danger hoverable',
                'icon' => 'success',
                'status' => 'danger',
                'message' => 'Reservasi berhasil ditolak!'
            ];
            $response = json_encode($result);
            return $response;
        }
    }

    /**
     * -------------------------------------------------------------------
     * setOnGoing()
     * -------------------------------------------------------------------
     * Method mengubah state Reservasi Menjadi On Going
     * 
     * Method ini dijalankan ketika seseorang mengakses website ini
     * 
     */
    public function setOnGoing()
    {
        $data = [
            'status_reservasi_kode' => '4' //4 ==  berjalan
        ];
        $currentDate = date('Y-m-d');
        $minute = date('i');
        $hour = date('h');
        $meridiem = date('a');
        if ($meridiem == 'pm') {
            $hour = (int) $hour + 12;
        }
        $time = (string) $hour . ':' . (string) $minute;

        $reservasi = $this->reservasiModel->getReservasi();
        foreach ($reservasi as $r) {
            if ($r['status_reservasi_kode'] == 2 && $r['reservasi_tanggal'] == $currentDate && $time >= $r['reservasi_mulai']) {
                if ($this->reservasiModel->setStatusReservasi($r['reservasi_id'], $data) == true) {
                    $mail = [
                        'subject'   => "Reservasi Berjalan - Simaru Wonogiri",
                        'to'        => $r['email'],
                        'toName'    => $r['nama'],
                        'message'   => "<p>Reservasi Anda Berjalan</p><table>
                        <tr>
                            <td>Acara</td>
                            <td>:</td>
                            <td>" . $r['acara_nama'] . "</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>" . $r['reservasi_tanggal'] . "</td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td>:</td>
                            <td>" . $r['reservasi_mulai'] . " - " . $r['reservasi_berakhir'] . "</td>
                        </tr>
                        <tr>
                            <td>Peserta</td>
                            <td>:</td>
                            <td>" . $r['acara_jumlah_peserta'] . "</td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td>:</td>
                            <td>" . $r['ruang_nama'] . ", " . $r['gedung_nama'] . "</td>
                        </tr>
                     </table>",
                    ];
                    $this->authCnt->sendEmail($mail);
                    $result = [
                        'id' => [$r['reservasi_id']],
                        'class' => 'bg-light-warning hoverable',
                        'icon' => 'success',
                        'status' => 'warning',
                        'message' => 'Reservasi anda berjalan!'
                    ];
                    $response = json_encode($result);
                    return $response;
                }
            }
        }
    }

    /**
     * -------------------------------------------------------------------
     * setFinished()
     * -------------------------------------------------------------------
     * Method mengubah state Reservasi Menjadi Finished
     */
    public function setFinished($reservasi_id = '')
    {
        $data = [
            'status_reservasi_kode' => '5' //5 ==  selesai
        ];
        if ($reservasi_id != '') {
            $this->reservasiModel->setStatusReservasi($reservasi_id, $data);
            return redirect()->to('/reservasi/saya');
        } else {
            $currentDate = date('Y-m-d');
            $minute = date('i');
            $hour = date('h');
            $meridiem = date('a');
            if ($meridiem == 'pm') {
                $hour = (int) $hour + 12;
            }
            $time = (string) $hour . ':' . (string) $minute;
            $reservasi = $this->reservasiModel->getReservasi();
            foreach ($reservasi as $r) {
                if ($r['status_reservasi_kode'] == 4 && $r['reservasi_tanggal'] == $currentDate && $time >= $r['reservasi_berakhir']) {
                    if ($this->reservasiModel->setStatusReservasi($r['reservasi_id'], $data) == true) {
                        $mail = [
                            'subject'   => "Reservasi Selesai - Simaru Wonogiri",
                            'to'        => $r['email'],
                            'toName'    => $r['nama'],
                            'message'   => "<p>Reservasi Anda Selesai</p><table>
                            <tr>
                                <td>Acara</td>
                                <td>:</td>
                                <td>" . $r['acara_nama'] . "</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>" . $r['reservasi_tanggal'] . "</td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>:</td>
                                <td>" . $r['reservasi_mulai'] . " - " . $r['reservasi_berakhir'] . "</td>
                            </tr>
                            <tr>
                                <td>Peserta</td>
                                <td>:</td>
                                <td>" . $r['acara_jumlah_peserta'] . "</td>
                            </tr>
                            <tr>
                                <td>Tempat</td>
                                <td>:</td>
                                <td>" . $r['ruang_nama'] . ", " . $r['gedung_nama'] . "</td>
                            </tr>
                         </table>",
                        ];
                        $this->authCnt->sendEmail($mail);
                        $result = [
                            'id' => [$r['reservasi_id']],
                            'class' => 'bg-light-danger hoverable',
                            'icon' => 'success',
                            'status' => 'danger',
                            'message' => 'Reservasi berhasil ditolak!'
                        ];
                        $response = json_encode($result);
                        return $response;
                    }
                }
            }
        }
    }
    /**
     * -------------------------------------------------------------------
     * setCancel()
     * -------------------------------------------------------------------
     * Method membatalkan Reservasi
     */
    public function setCancel()
    {
        $data = [
            'status_reservasi_kode' => '6' //6 == dibatalkan
        ];
        $reservasi_id = $this->request->getPost('reservasi_id');
        $cancel = $this->reservasiModel->setStatusReservasi($reservasi_id, $data);
        if ($cancel == true) {
            $result = [
                'id' => $reservasi_id,
                'class' => 'bg-light-danger hoverable',
                'icon' => 'success',
                'status' => 'danger',
                'message' => 'Reservasi berhasil dibatalkan!'
            ];
            $response = json_encode($result);
            return $response;
        }
        $result = [
            'id' => $reservasi_id,
            'class' => 'bg-light-danger hoverable',
            'icon' => 'danger',
            'status' => 'warning',
            'message' => 'Reservasi gagal dibatalkan!'
        ];
        $response = json_encode($result);
        return $response;
    }



    public function reservasiCalendar()
    {
        $reservasi = $this->reservasiModel->getReservasi();
        $response = [];
        foreach ($reservasi as $r) {
            if ($r['status_reservasi_kode'] == '2') { //diterima 
                array_push($response, $r);
            }
            if ($r['status_reservasi_kode'] == '4') { //berjalan
                array_push($response, $r);
            }
            if ($r['status_reservasi_kode'] == '5') { //selesai
                array_push($response, $r);
            }
        }
        return json_encode($response);
    }

    public function editReservasi()
    {
        $reservasi_id   = $this->request->getPost('reservasi_id');
        $reservasi      = $this->reservasiModel->getReservasi($reservasi_id);
        $gedung         = $this->gedungModel->getGedungByOpd($reservasi['opd_tempat_kode']);
        $ruang          = $this->ruangModel->getRuangByGedung($reservasi['gedung_kode']);
        $opd            = $this->opdModel->getOpd();
        $opd_kode_user  = session()->get('opd_kode');
        $acara          = $this->acaraModel->getAcaraByOpdAndStatus($opd_kode_user, '1');
        $modal = "
                        <!--begin::Heading-->
                        <div class='text-center mb-13'>
                            <!--begin::Title-->
                            <h1 class='mb-3'>Edit Reservasi</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class='text-muted fw-bold fs-5'>Jika acara tidak ditemukan, bisa dibuat di
                                <a href='/daftar-acara' class='link-primary fw-bolder'>sini</a>.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Separator-->
                        <!-- <div class='separator d-flex flex-center mb-8'>
                            <span class='text-uppercase bg-body fs-7 fw-bold text-muted px-3'>OR</span>
                        </div> -->
                        <!--end::Separator-->
                        <form method='POST' action='/reservasi/update'>
                            <!-- form input -->
                            <input type='hidden' value='" . $reservasi_id . "' name='reservasi_id' />
                            <div class='mb-10'>
                                <div class='mb-8'>
                                    <select id='reservasi_opd_edit' class='form-select form-select-md form-select-solid' type='text' data-control='select2' data-placeholder='-- Pilih OPD --' name='opd' autocomplete='off' required>
                                        <option value='' selected>-- Pilih OPD --</option>
                                    </select>
                                </div>
                                <div class='row'>
                                    <div class='col mb-8'>
                                        <select id='reservasi_gedung' class='form-select form-select-md form-select-solid' type='text' data-control='select2' data-placeholder='-- Pilih Gedung --' name='gedung' autocomplete='off' required>
                                            <option value='' selected>-- Pilih OPD Dahulu --</option>
                                        </select>
                                    </div>
                                    <div class='col mb-8'>
                                        <select id='reservasi_ruang' class='form-select form-select-md form-select-solid' type='text' data-control='select2' data-placeholder='-- Pilih Ruang --' name='ruang_kode' autocomplete='off' required>
                                            <option value='' selected>-- Pilih OPD Dahulu --</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Ruang-->
                                <!--begin::Acara-->
                                <div class='mb-8'>
                                    <select id='reservasi_acara' name='acara_id' class='form-select form-select-md form-select-solid' type='text' data-control='select2' required>
                                        <option class value='' selected disabled>Acara</option>
                                    </select>
                                </div>
                                <!--end::Acara -->
                                <!-- Begin Waktu -->
                                <div class='row mb-3'>
                                    <div class='col-md-6 px-2'>
                                        <!-- Begin Waktu mulai -->
                                        <span class='text-muted fs-7 my-3'>
                                            Waktu Mulai
                                        </span>
                                        <input class='form-control form-control-solid' type='time' placeholder='Waktu mulai' name='reservasi_mulai' value='" . $reservasi['reservasi_mulai'] . "' required>
                                    </div>
                                    <div class='col-md-6 px-2'>
                                        <!-- Begin Waktu mulai -->
                                        <span class='text-muted fs-7 my-3'>
                                            Waktu Berakhir
                                        </span>
                                        <input class='form-control form-control-solid' type='time' placeholder='Waktu berakhir' name='reservasi_berakhir' value='" . $reservasi['reservasi_berakhir'] . "' required>
                                    </div>
                                </div>
                                <!-- End Waktu -->
                                <!-- Begin Tanggal -->
                                <span class='text-muted fs-7 mb-8'>
                                    Tanggal Reservasi
                                </span>
                                <input class='form-control form-control-solid' type='date' placeholder='Tanggal' name='reservasi_tanggal' value='" . $reservasi['reservasi_tanggal'] . "' required>
                                <!-- End Tanggal -->
                                <!--begin::Keterangan-->
                                <span class='text-muted fs-7 my-3'>
                                    Deskripsi
                                </span>
                                <textarea class='form-control form-control-solid mt-3 mb-8' rows='3' placeholder='Keterangan' name='reservasi_deskripsi' required>" . $reservasi['reservasi_deskripsi'] . "</textarea>
                                <!--end::Keterangan-->
                            </div>
                            <!--begin::Notice-->
                            <div class='d-flex flex-stack'>
                                <!--begin::Label-->
                                <div class='me-5 fw-bold'>
                                    <label class='fs-6'>Cek terlebih dahulu</label>
                                    <div class='fs-7 text-muted'>Pastikan data reservasi yang dimasukkan sesuai dengan rencana</div>
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
        ";
        $optionOpd[0] = "
                <option value='" . $reservasi['opd_tempat_kode'] . "' selected>" . $reservasi['opd_tempat'] . "</option>";
        $optionGedung[0] = "
                <option value='" . $reservasi['gedung_kode'] . "' selected>" . $reservasi['gedung_nama'] . "</option>";
        $optionRuang[0] = "
                <option value='" . $reservasi['ruang_kode'] . "' selected>" . $reservasi['ruang_nama'] . "</option>";
        $optionAcara[0] = "
                <option value='" . $reservasi['acara_id'] . "'>" . $reservasi['acara_nama'] . "</option> 
            ";
        foreach ($acara as $a) {
            $optionAcara[] = "
                <option value='" . $a['acara_id'] . "'>" . $a['acara_nama'] . "</option> 
            ";
        }
        foreach ($opd as $o) {
            $optionOpd[] = "<option value='" . $o['opd_kode'] . "'>" . $o['opd_nama'] . "</option>";
        }
        foreach ($gedung as $g) {
            $optionGedung[] = "<option value='" . $g['gedung_kode'] . "'>" . $g['gedung_nama'] . "</option>";
        }
        foreach ($ruang as $r) {
            $optionRuang[] = "<option value='" . $r['ruang_kode'] . "'>" . $r['ruang_nama'] . "</option>";
        }
        $data = [
            'modal' => $modal,
            'optionAcara' => $optionAcara,
            'optionOpd' => $optionOpd,
            'optionGedung' => $optionGedung,
            'optionRuang' => $optionRuang,
        ];
        $response = json_encode($data);
        return $response;
    }

    public function detailReservasi()
    {
        $reservasi_id   = $this->request->getPost('reservasi_id');
        $reservasi      = $this->reservasiModel->getReservasi($reservasi_id);
        $ruang          = $this->ruangModel->getRuang($reservasi['ruang_kode']);
        $gedung         = $this->gedungModel->getGedung($ruang['gedung_kode']);
        $modal = "
                        <!--begin::Heading-->
                        <div class='text-center mb-13'>
                            <!--begin::Title-->
                            <h1 class='mb-3'>Detail Reservasi</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Separator-->
                        <!-- <div class='separator d-flex flex-center mb-8'>
                            <span class='text-uppercase bg-body fs-7 fw-bold text-muted px-3'>OR</span>
                        </div> -->
                        <!--end::Separator-->
                        <form method='POST'>
                            <!-- form input -->
                            <div class='mb-10'>
                                <div class='mb-8'>
                                    <select id='reservasi_opd' class='form-select form-select-md form-select-solid' type='text' data-control='select2' data-placeholder='-- Pilih OPD --' name='opd' autocomplete='off' disabled>
                                    <option value='" . $reservasi['opd_tempat_kode'] . "' selected>" . $reservasi['opd_tempat'] . "</option> 
                                    </select>
                                </div>
                                <div class='row'>
                                    <div class='col mb-8'>
                                        <select id='reservasi_gedung' class='form-select form-select-md form-select-solid' type='text' data-control='select2' data-placeholder='-- Pilih Gedung --' name='gedung' autocomplete='off' disabled>
                                        <option value='" . $reservasi['ruang_kode'] . "' selected>" . $reservasi['ruang_nama'] . "</option> 
                                        </select>
                                    </div>
                                    <div class='col mb-8'>
                                        <select id='reservasi_ruang' class='form-select form-select-md form-select-solid' type='text' data-control='select2' data-placeholder='-- Pilih Ruang --' name='ruang_kode' autocomplete='off' disabled>
                                        <option value='" . $gedung['gedung_kode'] . "' selected>" . $gedung['gedung_nama'] . "</option> 
                                        </select>
                                    </div>
                                </div>
                                <!--end::Ruang-->
                                <!--begin::Acara-->
                                <div class='mb-8'>
                                    <select id='reservasi_acara' name='acara_id' class='form-select form-select-md form-select-solid' type='text' data-control='select2' disabled>
                                    <option value='" . $reservasi['acara_id'] . "' selected>" . $reservasi['acara_nama'] . "</option> 
                                    </select>
                                </div>
                                <!--end::Acara -->
                                <!-- Begin Waktu -->
                                <div class='row mb-3'>
                                    <div class='col-md-6 px-2'>
                                        <!-- Begin Waktu mulai -->
                                        <span class='text-muted fs-7 my-3'>
                                            Waktu Mulai
                                        </span>
                                        <input class='form-control form-control-solid' type='time' placeholder='Waktu mulai' name='reservasi_mulai' value='" . $reservasi['reservasi_mulai'] . "' disabled>
                                    </div>
                                    <div class='col-md-6 px-2'>
                                        <!-- Begin Waktu mulai -->
                                        <span class='text-muted fs-7 my-3'>
                                            Waktu Berakhir
                                        </span>
                                        <input class='form-control form-control-solid' type='time' placeholder='Waktu berakhir' name='reservasi_berakhir' value='" . $reservasi['reservasi_berakhir'] . "' disabled>
                                    </div>
                                </div>
                                <!-- End Waktu -->
                                <!-- Begin Tanggal -->
                                <span class='text-muted fs-7 mb-8'>
                                    Tanggal Reservasi
                                </span>
                                <input class='form-control form-control-solid' type='date' placeholder='Tanggal' name='reservasi_tanggal' value='" . $reservasi['reservasi_tanggal'] . "' disabled>
                                <!-- End Tanggal -->
                                <!--begin::Keterangan-->
                                <span class='text-muted fs-7 my-3'>
                                    Deskripsi
                                </span>
                                <textarea class='form-control form-control-solid mt-3 mb-8' rows='3' placeholder='Keterangan' name='reservasi_deskripsi' disabled>" . $reservasi['reservasi_deskripsi'] . "</textarea>
                                <!--end::Keterangan-->
                            </div>
        ";
        $data = [
            'modal' => $modal,
        ];
        $response = json_encode($data);
        return $response;
    }
}
