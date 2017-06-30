# PHP Fail2Ban

### Under attack?


## Kegunaan :
Untuk melindungi server dari SSH Brute Force Login.

## Constants :
`MAX_FAILED` 


`FAIL2BAN_DATA`


## How it works?
1. PHP Fail2Ban akan membaca file `/var/log/auth.log` dan menyimpan semua informasi IP, User dan Waktu yang berkaitan dengan SSH Login yang gagal.
2. Kemudian PHP Fail2Ban akan menghitung jumlah gagal login tiap IP dan akan memasukkan IP yang memiliki jumlah gagal login lebih dari atau sama dengan constant `MAX_FAILED` dan akan memasukkannya ke dalam banned list.
3. PHP Fail2Ban akan memasukkan IP yang ada di dalam banned list ke `/etc/hosts.deny`.
4. Jika PHP Fail2Ban melalukan perubahan pada `/etc/hosts.deny` maka akan menjalankan
```shell
service sshd restart && service ssh restart
```
untuk merestart SSH Service agar perubahan pada `/etc/hosts.deny` terapply pada SSH.