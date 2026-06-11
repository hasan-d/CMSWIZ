<?php 
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';

if(!has_role('admin')){
    redirect('dashboard.php');
}

if(isset($_POST['delete_id'])){
    $delete_id = (int)$_POST['delete_id'];
    if($delete_id !== $_SESSION['user_id']){
        db_delete('users', ['id' => $delete_id]);
        set_flash('success', 'User deleted');
    }
    redirect('users.php');
}
$users = db_selectAll('users', [], 'created_at DESC');
?>

<h1>Users</h1>
<a href="user_add.php" class="btn btn-primary mb-3">Add New User</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $user['role'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <td>
                    <a href="user_edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?= $user['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include '../templates/admin_footer.php'; ?>