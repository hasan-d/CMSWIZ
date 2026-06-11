<?php
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';

if(isset($_POST['delete'])){
    delete_media((int)$_POST['delete']);
    redirect('media.php');
}

if(isset($_POST['upload'])){
    upload_media($_FILES['file']);
    redirect('media.php');
}

$media = get_all_media();
?>
<h1>Media</h1>

<form method="POST" enctype="multipart/form-data" class="mb-4">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="file" name="file" class="form-control" required>
        </div>
        <div class="col-md-2">
            <button type="submit" name="upload" class="btn btn-primary">Upload</button>
        </div>
    </div>
</form>

<div class="row g-3">
    <?php foreach($media as $item): ?>
        <div class="col-md-3">
            <div class="card">
                <img src="../<?= $item['path'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                <div class="card-body">
                    <p class="card-text small text-truncate"><?= htmlspecialchars($item['original_name']) ?></p>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
</div>
<?php include '../templates/admin_footer.php' ?>