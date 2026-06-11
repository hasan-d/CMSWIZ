<?php 
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';



if(isset($_POST['delete_id'])){
    db_delete('navigation', ['id' => (int)$_POST['delete_id']]);
    redirect('menu.php');
}

$items = get_menu_items();   
$tree = build_menu_tree($items);
?>

<h1>Menu</h1>
<a href="menu_add.php" class="btn btn-primary mb-3">Add New Menu Item</a>
<table class="table table-striped">
    <thead>
        <tr>
            <td>Title</td>
            <td>Page</td>
            <td>Target</td>
            <td>Order</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item): ?>
            <tr>
                <td><?= str_repeat('- ', $item['parent_id'] ? 1 : 0) . htmlspecialchars($item['title'])?></td>
                <td><?= $item['page_id'] ? htmlspecialchars($item['page_title']) : htmlspecialchars($item['url']) ?></td>
                <td><?= $item['target'] ?></td>
                <td><?= $item['order_priority'] ?></td>
                <td>
                <a href="menu_edit.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
                </td>
            </tr>
           <?php endforeach; ?> 
    </tbody>
</table>

<?php include '../templates/admin_footer.php'; ?>