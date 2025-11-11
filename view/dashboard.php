<?php // view/dashboard.php ?>
<h2>Selamat Datang di Sistem Absensi</h2>
<p>Ini adalah halaman dashboard. Silakan pilih menu di atas untuk mengelola kursus, peserta, atau absensi.</p>

<div class="card">
    <h3>Statistik Singkat</h3>
    <p>Total Kursus: 
        <?php 
            $stmt = $course->read(); // Diganti dari $kelas
            echo $stmt->rowCount();
        ?>
    </p>
    <p>Total Peserta: 
        <?php 
            $stmt = $participant->read();
            echo $stmt->rowCount();
        ?>
    </p>
    <p>Total Catatan Absensi: 
        <?php 
            $stmt = $attendance->read();
            echo $stmt->rowCount();
        ?>
    </p>
</div>