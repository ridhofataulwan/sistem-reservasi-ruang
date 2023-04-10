<?php

namespace App\Models;

use CodeIgniter\Model;

class OpdModel extends Model
{
  protected $table = 'lib_opd';
  protected $primaryKey = 'opd_kode';

  /**
   * -------------------------------------------------------------------
   * getOpd($opd_kode = '')
   * -------------------------------------------------------------------
   * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_opd
   * 
   * Akan ambil semua data jika parameter $opd_kode tidak diisi
   *
   * Akan ambil berdasarkan opd_kode apabila parameter $opd_kode diisi
   */
  public function getOpd(string $opd_kode = '')
  {
    if ($opd_kode == '') {
      return $this->db->table('lib_opd')->get()->getResultArray();
    } else {
      return $this->db->table('lib_opd')->where(['opd_kode' => $opd_kode])->get()->getResultArray()[0];
    }
  }

  /**
   * -------------------------------------------------------------------
   * insertOpd($data)
   * -------------------------------------------------------------------
   * Digunakan untuk input data dalam bentuk associative array ke tabel lib_opd
   * 
   * Field yang digunakan untuk memasukkan data opd adalah:
   *
   * opd_kode, opd_nama, opd_email, opd_alamat, opd_telp
   */
  public function insertOpd(array $data)
  {
    return $this->db->table('lib_opd')->insert($data);
  }

  /**
   * -------------------------------------------------------------------
   * updateOpd($opd_kode, $data)
   * -------------------------------------------------------------------
   * Digunakan untuk update data dalam bentuk associative array ke tabel lib_opd
   * 
   * Field yang digunakan untuk memasukkan data opd adalah:
   *
   * nama, email, alamat, telp
   */
  public function updateOpd(string $opd_kode, array $data)
  {
    return $this->db->table('lib_opd')->where(['opd_kode' => $opd_kode])->update($data);
  }

  /**
   * -------------------------------------------------------------------
   * deleteOpd($opd_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk hapus data dari tabel lib_opd berdasarkan opd_kode
   */
  public function deleteOpd(string $opd_kode)
  {
    return $this->db->table('lib_opd')->delete(['opd_kode' => $opd_kode]);
  }

  /**
   * -------------------------------------------------------------------
   * getOpdByOpdKode($opd_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_opd
   * berdasarkan opd gedung $opd_kode
   * 
   */
  public function getOpdByOpdKode(string $opd_kode)
  {
    return $this->db->table('lib_opd')
      ->where(['opd_kode' => $opd_kode])->get()->getResultArray()[0];
  }

  /**
   * -------------------------------------------------------------------
   * getOpdByBidangKode($bidang_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_opd
   * berdasarkan opd gedung $bidang_kode
   * 
   */
  public function getOpdByBidang(string $bidang_kode)
  {
    return $this->db->table('lib_bidang')
      ->where(['bidang_kode' => $bidang_kode])->get()->getResultArray()[0];
  }
}
