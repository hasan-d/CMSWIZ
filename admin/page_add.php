<?php
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';

if(isset($_POST['add_page'])){
    db_insert('pages', [
        'title' => trim($_POST['title']),
        'slug' => slugify($_POST['title']),
        'content' => $_POST['content'],
        'status' => $_POST['status']
    ]);
    set_flash('success', 'Page created');
    redirect('pages.php');
}
?>

<h1>Add Page</h1>

<form method="POST" class="card">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="10"></textarea>
        </div>
        <div class="mb-3">
            <select name="status" class="form-control">
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>
        <button type="submit" name="add_page" class="btn btn-success">Create</button>
        <a href="pages.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>
<?php include '../templates/admin_footer.php'; ?>