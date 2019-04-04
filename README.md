# UKK SMK Telkom Malang 2019 PPOB Listrik

*******************
# Role User
*******************
| Fitur           | Administrator   | Pelanggan           | Pimpinan
| :-------------|:---------------:| :-------------:|:------:|
| Register | O | X | O|
| Login           |X|X|X|
| Logout          |X|X|X|
| Ubah Status User          |X|--|--|
| CRUD Pelanggan    |X|--|--|
| CRUD Admin    |X|--|--|
| CRUD Tarif    |X|--|--|
| Tambah Penggunaan    |X|--|--|
| Verifikasi Pembayaran    |X|--|--|
| Pembayaran & Upload Bukti Pembayaran |--|--|X|
| Generate Laporan |X|X|--|

Keterangan : 

1. O : Membutuhkan Akses Khusus

2. X : Fitur tersedia untuk role tersebut

3. -- : Fitur tidak tersedia untuk role tersebut

*******************
# Akun Login
*******************
Admin : `YOUR_SERVER`/`PROJECT_NAME`/
	username = admin
	password = admin123

Pelanggan : `YOUR_SERVER`/`PROJECT_NAME`
	Username = hakim
	password = hakim123

Pimpinan : `YOUR_SERVER`/`PROJECT_NAME`
	Username = irfan
	password = irfan123
  
  
*******************
# How to Install
*******************
For spesific follow this instruction :

- Install XAMPP for windows or other apache server for linux

- Clone or download this project paste to /htdocs on windows or /YOURSERVER for linux rename to ukk

- Create database in phpmyadmin called "db_ukk"

- Import db_ukk.sql

- Enjoy it

  
*******************
# Security in this website
*******************
- XSS Clean in all post proccess

- CSRF Token on form submit process

- PASSWORD HASH for making password

  
*******************
# Acknowledgment
*******************
Thank you for all my friend, my web teacher, and my parents. For conduct me, giving spirit, etc to develop this website. I can and i porud.
