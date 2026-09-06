# Sistem Informasi - Proyek Akhir TRPL
**Proyek Akhir TRPL using CodeIgniter + Gallantea Theme**

The code is uploaded to demonstrate the simple role based Admin Panel application using CodeIgniter(HMVC Framework)

## Version Information
**1) Upto Release 1.2 -** CodeIgniter 2.2, PHP version 5.1.6 or newer, MySQL (4.1+), MySQLi
    
**2) Latest (master) -** CodeIgniter 3.1.6, PHP version 5.6 or newer, MySQL (5.1+), MySQLi

## Installation

Download the code from repository.
Unzip the zip file.

Open browser; goto [localhost/phpmyadmin](http://localhost/phpmyadmin).

Create a database with name "elusi" and import the file "elusi.sql" in that database.

Copy the remaining code into your root directory:

for example, for windows

**WAMP : c:/wamp/www/elusi**

OR

**XAMPP : c:/xampp/htdocs/elusi**

Open browser; goto [localhost/ta](http://localhost/ta) and press enter:

The login screen will appear.

To login, I am going to provide the user-email ids and password below.

**System Kaprodi Account :**

username : kaprodi

password : kaprodi

**System Akademik Account :**

username : akademik

password : akademik

**Dosen Account :**

username :  dosen

password : dosen

**Mahasiswa Account :**

username : mahasiswa

password : mahasiswa

> **Note:** the passwords above are what a *fresh* seed of `tugas_akhir.sql` / `elusi.sql`
> creates. On a database that's been running for a while, someone may have changed them --
> if login fails with these, don't try to guess a replacement. Instead, reset the account
> you need directly in the database:
> ```sql
> -- generate a bcrypt hash for a new password (run in a PHP shell: php -a)
> -- echo password_hash('your-new-password', PASSWORD_DEFAULT);
> UPDATE `user` SET `password` = '<paste the hash above>' WHERE `username` = 'akademik';
> ```

Once you logged in with System Administrator account, you can create user or edit previous user if you want.