# PHP Fail2Ban

### Under attack?
PHP Fail2Ban is



## Kegunaan :
Untuk melindungi server dari SSH Brute Force Login.


## Constants :
`MAX_FAILED` Jumlah maksimal login gagal.
`FAIL2BAN_DATA` Penyimpanan logs dan banned list.


## Installation
1. ```shell
composer install
```
2. Login sebagai root ```sudo -i```
3. Jalankan ```crontab -e```
4. Tambahkan ```* * * * * php fail2ban.php```
5. Simpan


## How it works?
1. PHP Fail2Ban akan membaca file `/var/log/auth.log` dan menyimpan semua informasi IP, User dan Waktu yang berkaitan dengan SSH Login yang gagal.
2. Kemudian PHP Fail2Ban akan menghitung jumlah gagal login tiap IP dan akan memasukkan IP yang memiliki jumlah gagal login lebih dari atau sama dengan constant `MAX_FAILED` untuk dimasukkan ke dalam banned list.
3. PHP Fail2Ban akan memasukkan IP yang ada di dalam banned list ke `/etc/hosts.deny`.
4. PHP Fail2Ban akan melakukan restart pada service SSH sesudah melakukan perubahan pada `/etc/hosts.deny` agar perubahan dapat terapply pada server.