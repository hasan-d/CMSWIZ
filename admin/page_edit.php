<?php
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';
$id = (int)$_GET['id'];
$page = db_selectOne('pages', ['id' => $id]);
if (!$page) {
    set_flash('error', 'Page not found');
    redirect('pages.php');
}
if (isset($_POST['update_page'])) {
    db_update('pages', [
        'title' => trim($_POST['title']),
        'slug' => slugify($_POST['title']),
        'content' => $_POST['content'],
        'status' => $_POST['status']
    ], ['id' => $id]);
    set_flash('success', 'Page updated');
    redirect('pages.php');
}
?>
<h1>Edit Page</h1>
<form method="POST" class="card">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($page['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="10"><?= htmlspecialchars($page['content']) ?></textarea>
        </div>
        <div class="mb-3">
            <select name="status" class="form-control">
                <option value="published" <?= $page['status'] === 'published' ? 'selected' : '' ?>>Published</option>
                <option value="draft" <?= $page['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
            </select>
        </div>
        <button type="submit" name="update_page" class="btn btn-success">Update</button>
        <a href="pages.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>
<?php include '../templates/admin_footer.php'; ?>