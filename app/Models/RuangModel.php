<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangModel extends Model
{
  protected $table = 'lib_ruang';
  protected $primaryKey = 'ruang_kode';

  /**
   * -------------------------------------------------------------------
   * getRuang($ruang_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_ruang
   * 
   * Akan ambil semua data jika parameter $ruang_kode tidak diisi
   *
   * Akan ambil berdasarkan NIP apabila parameter $ruang_kode diisi
   */
  public function getRuang($ruang_kode = false)
  {
    if ($ruang_kode == '') {
      return $this->db->table('lib_ruang')
        ->join('lib_gedung', 'lib_ruang.gedung_kode = lib_gedung.gedung_kode')
        ->join('lib_opd', 'lib_gedung.opd_kode = lib_opd.opd_kode')
        ->get()->getResultArray();
    } else {
      return $this->db->table('lib_ruang')->where(['ruang_kode' => $ruang_kode])
        ->join('lib_gedung', 'lib_ruang.gedung_kode = lib_gedung.gedung_kode')
        ->join('lib_opd', 'lib_gedung.opd_kode = lib_opd.opd_kode')
        ->get()->getResultArray()[0];
    }
  }

  /**
   * -------------------------------------------------------------------
   * getRuangByGedung($gedung_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_ruang
   * berdasarkan opd gedung $gedung_kode
   * 
   */
  public function getRuangByGedung($gedung_kode)
  {
    return $this->db->table('lib_ruang')
      ->where(['lib_ruang.gedung_kode' => $gedung_kode])
      ->join('lib_gedung', 'lib_ruang.gedung_kode = lib_gedung.gedung_kode')
      ->join('lib_opd', 'lib_gedung.opd_kode = lib_opd.opd_kode')
      ->get()->getResultArray();
  }

  /**
   * -------------------------------------------------------------------
   * getRuangByGedung($gedung_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_ruang
   * berdasarkan opd gedung $gedung_kode
   * 
   */
  public function getRuangByOpd($opd_kode)
  {
    return $this->db->table('lib_ruang')
      ->join('lib_gedung', 'lib_ruang.gedung_kode = lib_gedung.gedung_kode')
      ->where(['lib_gedung.opd_kode' => $opd_kode])
      ->get()->getResultArray();
  }

  /**
   * -------------------------------------------------------------------
   * insertRuang($data)
   * -------------------------------------------------------------------
   * Digunakan untuk input data dalam bentuk associative array ke tabel lib_ruang
   * 
   * Field yang digunakan untuk memasukkan data users adalah:
   *
   * ruang_kode, ruang_nama, ruang_deskripsi, ruang_kapasitas, gedung_kode
   */
  public function insertRuang(array $data)
  {
    $this->db->table('lib_ruang')->insert($data);
  }

  /**
   * -------------------------------------------------------------------
   * updateRuang($data)
   * -------------------------------------------------------------------
   * Digunakan untuk input data dalam bentuk associative array ke tabel lib_ruang
   * 
   * Field yang digunakan untuk memasukkan data users adalah:
   *
   * ruang_kode, ruang_nama, ruang_deskripsi, ruang_kapasitas, gedung_kode
   */
  public function updateRuang(string $ruang_kode, array $data)
  {
    return $this->db->table('lib_ruang')->where(['ruang_kode' => $ruang_kode])->update($data);
  }

  /**
   * -------------------------------------------------------------------
   * deleteUsers($ruang_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk hapus data dari tabel lib_ruang berdasarkan gedung_kode
   */
  public function deleteRuang(string $ruang_kode)
  {
    return $this->db->table('lib_ruang')->delete(['ruang_kode' => $ruang_kode]);
  }
}
