# PHP Fail2Ban

### Under attack?


## Kegunaan :
Untuk melindungi server dari SSH Brute Force Login.

## Constants :
`MAX_FAILED` 


`FAIL2BAN_DATA`


## How it works?
1. PHP Fail2Ban akan membaca file `/var/log/auth.log` dan menyimpan semua informasi IP, User dan Waktu yang berkaitan dengan SSH Login yang gagal.
2. Kemudian PHP Fail2Ban akan menghitung jumlah gagal login tiap IP dan akan memasukkan IP yang 