# TP7DPBO2425C2

# 🚀 TP7 DPBO: Sistem Absensi Kursus (OOP PHP)

Proyek ini adalah implementasi **CRUD (Create, Read, Update, Delete)** penuh menggunakan **PHP Native** dengan fokus utama pada penerapan konsep **Object-Oriented Programming (OOP)** dan *best practices* keamanan database.

---

## 🎯 1. Tema & Fungsionalitas

Tema yang diangkat adalah **Sistem Manajemen Absensi Kursus**.

Aplikasi ini dirancang sebagai *backend dashboard* sederhana bagi seorang admin untuk mengelola data-data vital seputar pelaksanaan kursus atau pelatihan.

Fitur utamanya meliputi:
* **Manajemen Kursus:** Menambah, mengedit, dan menghapus data kursus (misal: "Dasar Web", "Desain Database").
* **Manajemen Peserta:** Mengelola daftar peserta yang terdaftar di sistem.
* **Manajemen Absensi:** Mencatat, mengedit, dan menghapus status kehadiran (`Hadir`, `Absen`, `Izin`) untuk setiap peserta di setiap kursus.

---

## 🗃️ 2. Arsitektur Database

Sistem ini dibangun di atas database `db_absensi_kelas` yang terdiri dari **3 tabel (entitas)** utama, yang telah memenuhi syarat relasi tugas[cite: 266, 267].

### Tabel 1: `courses`
Tabel utama yang menyimpan daftar semua kursus atau pelatihan.
* `id` (Primary Key)
* `topic`
* `instructor`
* `schedule`

### Tabel 2: `participants`
Tabel yang menyimpan data semua peserta.
* `id` (Primary Key)
* `name`
* `phone`

### Tabel 3: `attendances` (Tabel Relasi)
Tabel "jembatan" yang mencatat kehadiran. Tabel ini memiliki **dua Foreign Key**, yang menghubungkan antara peserta dan kursus.
* `id` (Primary Key)
* `id_course` (Foreign Key ke `courses.id`)
* `id_participant` (Foreign Key ke `participants.id`)
* `date`
* `status` (Enum: 'Hadir', 'Absen', 'Izin')

---

## 🌊 3. Alur Program (OOP Flow)


1.  **Titik Masuk (`index.php`)**:
    * Setiap *request* dari browser pertama kali mendarat di `index.php`.
    * File ini bertindak sebagai **Router** dan **Controller** utama.
    * File ini memuat koneksi database dari `config/` dan semua definisi `class` dari `class/`.

2.  **Controller Logic (di `index.php`)**:
    * `index.php` memeriksa `$_POST['action']` atau `$_GET['action']` (misal: `create_course`).
    * Jika ada *action*, ia akan memanggil *method* yang sesuai dari *object* yang relevan (misal: `$course->create(...)`).
    * Semua logika bisnis dan validasi terjadi di sini sebelum data dikirim ke *model*.

3.  **Model (`class/`)**:
    * Direktori `class/` berisi "cetakan biru" (`Course.php`, `Participant.php`, `Attendance.php`).
    * Setiap *class* bertanggung jawab penuh atas interaksi database-nya sendiri.
    * [cite_start]**Keamanan:** Seluruh *query* di dalam *class* ini **wajib** menggunakan **Prepared Statements (PDO)**[cite: 270], untuk mencegah SQL Injection, sesuai spesifikasi tugas.

4.  **View (`view/`)**:
    * Setelah logika selesai, `index.php` menentukan halaman mana yang akan ditampilkan (`$_GET['page']`).
    * File *view* (misal: `view/courses.php`) dipanggil.
    * File *view* hanya berisi HTML/PHP untuk menampilkan data dan form. Ia mengambil data dengan memanggil *method* `read()` dari *object* (misal: `$course->read()`).

---
