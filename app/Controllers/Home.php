<?php

namespace App\Controllers;

use App\Models\AcaraModel;
use App\Controllers\Reservasi;
use App\Models\ReservasiModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->acaraModel = new AcaraModel();
        $this->reservasiModel = new ReservasiModel();
        $this->reservasiCnt = new Reservasi();
    }

    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->reservasiCnt->setOnGoing();
        $this->reservasiCnt->setFinished();
        $data = [
            'reservasiDiterima' => $this->reservasiModel->getReservasiByState(2),
            'title' => 'Sistem Manajemen Ruang dan Agenda',
        ];
        return view('/landing.php', $data);
    }

    /**
     * Dashboard() mengirimkan beberapa data untuk tampilan
     * 
     * title : Header halaman
     */
    public function dashboard()
    {
        $data = [
            'reservasiDiajukan' => $this->reservasiModel->getReservasiByState(1),
            'reservasiDiterima' => $this->reservasiModel->getReservasiByState(2),
            'reservasiBerjalan' => $this->reservasiModel->getReservasiByState(4),
        ];
        if (session()->get('group') == 'superadmin' && session()->get('nip') !== null) {
            $data['title'] = 'Dashboard Superadmin';
            return view('/pages/dashboard.field.php', $data);
        } else if (session()->get('group') == 'admin' && session()->get('nip') !== null) {
            $data['title'] = 'Dashboard Admin';
            return view('/pages/dashboard.field.php', $data); //sementara
        } else if (session()->get('group') == 'user' && session()->get('nip') !== null) {
            $data['title'] = 'Dashboard PNS';
            return view('/pages/dashboard.field.php', $data); //sementara
        }

        return redirect()->to('/');
    }

    public function calendar()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->reservasiCnt->setOnGoing();
        $this->reservasiCnt->setFinished();
        $data = [
            'title' => 'Sistem Manajemen Ruang dan Agenda',
        ];
        return view('/landing-calendar.php', $data);
    }
}
