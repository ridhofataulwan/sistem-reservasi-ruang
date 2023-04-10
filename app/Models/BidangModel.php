<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'lib_bidang';
    protected $primaryKey       = 'bidang_kode';

    protected $allowedFields    = ['bidang_nama'];

    /**
     * -------------------------------------------------------------------
     * getBidang($bidang_kode = '')
     * -------------------------------------------------------------------
     * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_bidang
     * 
     * Akan ambil semua data jika parameter $bidang_kode tidak diisi
     *
     * Akan ambil berdasarkan bidang_kode apabila parameter $bidang_kode diisi
     */
    public function getBidang(string $bidang_kode = '')
    {
        if ($bidang_kode == '') {
            return $this->db->table('lib_bidang')->get()->getResultArray();
        } else {
            return $this->db->table('lib_bidang')->where(['bidang_kode' => $bidang_kode])->get()->getResultArray()[0];
        }
    }

    /**
     * -------------------------------------------------------------------
     * getBidangByOPD($opd_kode = '')
     * -------------------------------------------------------------------
     * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_opd
     * 
     * Akan ambil semua data jika parameter $opd_kode tidak diisi
     *
     * Akan ambil berdasarkan bidang_kode apabila parameter $opd_kode diisi
     */
    public function getBidangByOPD(string $opd_kode = '')
    {
        return $this->db->table('lib_bidang')->where(['opd_kode' => $opd_kode])->get()->getResultArray();
    }

    /**
     * -------------------------------------------------------------------
     * insertBidang($data)
     * -------------------------------------------------------------------
     * Digunakan untuk input data dalam bentuk associative array ke tabel lib_bidang
     * 
     * Field yang digunakan untuk memasukkan data gedung adalah:
     *
     * bidang_kode, bidang_nama, opd_kode
     */
    public function insertBidang(array $data)
    {
        return $this->db->table('lib_bidang')->insert($data);
    }

    /**
     * -------------------------------------------------------------------
     * insertUsers($bidang_kode, $data)
     * -------------------------------------------------------------------
     * Digunakan untuk update data dalam bentuk associative array ke tabel lib_bidang
     * 
     * Field yang digunakan untuk memasukkan data gedung adalah:
     *
     * bidang_kode, bidang_nama, opd_kode
     */
    public function updateBidang(string $bidang_kode, array $data)
    {
        $this->db->table('lib_bidang')->where(['bidang_kode' => $bidang_kode])->update($data);
    }

    /**
     * -------------------------------------------------------------------
     * deleteGedung($bidang_kode)
     * -------------------------------------------------------------------
     * Digunakan untuk hapus data dari tabel lib_bidang berdasarkan kode gedung
     */
    public function deleteBidang(string $bidang_kode)
    {
        $this->db->table('lib_bidang')->delete(['bidang_kode' => $bidang_kode]);
    }
}
