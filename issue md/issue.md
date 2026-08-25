# Membuat Halaman Login

## Ringkasan

Membuat halaman login pada project Laravel 13 menggunakan Blade dan Tailwind CSS. Halaman menyediakan form dengan input email dan password yang responsif, mudah digunakan, serta memiliki validasi dasar pada sisi server.

## Tujuan

- Menyediakan halaman login yang dapat diakses melalui route bernama `login`.
- Menampilkan input `email` dan `password` dengan label yang jelas.
- Menggunakan Tailwind CSS 4 yang sudah terpasang melalui Vite.
- Menampilkan pesan validasi ketika data yang dikirim tidak sesuai.
- Menyiapkan struktur yang dapat dikembangkan menjadi proses autentikasi Laravel.

## Ruang Lingkup

### Termasuk

- Route `GET /login` untuk menampilkan halaman.
- Route `POST /login` untuk menerima data form.
- View Blade khusus untuk halaman login.
- Styling responsif menggunakan utility class Tailwind CSS.
- Validasi email wajib dan berformat email.
- Validasi password wajib.
- Perlindungan CSRF pada form.
- Pengujian feature untuk tampilan halaman dan validasi request.

### Tidak Termasuk

- Fitur registrasi pengguna.
- Fitur lupa atau reset password.
- Login sosial seperti Google atau GitHub.
- Desain dashboard setelah login.

> Catatan: proses autentikasi menggunakan kredensial pada tabel `users` perlu diimplementasikan sebagai bagian dari route `POST /login` jika login fungsional diperlukan. Jika kebutuhan saat ini hanya mockup UI, route POST dapat ditunda dan form cukup diarahkan ke tahap berikutnya.

## Rencana Implementasi

1. Pastikan dependency Laravel 13 dan Tailwind CSS 4 yang sudah ada tetap digunakan tanpa menambah package baru.
2. Buat route bernama `login` pada `routes/web.php` untuk method `GET` dan `POST`.
3. Buat controller login untuk memisahkan logika request dari view.
4. Buat view `resources/views/auth/login.blade.php` dengan:
   - Judul halaman login.
   - Input email bertipe `email` dengan `name="email"`.
   - Input password bertipe `password` dengan `name="password"`.
   - Tombol submit.
   - Tampilan error validasi untuk setiap field.
   - `old('email')` agar email tetap tampil setelah validasi gagal.
   - `@csrf` pada form.
5. Gunakan layout dan komponen Blade yang sudah tersedia jika ditemukan; jika belum ada, gunakan struktur view yang sederhana dan konsisten dengan project.
6. Jika autentikasi aktif, gunakan `Auth::attempt()` atau API autentikasi Laravel yang sesuai, regenerasi session setelah berhasil, dan redirect ke halaman tujuan.
7. Jika autentikasi gagal, kembalikan user ke halaman login dengan pesan error tanpa membocorkan apakah email terdaftar.
8. Pastikan aset Tailwind ter-build dengan Vite dan halaman dapat dibuka pada desktop maupun mobile.

## Acceptance Criteria

- [ ] `GET /login` mengembalikan status `200`.
- [ ] Halaman memiliki input email dengan label, tipe, dan atribut `name` yang benar.
- [ ] Halaman memiliki input password dengan label, tipe, dan atribut `name` yang benar.
- [ ] Form menggunakan method `POST`, action ke route login, dan token CSRF.
- [ ] Tombol submit terlihat jelas dan dapat digunakan melalui keyboard.
- [ ] Email kosong atau tidak valid menghasilkan pesan validasi.
- [ ] Password kosong menghasilkan pesan validasi.
- [ ] Nilai email yang valid tetap terisi setelah validasi gagal, sedangkan password tidak disimpan kembali.
- [ ] Layout tetap terbaca dan tidak bergeser pada viewport mobile.
- [ ] Pengguna dengan kredensial valid dapat login jika scope autentikasi diaktifkan.
- [ ] Kredensial tidak valid ditolak dengan pesan error yang sesuai jika scope autentikasi diaktifkan.

## File yang Kemungkinan Diubah

- `routes/web.php`
- `app/Http/Controllers/Auth/LoginController.php`
- `resources/views/auth/login.blade.php`
- `tests/Feature/Auth/LoginTest.php`

## Validasi dan Testing

1. Jalankan test feature login:

   ```bash
   php artisan test --compact tests/Feature/Auth/LoginTest.php
   ```

2. Build aset frontend:

   ```bash
   npm run build
   ```

3. Periksa secara manual:
   - Halaman dapat diakses di `/login`.
   - Validasi email dan password tampil dengan benar.
   - Form nyaman digunakan pada layar kecil.
   - Password tidak muncul sebagai teks biasa.

## Definition of Done

- Semua acceptance criteria yang relevan terhadap scope telah terpenuhi.
- Test feature login berhasil.
- Build Vite berhasil tanpa error.
- Tidak ada kredensial atau data sensitif yang ditulis ke log maupun ditampilkan pada pesan error.
- Route dan view mengikuti struktur Laravel 13 serta konvensi project.