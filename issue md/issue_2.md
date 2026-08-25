# Implementasi Authentication Login

## Ringkasan

Mengimplementasikan proses authentication login Laravel secara fungsional menggunakan model `App\Models\User`, authentication bawaan Laravel, validasi server-side, session regeneration, dashboard yang dilindungi middleware, dan fitur logout.

## Tujuan

- Menyediakan halaman login yang dapat menampilkan form dan memproses kredensial user.
- Menggunakan authentication bawaan Laravel, bukan sistem authentication custom.
- Mengarahkan user yang berhasil login ke `/dashboard`.
- Melindungi dashboard agar hanya dapat diakses oleh user yang sudah login.
- Menyediakan logout melalui `POST /logout` dan mengarahkan user kembali ke `/login`.
- Menyediakan satu user dummy untuk pengujian login dengan password yang di-hash.

## Ruang Lingkup

### Termasuk

- Route `GET /login` untuk menampilkan halaman login.
- Route `POST /login` untuk memproses form login.
- Route `GET /dashboard` yang dilindungi middleware `auth`.
- Route `POST /logout` dengan perlindungan CSRF.
- Controller authentication di `app/Http/Controllers/Auth/`.
- Validasi field `email` dengan aturan `required|email`.
- Validasi field `password` dengan aturan `required`.
- Penggunaan `old('email')` untuk mempertahankan input email setelah validasi gagal.
- Tidak mengembalikan password melalui `old()` atau pesan error.
- Pesan authentication gagal: `Email atau password yang Anda masukkan salah.`
- View login dan dashboard sederhana menggunakan Blade.
- Penggunaan migration users bawaan Laravel jika tersedia.
- Seeder satu user dummy dengan password yang disimpan menggunakan hashing Laravel.
- Pengujian feature untuk login, validasi, dashboard, dan logout.

### Tidak Termasuk

- Fitur registrasi user.
- Fitur lupa atau reset password.
- Login sosial seperti Google atau GitHub.
- Verifikasi email.
- Pengelolaan profil user.
- Perubahan struktur tabel `users` apabila migration bawaan Laravel sudah memenuhi kebutuhan.

## Rencana Implementasi

1. Periksa dependency, konfigurasi authentication, migration `users`, model `App\Models\User`, dan struktur view yang sudah tersedia.
2. Buat controller authentication di `app/Http/Controllers/Auth/` dengan method yang jelas, seperti:
   - `showLoginForm()` untuk menampilkan halaman login.
   - `login()` untuk validasi dan memproses authentication.
   - `logout()` untuk mengakhiri session user.
3. Tambahkan route berikut pada `routes/web.php`:
   - `GET /login` dengan route name `login`.
   - `POST /login` untuk memproses kredensial.
   - `GET /dashboard` dengan middleware `auth`.
   - `POST /logout` dengan middleware authentication bila diperlukan.
4. Buat atau sesuaikan `resources/views/auth/login.blade.php` dengan:
   - Form method `POST` menuju route login.
   - Directive `@csrf`.
   - Input email dengan `old('email')`.
   - Input password tanpa `old()`.
   - Pesan error di bawah field terkait.
   - Pesan authentication gagal yang tidak membedakan email dan password.
5. Implementasikan proses login menggunakan API authentication Laravel yang sesuai, seperti `Auth::attempt()`:
   - Validasi request terlebih dahulu.
   - Cocokkan credential dengan data user.
   - Regenerate session setelah login berhasil.
   - Redirect ke `/dashboard`.
   - Kembali ke halaman login jika credential tidak cocok.
6. Buat `resources/views/dashboard.blade.php` dengan isi sederhana:
   - `Dashboard`
   - `Selamat datang!`
   - Form logout dengan method `POST` dan `@csrf`.
7. Implementasikan logout menggunakan authentication Laravel, invalidate session bila sesuai dengan pendekatan versi Laravel yang digunakan, regenerate token CSRF, lalu redirect ke `/login`.
8. Gunakan model dan migration users bawaan Laravel. Jangan membuat tabel user baru jika struktur yang tersedia sudah mencukupi.
9. Tambahkan satu user dummy pada seeder menggunakan email `jatipurnama17@gmail.com` dan password `Code4Life!`. Simpan password dengan `Hash::make()` atau mekanisme hashing Laravel yang sesuai.
10. Tambahkan pengujian feature untuk happy path, validasi gagal, credential tidak valid, perlindungan dashboard, dan logout.

## Acceptance Criteria

- [ ] `GET /login` mengembalikan status `200` dan menggunakan route name `login`.
- [ ] Form login menggunakan method `POST`, memiliki action ke route login, dan menyertakan token CSRF.
- [ ] `POST /login` memvalidasi email dengan aturan wajib dan format email.
- [ ] `POST /login` memvalidasi password sebagai field wajib.
- [ ] Jika validasi gagal, user tetap berada di halaman login.
- [ ] Email tetap terisi menggunakan `old('email')` setelah validasi gagal.
- [ ] Password tidak dikembalikan menggunakan `old()` dan tidak ditampilkan pada pesan error.
- [ ] Credential valid melakukan authentication menggunakan mekanisme bawaan Laravel.
- [ ] Session diregenerasi setelah login berhasil.
- [ ] User yang berhasil login diarahkan ke `/dashboard`.
- [ ] Credential tidak valid ditolak dengan pesan `Email atau password yang Anda masukkan salah.`.
- [ ] Pesan credential tidak valid tidak mengungkapkan apakah email atau password yang salah.
- [ ] `GET /dashboard` hanya dapat diakses oleh user yang sudah login.
- [ ] User yang belum login dan membuka `/dashboard` diarahkan ke `/login`.
- [ ] Logout tersedia melalui `POST /logout` dan dilindungi CSRF.
- [ ] Setelah logout berhasil, user diarahkan ke `/login`.
- [ ] Dashboard menampilkan teks `Dashboard` dan `Selamat datang!`.
- [ ] User dummy tersedia untuk pengujian login.
- [ ] Password user dummy tersimpan dalam bentuk hash, bukan plaintext.
- [ ] Tidak ada authentication custom yang dibuat jika fitur bawaan Laravel sudah memenuhi kebutuhan.

## File yang Kemungkinan Diubah

- `routes/web.php`
- `app/Http/Controllers/Auth/LoginController.php`
- `resources/views/auth/login.blade.php`
- `resources/views/dashboard.blade.php`
- `database/seeders/DatabaseSeeder.php`
- `tests/Feature/Auth/LoginTest.php`
- `tests/Feature/Auth/LogoutTest.php`
- `tests/Feature/DashboardTest.php`

## Definition of Done

- Semua acceptance criteria yang relevan telah terpenuhi.
- Test feature authentication, dashboard, dan logout berhasil.
- Controller memisahkan logic authentication dari Blade.
- Semua form yang mengubah state menggunakan perlindungan CSRF.
- Authentication menggunakan API dan middleware bawaan Laravel.
- Password tidak pernah disimpan atau ditampilkan sebagai plaintext.
- Session diregenerasi setelah login berhasil dan diakhiri dengan benar saat logout.
- Route, controller, view, seeder, dan test mengikuti struktur project serta konvensi Laravel yang digunakan.