<?php
// index.php
session_start();
require_once 'config/db.php';
require_once 'class/Course.php'; // Diganti dari Kelas.php
require_once 'class/Participant.php';
require_once 'class/Attendance.php';

// Inisialisasi koneksi DB
$database = new Database();
$db = $database->conn;

// Inisialisasi Objek
$course = new Course($db); // Diganti dari $kelas
$participant = new Participant($db);
$attendance = new Attendance($db);

// --- BAGIAN LOGIKA (CONTROLLER) ---
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Aksi untuk Course (Kursus)
if ($action == 'create_course') {
    $course->create($_POST['topic'], $_POST['instructor'], $_POST['schedule']);
    $_SESSION['message'] = "Kursus berhasil ditambahkan!";
    header("Location: index.php?page=courses");
    exit;
}
if ($action == 'update_course') {
    $course->update($_POST['id'], $_POST['topic'], $_POST['instructor'], $_POST['schedule']);
    $_SESSION['message'] = "Kursus berhasil diperbarui!";
    header("Location: index.php?page=courses");
    exit;
}
if ($action == 'delete_course') {
    $course->delete($_GET['id']);
    $_SESSION['message'] = "Kursus berhasil dihapus!";
    header("Location: index.php?page=courses");
    exit;
}

// Aksi untuk Participant (Tetap)
if ($action == 'create_participant') {
    $participant->create($_POST['name'], $_POST['phone']);
    $_SESSION['message'] = "Peserta berhasil ditambahkan!";
    header("Location: index.php?page=participants");
    exit;
}
if ($action == 'update_participant') {
    $participant->update($_POST['id'], $_POST['name'], $_POST['phone']);
    $_SESSION['message'] = "Peserta berhasil diperbarui!";
    header("Location: index.php?page=participants");
    exit;
}
if ($action == 'delete_participant') {
    $participant->delete($_GET['id']);
    $_SESSION['message'] = "Peserta berhasil dihapus!";
    header("Location: index.php?page=participants");
    exit;
}

// Aksi untuk Attendance (Diganti)
if ($action == 'create_attendance') {
    $attendance->create($_POST['id_course'], $_POST['id_participant'], $_POST['date'], $_POST['status']);
    $_SESSION['message'] = "Absensi berhasil dicatat!";
    header("Location: index.php?page=attendances");
    exit;
}
if ($action == 'update_attendance') {
    $attendance->update($_POST['id'], $_POST['id_course'], $_POST['id_participant'], $_POST['date'], $_POST['status']);
    $_SESSION['message'] = "Absensi berhasil diperbarui!";
    header("Location: index.php?page=attendances");
    exit;
}
if ($action == 'delete_attendance') {
    $attendance->delete($_GET['id']);
    $_SESSION['message'] = "Absensi berhasil dihapus!";
    header("Location: index.php?page=attendances");
    exit;
}

// --- BAGIAN TAMPILAN (VIEW) ---
include 'view/header.php';

// Menampilkan pesan notifikasi
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}

// Simple Router (Diganti)
switch ($page) {
    case 'courses':
        include 'view/courses.php';
        break;
    case 'participants':
        include 'view/participants.php';
        break;
    case 'attendances':
        include 'view/attendances.php';
        break;
    default:
        include 'view/dashboard.php';
}

include 'view/footer.php';
?>