<?php

namespace App\Models;

use CodeIgniter\Model;

class AcaraModel extends Model
{
    protected $table            = 'tr_acara';
    protected $primaryKey       = 'acara_id';
    protected $allowedFields    = ['users_nip', 'acara_nama', 'jenis_acara_kode', 'acara_keterangan', 'acara_jumlah_peserta', 'status_acara_kode'];

    /**
     * -------------------------------------------------------------------
     * getAcara($acara_id = '')
     * -------------------------------------------------------------------
     * Digunakan untuk mengambil data dalam bentuk array dari tabel tr_acara
     * 
     * Akan ambil semua data jika parameter $acara_id tidak diisi
     *
     * Akan ambil berdasarkan acara_id apabila parameter $acara_id diisi
     * 
     * Disini, perlu join sampai OPD karena perlu tahu acara ini dimiliki oleh opd apa
     */
    public function getAcara(string $acara_id = '')
    {
        if ($acara_id == '') {
            return $this->db->table('tr_acara')
                ->join('lib_jenis_acara', 'tr_acara.jenis_acara_kode = lib_jenis_acara.jenis_acara_kode')
                ->join('users', 'tr_acara.users_nip = users.nip')
                ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
                ->join('lib_opd', 'lib_bidang.opd_kode = lib_opd.opd_kode')
                ->join('lib_status_acara', 'lib_status_acara.status_acara_kode =  tr_acara.status_acara_kode')
                ->get()->getResultArray();
        } else {
            return $this->db->table('tr_acara')
                ->join('lib_jenis_acara', 'tr_acara.jenis_acara_kode = lib_jenis_acara.jenis_acara_kode')
                ->join('users', 'tr_acara.users_nip = users.nip')
                ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
                ->join('lib_opd', 'lib_bidang.opd_kode = lib_opd.opd_kode')
                ->join('lib_status_acara', 'lib_status_acara.status_acara_kode =  tr_acara.status_acara_kode')
                ->where(['acara_id' => $acara_id])
                ->get()->getResultArray()[0];
        }
    }

    public function getAcaraByOpdAndStatus($opdKode, $status)
    {
        return $this->db->table('tr_acara')
            ->join('lib_jenis_acara', 'tr_acara.jenis_acara_kode = lib_jenis_acara.jenis_acara_kode')
            ->join('users', 'tr_acara.users_nip = users.nip')
            ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
            ->join('lib_opd', 'lib_bidang.opd_kode = lib_opd.opd_kode')
            ->where(['lib_bidang.opd_kode' => $opdKode, 'tr_acara.status_acara_kode' => $status])
            ->get()->getResultArray();
    }

    /**
     * -------------------------------------------------------------------
     * insertAcara($data)
     * -------------------------------------------------------------------
     * Digunakan untuk input data dalam bentuk associative array ke tabel tr_acara
     * 
     * Field yang digunakan untuk memasukkan data acara adalah:
     *
     * acara_nama, users_nip, acara_keterangan, acara_jumlah_peserta, status_acara_kode
     */
    public function insertAcara(array $data)
    {
        return $this->insert($data);
    }

    /**
     * -------------------------------------------------------------------
     * updateAcara($acara_id, $data)
     * -------------------------------------------------------------------
     * Digunakan untuk update data dalam bentuk associative array ke tabel tr_acara
     * 
     * Field yang digunakan untuk memasukkan data acara adalah:
     *
     * acara_nama, acara_keterangan, acara_jumlah_peserta
     */
    public function updateAcara(string $acara_id, array $data)
    {
        return $this->db->table('tr_acara')->where(['acara_id' => $acara_id])->update($data);
    }

    /**
     * -------------------------------------------------------------------
     * deleteAcara($acara_id)
     * -------------------------------------------------------------------
     * Digunakan untuk hapus data dari tabel tr_acara berdasarkan acara_id
     */
    public function deleteAcara(string $acara_id)
    {
        return $this->db->table('tr_acara')->delete(['acara_id' => $acara_id]);
    }

    /**
     * -------------------------------------------------------------------
     * setStatusAcara($acara_id, $data)
     * -------------------------------------------------------------------
     * Digunakan untuk update data status acara 
     * 
     * Field yang digunakan untuk memasukkan data acara adalah:
     *
     * acara_nama, acara_keterangan, acara_jumlah_peserta
     */
    public function setStatusAcara(string $acara_id, array $data)
    {
        return $this->db->table('tr_acara')->where(['acara_id' => $acara_id])
            ->update($data);
    }


    //Tabel jenis acara

    /**
     * -------------------------------------------------------------------
     * getJenisAcara()
     * -------------------------------------------------------------------
     * Digunakan untuk ambil daftar jenis acara (tabel master)
     */
    public function getJenisAcara()
    {
        return $this->db->table('lib_jenis_acara')->get()->getResultArray();
    }

    /**
     * -------------------------------------------------------------------
     * insertJenisAcara()
     * -------------------------------------------------------------------
     * Digunakan untuk menambah jenis acara (tabel master)
     */
    public function insertJenisAcara(array $data)
    {
        return $this->db->table('lib_jenis_acara')->insert($data);
    }

    /**
     * -------------------------------------------------------------------
     * updateJenisAcara()
     * -------------------------------------------------------------------
     * Digunakan untuk update jenis acara (tabel master)
     */
    public function updateJenisAcara(string $jenis_acara_kode, array $data)
    {
        return $this->db->table('lib_jenis_acara')->where(['jenis_acara_kode' => $jenis_acara_kode])
            ->update($data);
    }

    /**
     * -------------------------------------------------------------------
     * deleteJenisAcara()
     * -------------------------------------------------------------------
     * Digunakan untuk hapus jenis acara (tabel master)
     */
    public function deleteJenisAcara(string $jenis_acara_kode)
    {
        return $this->db->table('lib_jenis_acara')->delete(['jenis_acara_kode' => $jenis_acara_kode]);
    }

    /**
     * -------------------------------------------------------------------
     * setStatusAcara($acara_id, $data)
     * -------------------------------------------------------------------
     * Digunakan untuk update data status acara 
     * 
     * Field yang digunakan untuk memasukkan data acara adalah:
     *
     * acara_nama, acara_keterangan, acara_jumlah_peserta
     */
    public function setStatusAcaraAjax(string $acara_id, $status_acara_kode)
    {
        $this->db->table('tr_acara')->where(['acara_id' => $acara_id])
            ->update(['status_acara_kode' => $status_acara_kode]);
        return $this->db->table('tr_acara')
            ->join('lib_status_acara', 'tr_acara.status_acara_kode = lib_status_acara.status_acara_kode')
            ->where(['acara_id' => $acara_id])->get()->getResultArray()[0];
    }
}
