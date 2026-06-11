<?php
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';
$items = get_menu_items();
$pages = db_selectAll('pages', ['status' => 'published'], 'title ASC');

if (isset($_POST['add_menu'])) {
    $page_id = $_POST['page_id'] ? (int)$_POST['page_id'] : null;
    $url = trim($_POST['url']);
    if ($page_id) {
        $selected = db_selectOne('pages', ['id' => $page_id]);
        $url = $selected ? $selected['slug'] : $url;
    }
    db_insert('navigation', [
        'title' => trim($_POST['title']),
        'url' => $url,
        'page_id' => $page_id,
        'parent_id' => $_POST['parent_id'] ?: null,
        'target' => $_POST['target'],
        'order_priority' => (int)$_POST['order_priority']
    ]);
    set_flash('success', 'Menu item added');
    redirect('menu.php');
}
?>
<h1>Add Menu Item</h1>
<form method="POST" class="card">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Page</label>
            <select name="page_id" class="form-control">
                <option value="">-- Custom URL --</option>
                <?php foreach ($pages as $page): ?>
                    <option value="<?= $page['id'] ?>"><?= htmlspecialchars($page['title']) ?> (<?= $page['slug'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3" id="custom-url-wrap" style="display:block;">
            <label class="form-label">Custom URL</label>
            <input type="text" name="url" class="form-control" placeholder="https://...">
        </div>
        <div class="mb-3">
            <label class="form-label">Parent</label>
            <select name="parent_id" class="form-control">
                <option value="">-- Root --</option>
                <?php foreach ($items as $item): ?>
                    <?php if (!$item['parent_id']): ?>
                        <option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Target</label>
                <select name="target" class="form-control">
                    <option value="_self">Same tab</option>
                    <option value="_blank">New tab</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Order</label>
                <input type="number" name="order_priority" class="form-control" value="0">
            </div>
        </div>
        <button type="submit" name="add_menu" class="btn btn-success">Create</button>
        <a href="menu.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>
<script>
document.querySelector('select[name="page_id"]').addEventListener('change', function() {
    document.getElementById('custom-url-wrap').style.display = this.value ? 'none' : 'block';
});
</script>
<?php include '../templates/admin_footer.php'; ?>