<?php

namespace App\Controllers;

use App\Models\OpdModel;
use App\Models\UsersModel;
use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\GroupModel;
use Mailjet\Client;
use \Mailjet\Resources;


class Auth extends BaseController
{
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->opdModel = new OpdModel();
        $this->bidangModel = new BidangModel();
        $this->groupModel = new GroupModel();
        $this->email = \Config\Services::email();
        $this->mailJet = new Client(getenv('maijet_api_key'), getenv('maijet_secret_key'), true, ['version' => 'v3.1']);
    }

    public function index()
    {
        //
    }

    /**
     * -------------------------------------------------------------------
     * signup()
     * -------------------------------------------------------------------
     * Method menampilkan view form registrasi
     * 
     * Aksi ini hanya bisa dilakukan oleh superadmin
     */
    public function signup()
    {
        $data = [
            'title' => 'Sign Up | Sistem Manajemen Ruang dan Agenda',
            'opd' => $this->opdModel->getOpd(),
        ];
        return view('/auth/signup.php', $data);
    }

    /**
     * -------------------------------------------------------------------
     * signupAttempt()
     * -------------------------------------------------------------------
     * Method proses insert data ke database tabel User
     * 
     * Aksi ini dapat dilaukuan ketika melakukan submit registrasi
     */
    public function signupAttempt()
    {
        // Data
        $date = date("Y-m-d H:i:s");
        // Hashing
        #Hasing Password 
        $password_hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        #Hashing Active
        $activate_hash = hash('sha256', $date . " " . $this->request->getPost('email'));

        // Bidang Kode
        $bidang_kode = $this->request->getPost('bidang');
        if ($bidang_kode == "") {
            $bidang_kode = null;
        }
        $data = [
            'email'         => $this->request->getPost('email'),
            'nip'           => $this->request->getPost('nip'),
            'nama'          => $this->request->getPost('nama'),
            'bidang_kode'   => $bidang_kode,
            'alamat'        => $this->request->getPost('alamat'),
            'telp'          => $this->request->getPost('telp'),
            'password_hash' => $password_hash,
            'activate_hash' => $activate_hash,
            'created_at'    => $date,
            'group_id'      => 3,
        ];
        // ! Filter Duplicate Entry
        $checkEmail = $this->usersModel->getUsersByEmail($data['email']) != null ? true : false;
        $checkNip = $this->usersModel->getUsers($data['nip']) != null ? true : false;
        if ($checkEmail) {
            session()->setFlashdata(['message' => 'Email yang Anda masukan sudah terdaftar. Silakan cek kembali email yang Anda masukan', 'alertClass' => 'danger',]);
            return redirect()->withInput()->to('/signup');
        }
        if ($checkNip) {
            session()->setFlashdata(['message' => 'NIP yang Anda masukan sudah terdaftar. Silakan cek kembali NIP yang Anda masukan', 'alertClass' => 'danger',]);
            return redirect()->withInput()->to('/signup');
        }


        // Insert data ke table users
        $this->usersModel->insertUsers($data);

        // Send Email 
        $title = "Aktivasi Akun - Simaru Wonogiri";
        $message = "<!DOCTYPE html><html lang='en'><body><p>Silakan melaukan aktivasi akun dengan menekan tombol Aktivasi Akun di bawah ini</p><a href='" . base_url() . "/activate/$activate_hash'>Aktivasi Akun</a><p>atau klik</p><a href='" . base_url() . "/activate/$activate_hash'>" . base_url() . "/activate/$activate_hash</a></body></html>";
        $mail = [
            'subject'   => $title,
            'to'        => $data['email'],
            'toName'    => $data['nama'],
            'message'   => $message,
        ];
        if ($this->sendEmail($mail)) {
            session()->setFlashdata(['message' => 'Anda berhasil mendaftar, silakan cek email anda untuk aktivasi akun', 'alertClass' => 'success',]);
            return redirect()->to('/signin');
        } else {
            session()->setFlashdata(['message' => 'Anda gagal mendaftar, coba mendaftar lagi', 'alertClass' => 'warning',]);
            return redirect()->to('/signin');
        }
    }

    /**
     * -------------------------------------------------------------------
     * signin()
     * -------------------------------------------------------------------
     * Method menampilkan view form signin
     */
    public function signin()
    {
        $data = [
            'title' => 'Sign In | Sistem Manajemen Ruang dan Agenda',
        ];
        if (session()->get('nama') !== null) {
            return redirect()->to('/dashboard');
        }
        return view('/auth/signin.php', $data);
    }

    /**
     * -------------------------------------------------------------------
     * signinAttempt()
     * -------------------------------------------------------------------
     * Method menampilkan view form signin
     */
    public function signinAttempt()
    {
        // Check
        if (filter_var($this->request->getPost('auth'), FILTER_VALIDATE_EMAIL)) {
            $auth['atribut'] = 'email';
        } else {
            $auth['atribut'] = 'nip';
        }
        $auth['value'] = $this->request->getPost('auth');
        $password = $this->request->getPost('password');

        $user = $this->usersModel->where($auth['atribut'], $auth['value'])->first();

        if ($user == false) {
            session()->setFlashdata(['message' => 'Email / NIP yang anda masukan salah', 'alertClass' => 'danger',]);
            return redirect()->to('/signin');
        } else {
            $verify = password_verify($password, $user['password_hash']);
            if ($verify == false) {
                session()->setFlashdata(['message' => 'Password yang anda masukan salah', 'alertClass' => 'danger',]);
                return redirect()->withInput()->to('/signin');
            } elseif ($user['active'] == 0) {
                session()->setFlashdata(['message' => 'Akun anda belum aktif, silakan cek email Anda untuk melakukan aktivasi', 'alertClass' => 'warning',]);
                return redirect()->withInput()->to('/signin');
            }
        }
        if ($verify == true) {
            // Buat Sesssion
            $opd = $this->opdModel->getOpdByBidang($user['bidang_kode']);
            $user['opd_kode'] = $opd['opd_kode'];
            session()->set($user);
            $group = $this->groupModel->getGroup($user['nip']);
            session()->set('group', $group['name']);
            session()->remove('password_hash');
            return redirect()->to('/dashboard');
        }
    }

    /**
     * -------------------------------------------------------------------
     * showBidang()
     * -------------------------------------------------------------------
     * Method untuk menampilkan select option bidang berdasarkan opd yang dipilih
     */
    public function showBidang()
    {
        $opd_kode   = $this->request->getPost('opd_kode');
        $result     = $this->bidangModel->getBidangByOPD($opd_kode);
        if ($result != false) {
            echo "<option value=''>Pilih Bidang!</option>";
        } else {
            echo "<option value=''>Bidang belum tersedia</option>";
        }
        foreach ($result as $bidang) {
            echo "<option value=" . $bidang['bidang_kode'] . ">" . $bidang["bidang_nama"] . "</option>";
        };
    }

    /**
     * -------------------------------------------------------------------
     * activateAttempt()
     * -------------------------------------------------------------------
     * Method untuk melakukan aktivasi melalui email
     */
    public function activateAttempt($activate_hash)
    {
        if ($this->usersModel->activate($activate_hash)) {
            session()->setFlashdata(['message' => 'Anda berhasil melakukan aktivasi akun, silakan masuk menggunakan Email / NIP dan Password yang valid', 'alertClass' => 'success',]);
            return redirect()->to('/signin');
        } else {
            session()->setFlashdata(['message' => 'Akun anda sudah aktif. Mengalami masalah aktivasi? Silakan hubungi Admin', 'alertClass' => 'success',]);
            return redirect()->to('/signin');
        }
    }

    /**
     * -------------------------------------------------------------------
     * forgotPassword()
     * -------------------------------------------------------------------
     * Method untuk menampilkan halaman forgot password
     */
    public function forgotPassword()
    {
        $data = [
            'title' => 'Forgot Password | Sistem Manajemen Ruang dan Agenda',
        ];
        return view('auth/forgot-password', $data);
    }

    /**
     * -------------------------------------------------------------------
     * forgotPasswordAttempt()
     * -------------------------------------------------------------------
     * Method untuk menerima upaya submit dari halaman forgot password
     * 
     */
    public function forgotPasswordAttempt()
    {
        // Data
        $date = date("Y-m-d H:i:s");
        $email = $this->request->getPost('email');
        $user = $this->usersModel->getUsersByEmail($email) == null ? false : $this->usersModel->getUsersByEmail($email);

        if ($user == false) {
            session()->setFlashdata(['message' => 'Email untuk reset password gagal terkirim, silakan cek alamat email yang Anda masukan', 'alertClass' => 'danger']);
            return redirect()->to('/forgot-password');
        }

        // Hashing
        #Hasing Reset 
        $reset_hash = hash('sha256', $date . " " . $email);

        // Insert reset_hash 
        $this->usersModel->forgotPassword($email, $reset_hash);

        // Send Email 
        $title = "Reset Password - Simaru Wonogiri";
        $message = "<p>Silakan melaukan reset password dengan menekan tombol Buat Password Baru di bawah ini</p><a href='" . base_url() . "/reset-password/$reset_hash'>Buat Password Baru</a><p>Melalui link berikut ini:</p><p>" . base_url() . "/reset-password/$reset_hash</p>";
        $mail = [
            'subject'   => $title,
            'to'        => $email,
            'toName'    => $user['nama'],
            'message'   => $message,
        ];

        $sendMail = $this->sendEmail($mail);
        if ($sendMail != true) {
            session()->setFlashdata(['message' => 'Email untuk reset password gagal terkirim, silakan cek alamat email yang Anda masukan', 'alertClass' => 'danger',]);
            return redirect()->to('/forgot-password');
        }
        session()->setFlashdata(['message' => 'Email untuk reset password berhasil terkirim, silakan cek email Anda untuk mengubah password', 'alertClass' => 'success',]);
        return redirect()->to('/signin');
    }

    /**
     * -------------------------------------------------------------------
     * resetPassword()
     * -------------------------------------------------------------------
     * Method untuk menampilkan halaman reset password
     * 
     */
    public function resetPassword($reset_hash)
    {
        $data = [
            'title' => 'Reset Password | Sistem Manajemen Ruang dan Agenda',
        ];
        // Check reset_hash 
        $result = $this->usersModel->checkResetHash($reset_hash);
        if ($result) {
            $data['reset_hash'] = $reset_hash;
            return view('auth/reset-password', $data);
        } else {
            session()->setFlashdata(['message' => 'Terjadi kesalahan saat melakukan reset password, silakan input email Anda kembali', 'alertClass' => 'success',]);
            return redirect()->to('/forgot-password');
        }
    }

    /**
     * -------------------------------------------------------------------
     * resetPasswordAttempt()
     * -------------------------------------------------------------------
     * Method untuk menerima upaya submit dari halaman reset password
     * 
     */
    public function resetPasswordAttempt($reset_hash)
    {
        $new_password = $this->request->getPost('password');

        // Hashing
        #Hasing Password 
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

        // Insert new password
        $this->usersModel->resetPassword($reset_hash, $password_hash);

        session()->setFlashdata(['message' => 'Password berhasil diubah, silakan login menggunakan password Anda yang baru', 'alertClass' => 'success',]);

        return redirect()->to('/signin');
    }

    /**
     * -------------------------------------------------------------------
     * signout()
     * -------------------------------------------------------------------
     * Method untuk menghapus session sekalius keluar dari aplikasi
     */
    public function signout()
    {
        if ((session()->get('nama')) !== null) {
            session_destroy();
            session()->setFlashdata(['message' => 'Sign Out berhasil dilakukan. Silakan Sign In ulang untuk dapat menggunakan fitur', 'alertClass' => 'success',]);
            return redirect()->to(base_url());
        }
        return redirect()->to(base_url());
    }

    /**
     * -------------------------------------------------------------------
     * sendEmail(array $mail)
     * -------------------------------------------------------------------
     * Method untuk mengirim email
     */
    public function sendEmail(array $mail)
    {
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "ridhofataulwan@gmail.com",
                        'Name' => "Admin Simaru Wonogiri"
                    ],
                    'To' => [
                        [
                            'Email' => $mail['to'],
                            'Name'  => $mail['toName']
                        ]
                    ],
                    'Subject' => $mail['subject'],
                    'HTMLPart' => $mail['message'],
                ]
            ]
        ];
        $sendMail = $this->mailJet->post(Resources::$Email, ['body' => $body]);
        return $sendMail->success();
    }
}
