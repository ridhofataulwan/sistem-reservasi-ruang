<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\OpdModel;
use App\Models\UsersModel;
use App\Models\GroupModel;

class Users extends BaseController
{
  //NOTE: disini belum pake myth auth, jadi sementara ditaruh string untuk yang perlu role
  public function __construct()
  {
    //model tabel user
    $this->opdModel = new OpdModel();
    $this->usersModel = new UsersModel();
    $this->groupModel = new GroupModel();
    $this->bidangModel = new BidangModel();
  }

  /**
   * -------------------------------------------------------------------
   * users()
   * -------------------------------------------------------------------
   * Controller untuk menampilkan list user
   * 
   * SuperAdmin -> melihat semua list PNS dari semua opd
   * 
   * Admin -> melihat list PNS dari opd sesuai dengan opd si Admin
   */
  public function users()
  {
    if (session()->get('group') == 'superadmin') {
      $data = [
        'title' => 'Daftar Users',
        'listusers' =>  $this->usersModel->getUsers(),
      ];
      return view('/pages/list.users.field.php', $data);
    } else if (session()->get('group') == 'admin') {
      //Perlu tau, yang login berasal dari opd mana
      $admin = $this->usersModel->getUsers(session()->get('nip'));
      $opdAdmin = $admin['opd_kode'];

      //Ambil semua user
      $allUsers = $this->usersModel->getUsers();

      //Menyiapkan data untuk ditransfer ke frontend
      $data['listusers'] = [];

      //Difilter, list user yang opd nya sama dengan opd user admin yang sedang login
      foreach ($allUsers as $users) {
        if ($users['opd_kode'] == $opdAdmin) {
          array_push($data['listusers'], $users);
        }
      }
      $data['title'] = 'Daftar Users';

      return view('/pages/list.users.field.php', $data);
    }
    //Kalo ada role PNS yang coba akses
    return redirect()->to('/dashboard');
  }

  /**
   * -------------------------------------------------------------------
   * admin()
   * -------------------------------------------------------------------
   * Controller untuk menampilkan daftar admin
   * Fitur ini hanya dapat dijalankan oleh super admin
   */
  public function admin()
  {
    if (session()->get('group') == 'superadmin') {
      $data = [
        'title' => 'Daftar Admin',
        'admins' => $this->usersModel->getAdmin(),
      ];
      return view('/pages/list.admin.field.php', $data);
    }
    //Jika admin atau user PNS biasa mencoba akses
    return redirect()->to('/dashboard');
  }

  /**
   * -------------------------------------------------------------------
   * user($nip)
   * -------------------------------------------------------------------
   * Controller untuk menampilkan satu user
   * 
   * Jika param $nip tidak diisi, akan melihat profil diri sendiri (yang sedang login)
   * 
   * Jika param $nip diisi, hanya superadmin & admin yang bisa akses
   * (atau role pns biasa bisa liat detail user pns lain?). Berarti perlu edit
   */
  public function detail(string $nip = '')
  {
    $user = $this->usersModel->getUsers(session()->get('nip'));
    if ($nip == '') {
      $data = [
        'title' => 'Profile',
        'user' => $user,
        'bidang' => $this->bidangModel->getBidangByOpd($user['opd_kode']),
        'allowUpdate' => true,
        'setToAdmin' => false,
        'opd' => $this->opdModel->getOpd(),
      ];
      return view('/pages/profile.field.php', $data);
    }

    if (session()->get('group') == 'admin') {
      $data = [
        'title' => 'Profile',
        'user' => $this->usersModel->getUsers($nip),
        'bidang' => $this->bidangModel->getBidangByOpd($user['opd_kode']),
        'allowUpdate' => false,
        'setToAdmin' => false,
      ];
      return view('/pages/profile.field.php', $data);
    }

    if (session()->get('group') == 'superadmin') {
      $data = [
        'title' => 'Profile',
        'user' => $this->usersModel->getUsers($nip),
        'bidang' => $this->bidangModel->getBidangByOpd($user['opd_kode']),
        'allowUpdate' => false,
        'setToAdmin' => true,
        'opd' => $this->opdModel->getOpd(),
      ];
      return view('/pages/profile.field.php', $data);
    }
    //Jika ada user yang tidak sesuai dengan ketentuan diatas
    return redirect()->to('/dashboard');
  }

  /**
   * -------------------------------------------------------------------
   * updateAttempt()
   * -------------------------------------------------------------------
   * Controller untuk update profile user yang login
   * 
   * User lain, bahkan superadmin/admin juga tidak bisa edit user orang lain
   */
  public function updateAttempt()
  {
    $nip = session()->get('nip');
    $data = [
      'nip' => $this->request->getPost('nip'),
      'email' => $this->request->getPost('email'),
      'nama' => $this->request->getPost('nama'),
      'telp' => $this->request->getPost('telp'),
      'alamat' => $this->request->getPost('alamat'),
      'bidang_kode' => $this->request->getPost('bidang_kode'),
    ];
    $this->usersModel->update($nip, $data);
    session()->set($data);
    return redirect()->to('/profile');
  }

  /**
   * -------------------------------------------------------------------
   * deleteUser($nip)
   * -------------------------------------------------------------------
   * Controller untuk hapus user berdasarkan $nip
   * 
   * Hanya superadmin dan admin yang bisa, role pns biasa tidak bisa hapus akun.
   */
  public function deleteUser(string $nip)
  {
    if (session()->get('group') != 'user') {
      $this->usersModel->deleteUsers($nip);
      return redirect()->to('/daftar-user');
    }

    return redirect()->to('/daftar-user');
  }

  /**
   * -------------------------------------------------------------------
   * setToAdmin()
   * -------------------------------------------------------------------
   * Controller untuk ubah role user PNS menjadi admin
   * 
   * Aksi ini hanya bisa dilakukan oleh superadmin
   */
  public function setToAdmin()
  {
    if (session()->get('group') == 'superadmin') {
      $nip = $this->request->getPost('nip');
      $this->groupModel->setGroup($nip, '2');
      $status = 'success';
    } else {
      $status = 'error';
    }
    $data = [
      'status'  => $status,
    ];
    $response = json_encode($data);
    return $response;
  }

  /**
   * -------------------------------------------------------------------
   * setToUser()
   * -------------------------------------------------------------------
   * Controller untuk ubah role admin menjadi user PNS
   * 
   * Aksi ini hanya bisa dilakukan oleh superadmin
   */
  public function setToUser()
  {
    if (session()->get('group') == 'superadmin') {
      $nip = $this->request->getPost('nip');
      $this->groupModel->setGroup($nip, '3');
    }
    // return redirect()->to('/daftar-user');
  }

  //DEVELOPMENT PHASE ONLY, nanti dihapus
  public function setToSuperAdmin(string $nip)
  {
    $this->groupModel->setGroup($nip, '1');
  }
}
