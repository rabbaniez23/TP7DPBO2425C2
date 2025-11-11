<?php // view/courses.php 
$edit_data = null;
if (isset($_GET['form']) && $_GET['form'] == 'edit') {
    $edit_data = $course->readOne($_GET['id']);
}
?>

<h3>Manajemen Kursus</h3>

<div class="card">
    <h3><?php echo $edit_data ? 'Edit' : 'Tambah'; ?> Kursus</h3>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="<?php echo $edit_data ? 'update_course' : 'create_course'; ?>">
        
        <?php if ($edit_data): ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
        <?php endif; ?>

        <label for="topic">Topik Kursus</label>
        <input type="text" id="topic" name="topic" value="<?php echo $edit_data['topic'] ?? ''; ?>" required>
        
        <label for="instructor">Instruktur</label>
        <input type="text" id="instructor" name="instructor" value="<?php echo $edit_data['instructor'] ?? ''; ?>" required>
        
        <label for="schedule">Jadwal</label>
        <input type="datetime-local" id="schedule" name="schedule" value="<?php echo $edit_data ? date('Y-m-d\TH:i', strtotime($edit_data['schedule'])) : ''; ?>" required>
        
        <button type="submit"><?php echo $edit_data ? 'Update' : 'Simpan'; ?> Kursus</button>
        <?php if ($edit_data): ?>
            <a href="index.php?page=courses" class="btn btn-danger">Batal Edit</a>
        <?php endif; ?>
    </form>
</div>

<h3>Daftar Kursus</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Topik</th>
            <th>Instruktur</th>
            <th>Jadwal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $course->read();
        while ($row = $stmt->fetch()):
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['topic']; ?></td>
            <td><?php echo $row['instructor']; ?></td>
            <td><?php echo date('d M Y, H:i', strtotime($row['schedule'])); ?></td>
            <td class="table-actions">
                <a href="index.php?page=courses&form=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?action=delete_course&id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>