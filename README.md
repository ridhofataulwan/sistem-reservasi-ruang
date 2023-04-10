# SIMARU
## _Sistem Management Ruang dan Agenda Kabupaten Wonogiri_

Sistem Management Ruang dan Agenda Kabupaten Wonogiri merupakan aplikasi untuk reservasi agenda dan peminjaman ruangan di kabupaten wonogiri. Ada 3 fitur utama yaitu :

- Membuat acara dan agenda
- Membuat reservasi ruangan
- Mengelola gedung dan ruangan

- ## Features

- Login, Register dan Lupa Password
- Managemen akun / profil pengguna
- Managemen reservasi ruangan
- Managemen pengguna pada setiap OPD
- Managemen gedung setiap OPD
- Managemen ruangan pada gedung setiap OPD
- Managemen acara pada setiap OPD
- Kalender list acara
- Notifikasi reservasi

## Tech

 SIMARU menggunakan beberapa open source software agar Web App ini dapat berjalan dengan optimal:

- [Code Igniter 4](https://www.codeigniter.com/) - PHP Framework For Artisan Web!
- [Metronic 8](https://keenthemes.com/blog/metronic8) - Awesome responsive web template
- [MySql](https://www.mysql.com/) - Relational database.
- [jQuery] - Document event handling and data manipulation
- [PHP](https://php.net/) v7+ - Server side 
- [Composer](https://getcomposer.org/) - Package Manager for PHP 


## Installation

SIMARU menggunakan [PHP](https://php.net/) v7+ untuk dapat berjalan.

Installasi pada VPS
```sh
Install web server handler (NGINX / APACHE)
Install MySql
Install PHP (sesuai minimum requirement)
Install composer

Clone project folder dari GitLab Kominfo Wonogiri

Edit captcha site key.
Edit database configuration.
Edit Mailjet key.
Edit Base URL.

Pada .env File
```
