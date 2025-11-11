<?php // view/participants.php 
$edit_data = null;
if (isset($_GET['form']) && $_GET['form'] == 'edit') {
    $edit_data = $participant->readOne($_GET['id']);
}
?>

<h3>Manajemen Peserta</h3>

<div class="card">
    <h3><?php echo $edit_data ? 'Edit' : 'Tambah'; ?> Peserta</h3>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="<?php echo $edit_data ? 'update_participant' : 'create_participant'; ?>">
        
        <?php if ($edit_data): ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
        <?php endif; ?>

        <label for="name">Nama Peserta</label>
        <input type="text" id="name" name="name" value="<?php echo $edit_data['name'] ?? ''; ?>" required>
        
        <label for="phone">No. Telepon</label>
        <input type="text" id="phone" name="phone" value="<?php echo $edit_data['phone'] ?? ''; ?>" required>
        
        <button type="submit"><?php echo $edit_data ? 'Update' : 'Simpan'; ?> Peserta</button>
        <?php if ($edit_data): ?>
            <a href="index.php?page=participants" class="btn btn-danger">Batal Edit</a>
        <?php endif; ?>
    </form>
</div>

<h3>Daftar Peserta</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $participant->read();
        while ($row = $stmt->fetch()):
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td class="table-actions">
                <a href="index.php?page=participants&form=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?action=delete_participant&id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>