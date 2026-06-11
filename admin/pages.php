<?php
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';

if(isset($_POST['delete_id'])){
    db_delete('pages', ['id'=>(int)$_POST['delete_id']]);
    set_flash('success', 'Page deleted');
    redirect('pages.php');
}
$pages = db_selectAll('pages', [], 'created_at DESC');
?>

<h1>Pages</h1>
<a href="page_add.php" class="btn btn-primary mb-3">Add New Page</a>

<table class="table table-striped">
    <thead>
        <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Slug</th>
        <th>Status</th>
        <th>Created</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pages as $page): ?>
            <tr>
                <td><?= $page['id'] ?></td>
                <td><?= htmlspecialchars($page['title']) ?></td>
                <td><?= $page['slug'] ?></td>
                <td><?= $page['status'] ?></td>
                <td><?= $page['created_at'] ?></td>
                <td>
                    <a href="page_edit.php?id=<?= $page['id'] ?>"class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" style="display:inline">
                        <input type="hidden" name="delete_id" value="<?= $page['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>
<?php include '../templates/admin_footer.php' ?>