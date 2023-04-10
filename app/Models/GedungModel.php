<?php

namespace App\Models;

use CodeIgniter\Model;

class GedungModel extends Model
{
  protected $table = 'lib_gedung';
  protected $primaryKey = 'gedung_kode';

  /**
   * -------------------------------------------------------------------
   * getGedung($gedung_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_gedung
   * 
   * Akan ambil semua data jika parameter $gedung_kode tidak diisi
   *
   * Akan ambil berdasarkan kode gedung apabila parameter $kode_gedung diisi
   */
  public function getGedung($gedung_kode = false)
  {
    if ($gedung_kode == '') {
      return $this->db->table('lib_gedung')
        ->join('lib_opd', 'lib_gedung.opd_kode = lib_opd.opd_kode')
        ->get()->getResultArray();
    } else {
      return $this->db->table('lib_gedung')
        ->join('lib_opd', 'lib_gedung.opd_kode = lib_opd.opd_kode')
        ->where(['gedung_kode' => $gedung_kode])
        ->get()->getResultArray()[0];
    }
  }

  /**
   * -------------------------------------------------------------------
   * getGedungByOpd($opd_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk mengambil data dalam bentuk array dari tabel lib_gedung
   * berdasarkan opd gedung $opd_kode
   * 
   */
  public function getGedungByOpd(string $opd_kode)
  {
    return $this->db->table('lib_gedung')
      ->join('lib_opd', 'lib_gedung.opd_kode = lib_opd.opd_kode')
      ->where(['lib_gedung.opd_kode' => $opd_kode])
      ->get()->getResultArray();
  }

  /**
   * -------------------------------------------------------------------
   * insertUsers($data)
   * -------------------------------------------------------------------
   * Digunakan untuk input data dalam bentuk associative array ke tabel lib_gedung
   * 
   * Field yang digunakan untuk memasukkan data gedung adalah:
   *
   * gedung_kode, gedung_nama, opd_kode
   */
  public function insertGedung(array $data)
  {
    return $this->db->table('lib_gedung')->insert($data);
  }

  /**
   * -------------------------------------------------------------------
   * insertUsers($gedung_kode, $data)
   * -------------------------------------------------------------------
   * Digunakan untuk update data dalam bentuk associative array ke tabel lib_gedung
   * 
   * Field yang digunakan untuk memasukkan data gedung adalah:
   *
   * gedung_kode, gedung_nama, opd_kode
   */
  public function updateGedung(string $gedung_kode, array $data)
  {
    $this->db->table('lib_gedung')->where(['gedung_kode' => $gedung_kode])->update($data);
  }

  /**
   * -------------------------------------------------------------------
   * deleteGedung($gedung_kode)
   * -------------------------------------------------------------------
   * Digunakan untuk hapus data dari tabel lib_gedung berdasarkan kode gedung
   */
  public function deleteGedung(string $gedung_kode)
  {
    $this->db->table('lib_gedung')->delete(['gedung_kode' => $gedung_kode]);
  }
}
