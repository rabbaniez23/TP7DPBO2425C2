<?php // view/attendances.php 
$edit_data = null;
if (isset($_GET['form']) && $_GET['form'] == 'edit') {
    $edit_data = $attendance->readOne($_GET['id']);
}
?>

<h3>Manajemen Absensi</h3>

<div class="card">
    <h3><?php echo $edit_data ? 'Edit' : 'Catat'; ?> Absensi</h3>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="<?php echo $edit_data ? 'update_attendance' : 'create_attendance'; ?>">
        
        <?php if ($edit_data): ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
        <?php endif; ?>

        <label for="id_course">Pilih Kursus</label>
        <select name="id_course" id="id_course" required>
            <option value="">-- Pilih Kursus --</option>
            <?php
            $stmt_course = $course->read();
            while($row_course = $stmt_course->fetch()) {
                $selected = ($edit_data && $edit_data['id_course'] == $row_course['id']) ? 'selected' : '';
                echo "<option value='{$row_course['id']}' $selected>{$row_course['topic']}</option>";
            }
            ?>
        </select>
        
        <label for="id_participant">Pilih Peserta</label>
        <select name="id_participant" id="id_participant" required>
            <option value="">-- Pilih Peserta --</option>
            <?php
            $stmt_part = $participant->read();
            while($row_part = $stmt_part->fetch()) {
                $selected = ($edit_data && $edit_data['id_participant'] == $row_part['id']) ? 'selected' : '';
                echo "<option value='{$row_part['id']}' $selected>{$row_part['name']}</option>";
            }
            ?>
        </select>

        <label for="date">Tanggal Absen</label>
        <input type="date" id="date" name="date" value="<?php echo $edit_data['date'] ?? date('Y-m-d'); ?>" required>
        
        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="Hadir" <?php echo ($edit_data && $edit_data['status'] == 'Hadir') ? 'selected' : ''; ?>>Hadir</option>
            <option value="Absen" <?php echo ($edit_data && $edit_data['status'] == 'Absen') ? 'selected' : ''; ?>>Absen</option>
            <option value="Izin" <?php echo ($edit_data && $edit_data['status'] == 'Izin') ? 'selected' : ''; ?>>Izin</option>
        </select>
        
        <button type="submit"><?php echo $edit_data ? 'Update' : 'Simpan'; ?> Absensi</button>
        <?php if ($edit_data): ?>
            <a href="index.php?page=attendances" class="btn btn-danger">Batal Edit</a>
        <?php endif; ?>
    </form>
</div>

<h3>Daftar Absensi</h3>
<table>
    <thead>
        <tr>
            <th>Kursus</th>
            <th>Peserta</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $attendance->read();
        while ($row = $stmt->fetch()):
        ?>
        <tr>
            <td><?php echo $row['course_topic']; ?></td>
            <td><?php echo $row['participant_name']; ?></td>
            <td><?php echo date('d M Y', strtotime($row['date'])); ?></td>
            <td><?php echo $row['status']; ?></td>
            <td class="table-actions">
                <a href="index.php?page=attendances&form=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?action=delete_attendance&id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>