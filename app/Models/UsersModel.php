<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'nip';

    protected $allowedFields = ['nip', 'email', 'nama', 'telp', 'alamat', 'bidang_kode'];

    /**
     * -------------------------------------------------------------------
     * getUsers($nip)
     * -------------------------------------------------------------------
     * Digunakan untuk mengambil data dalam bentuk array dari tabel users
     * 
     * Akan ambil semua data jika parameter $nip tidak diisi
     *
     * Akan ambil berdasarkan NIP apabila parameter $nip diisi
     */
    public function getUsers($nip = false)
    {
        if ($nip == null) {
            return $this->db->table('users')
                ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
                ->join('lib_opd', 'lib_bidang.opd_kode = lib_opd.opd_kode')
                ->get()->getResultArray();
            return $this->db->table('users')->get()->getResultArray();
        } else {
            return $this->table('users')->where(['nip' => $nip])
                ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
                ->join('lib_opd', 'lib_bidang.opd_kode = lib_opd.opd_kode')
                ->first();
        }
    }

    public function getAdmin()
    {
        return $this->db->table('users')
            ->join('auth_groups', 'users.group_id = auth_groups.id')
            ->join('lib_bidang', 'users.bidang_kode = lib_bidang.bidang_kode')
            ->join('lib_opd', 'lib_bidang.opd_kode = lib_opd.opd_kode')
            ->where(['group_id' => '2'])->get()->getResultArray();
    }

    /**
     * -------------------------------------------------------------------
     * insertUsers($data)
     * -------------------------------------------------------------------
     * Digunakan untuk input data dalam bentuk associative array ke tabel users
     * 
     * Field yang digunakan untuk memasukkan data users adalah:
     *
     * nip, email, nama, password (hash di controller), telp, alamat, bidang_kode
     */
    public function insertUsers(array $data)
    {
        return $this->db->table('users')->insert($data);
    }

    /**
     * -------------------------------------------------------------------
     * updateUsers($nip, $data)
     * -------------------------------------------------------------------
     * Digunakan untuk update data dalam bentuk associative array ke tabel users
     * 
     * Field yang digunakan untuk update data users adalah:
     *
     * email, nama, password (hash di controller), telp, alamat, bidang_kode
     */
    public function updateUsers(string $nip, array $data)
    {
        return $this->db->table('users')->where(['nip' => $nip])->update($data);
    }

    /**
     * -------------------------------------------------------------------
     * deleteUsers($nip)
     * -------------------------------------------------------------------
     * Digunakan untuk hapus data dari tabel users berdasarkan nip
     */
    public function deleteUsers(string $nip)
    {
        return $this->db->table('users')->delete(['nip' => $nip]);
    }


    /**
     * -------------------------------------------------------------------
     * activate($activate_hash)
     * -------------------------------------------------------------------
     * Digunakan untuk melakukan aktivasi akun 
     * 
     * Mengubah value atribut active menjadi 1
     */
    public function activate($activate_hash)
    {
        if ($this->where(['activate_hash' => $activate_hash, 'active' => 0])->first()) {
            return $this->db->table('users')
                ->update(['active' => 1, 'activate_hash' => null], ['activate_hash' => $activate_hash]);
        }
        return false;
    }

    /**
     * -------------------------------------------------------------------
     * forgotPassword($email, $reset_hash)
     * -------------------------------------------------------------------
     * Digunakan untuk melakukan aktivasi akun 
     * 
     * Mengubah value atribut active menjadi 1
     */
    public function forgotPassword($email, $reset_hash)
    {
        return $this->db->table('users')->where(['email' => $email])
            ->update(['reset_hash' => $reset_hash,]);
    }

    /**
     * -------------------------------------------------------------------
     * resetPassword()
     * -------------------------------------------------------------------
     * Digunakan untuk mengubah password
     */
    public function resetPassword($reset_hash, $new_password)
    {
        return $this->db->table('users')->where('reset_hash', $reset_hash)
            ->update(['reset_hash' => null, 'password_hash' => $new_password, 'reset_at' => date('Y-m-d H:m:s')]);
    }

    /**
     * -------------------------------------------------------------------
     * checkResetHash($reset_hash)
     * -------------------------------------------------------------------
     * Digunakan untuk mengecek atribut reset_hash pada table Users
     */
    public function checkResetHash($reset_hash)
    {
        return $this->where('reset_hash', $reset_hash)
            ->first();
    }

    /**
     * -------------------------------------------------------------------
     * getUsersByEmail($email)
     * -------------------------------------------------------------------
     * Digunakan untuk mengambil data dalam bentuk array dari tabel users
     * 
     */
    public function getUsersByEmail($email)
    {
        return $this->where(['email' => $email])
            ->first();
    }
}
