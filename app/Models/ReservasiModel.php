<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservasiModel extends Model
{
    protected $table            = 'tr_reservasi';
    protected $primaryKey       = 'reservasi_id';

    protected $allowedFields    = [
        'reservasi_id', 'ruang_kode', 'users_nip',
        'acara_id', 'reservasi_deskripsi', 'reservasi_mulai',
        'reservasi_berakhir', 'reservasi_tanggal', 'reservasi_tanggal',
        'reservasi_update_at', 'status_reservasi_kode'
    ];

    /**
     * -------------------------------------------------------------------
     * getReservasi($reservasi_id = '')
     * ------------------------------------------------------------------- 
     * Digunakan untuk mengambil data dalam bentuk array dari tabel tr_reservasi
     * 
     * Akan ambil semua data jika parameter $reservasi_id tidak diisi
     *
     * Akan ambil berdasarkan reservasi_id apabila parameter $reservasi_id diisi
     * 
     */
    public function getReservasi(string $reservasi_id = '')
    {
        if ($reservasi_id == '') {
            $reservasi = $this->db->table('tr_reservasi')
                ->join('users', 'tr_reservasi.users_nip = users.nip')
                ->join('lib_ruang', 'tr_reservasi.ruang_kode = lib_ruang.ruang_kode')
                ->join('lib_gedung', 'lib_ruang.gedung_kode = lib_gedung.gedung_kode')
                ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
                ->join('lib_opd', 'lib_bidang.opd_kode = lib_opd.opd_kode')
                ->join('lib_status_reservasi', 'tr_reservasi.status_reservasi_kode = lib_status_reservasi.status_reservasi_kode')
                ->join('tr_acara', 'tr_reservasi.acara_id = tr_acara.acara_id')
                ->orderBy('reservasi_tanggal', 'desc')
                ->get()->getResultArray();
        } else {
            $reservasi = $this->table('tr_reservasi')
                ->join('users', 'tr_reservasi.users_nip = users.nip')
                ->join('lib_ruang', 'tr_reservasi.ruang_kode = lib_ruang.ruang_kode')
                ->join('lib_gedung', 'lib_ruang.gedung_kode = lib_gedung.gedung_kode')
                ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
                ->join('lib_opd', 'lib_bidang.opd_kode = lib_opd.opd_kode')
                ->join('lib_status_reservasi', 'tr_reservasi.status_reservasi_kode = lib_status_reservasi.status_reservasi_kode')
                ->join('tr_acara', 'tr_reservasi.acara_id = tr_acara.acara_id')
                ->where(['reservasi_id' => $reservasi_id])
                ->orderBy('reservasi_tanggal', 'desc')
                ->get()->getResultArray();
        }
        if (is_array($reservasi)) {
            $reservasiAll = [];
            foreach ($reservasi as $r) {
                $opdTempat = $this->getOpdByReservasiRuangKode($r['ruang_kode']);
                $r['opd_tempat'] = $opdTempat['opd_nama'];
                $r['opd_tempat_kode'] = $opdTempat['opd_kode'];
                array_push($reservasiAll, $r);
            }
            if (count($reservasiAll) == 1) {
                return $reservasiAll[0];
            }
            return $reservasiAll;
        }
    }

    /**
     * -------------------------------------------------------------------
     * getMyReservasi($nip)
     * ------------------------------------------------------------------- 
     * Digunakan untuk mengambil data dalam bentuk array dari tabel tr_reservasi
     * 
     * Mengambil data reservasi berdasarkan nip dari session user yang sedang aktif
     *
     */
    public function getMyReservasi(string $nip)
    {
        $reservasi = $this->db->table('tr_reservasi')
            ->join('users', 'tr_reservasi.users_nip = users.nip')
            ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
            ->join('lib_opd', 'lib_bidang.opd_kode = lib_opd.opd_kode')
            ->join('lib_ruang', 'tr_reservasi.ruang_kode = lib_ruang.ruang_kode')
            ->join('lib_gedung', 'lib_ruang.gedung_kode = lib_gedung.gedung_kode')
            ->join('lib_status_reservasi', 'tr_reservasi.status_reservasi_kode = lib_status_reservasi.status_reservasi_kode')
            ->join('tr_acara', 'tr_reservasi.acara_id = tr_acara.acara_id')
            ->where(['tr_reservasi.users_nip' => $nip])
            ->orderBy('reservasi_tanggal', 'desc')
            ->get()->getResultArray();
        $reservasiAll = [];
        foreach ($reservasi as $r) {
            $opdTempat = $this->getOpdByReservasiRuangKode($r['ruang_kode']);
            $r['opd_tempat'] = $opdTempat['opd_nama'];
            $r['opd_tempat_kode'] = $opdTempat['opd_kode'];
            array_push($reservasiAll, $r);
        }
        return $reservasiAll;
    }

    /**
     * -------------------------------------------------------------------
     * getMyReservasi($nip)
     * ------------------------------------------------------------------- 
     * Digunakan untuk mengambil data dalam bentuk array dari tabel tr_reservasi
     * 
     * Mengambil data reservasi berdasarkan nip dari session user yang sedang aktif
     *
     */
    public function getReservasiByState($status_reservasi_kode)
    {
        return $this->db->table('tr_reservasi')
            ->join('users', 'tr_reservasi.users_nip = users.nip')
            ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
            ->join('lib_ruang', 'tr_reservasi.ruang_kode = lib_ruang.ruang_kode')
            ->join('lib_gedung', 'lib_ruang.gedung_kode = lib_gedung.gedung_kode')
            ->join('tr_acara', 'tr_reservasi.acara_id = tr_acara.acara_id')
            ->where(['status_reservasi_kode' => $status_reservasi_kode])
            ->get()->getResultArray();
    }

    /**
     * -------------------------------------------------------------------
     * getMyReservasi($nip)
     * ------------------------------------------------------------------- 
     * Digunakan untuk mengambil data dalam bentuk array dari tabel tr_reservasi
     * 
     * Mengambil data reservasi berdasarkan nip dari session user yang sedang aktif
     *
     */
    public function getOpdByReservasiRuangKode($ruang_kode)
    {
        return $this->table('tr_reservasi')
            ->join('lib_ruang', 'tr_reservasi.ruang_kode = lib_ruang.ruang_kode')
            ->join('lib_gedung', 'lib_ruang.gedung_kode = lib_gedung.gedung_kode')
            ->join('lib_opd', 'lib_gedung.opd_kode = lib_opd.opd_kode')
            ->where(['tr_reservasi.ruang_kode' => $ruang_kode])
            ->select('lib_opd.opd_kode, opd_nama')
            ->first();
    }

    /**
     * -------------------------------------------------------------------
     * insertReservasi($data)
     * -------------------------------------------------------------------
     * Digunakan untuk input data dalam bentuk associative array ke tabel tr_reservasi
     * 
     * Field yang digunakan untuk memasukkan data acara adalah:
     *
     * acara_nama, users_nip, acara_keterangan, acara_jumlah_peserta, status_acara_kode
     */
    public function insertReservasi(array $data)
    {
        return $this->insert($data);
    }

    /**
     * -------------------------------------------------------------------
     * updateReservasi($reservasi_id, $data)
     * -------------------------------------------------------------------
     * Digunakan untuk update data dalam bentuk associative array ke tabel tr_reservasi
     * 
     */
    public function updateReservasi(string $reservasi_id, array $data)
    {
        return $this->db->table('tr_reservasi')->where(['reservasi_id' => $reservasi_id])->update($data);
    }

    /**
     * -------------------------------------------------------------------
     * deleteReservasi($reservasi_id)
     * -------------------------------------------------------------------
     * Digunakan untuk hapus data dari tabel tr_reservasi berdasarkan reservasi_id
     */
    public function deleteReservasi(string $reservasi_id)
    {
        return $this->db->table('tr_reservasi')->delete(['reservasi_id' => $reservasi_id]);
    }

    /**
     * -------------------------------------------------------------------
     * setStatusReservasi($reservasi_id, $data)
     * -------------------------------------------------------------------
     * Digunakan untuk update data status reservasi 
     * 
     */
    public function setStatusReservasi(string $reservasi_id, array $data)
    {
        return $this->db->table('tr_reservasi')->where(['reservasi_id' => $reservasi_id])
            ->update($data);
    }
}
