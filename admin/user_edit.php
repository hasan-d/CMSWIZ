<?php
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';
if (!has_role('admin')) {
    redirect('dashboard.php');
}
$id = (int)$_GET['id'];
$user = db_selectOne('users', ['id' => $id]);
if (!$user) {
    set_flash('error', 'User not found');
    redirect('users.php');
}
if (isset($_POST['update_user'])) {
    $data = [
        'username' => trim($_POST['username']),
        'email' => trim($_POST['email']),
        'role' => $_POST['role']
    ];
    if (!empty($_POST['password'])) {
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    db_update('users', $data, ['id' => $id]);
    set_flash('success', 'User updated');
    redirect('users.php');
}
?>
<h1>Edit User</h1>
<form method="POST" class="card">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">New password (leave empty to keep)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <select name="role" class="form-control">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <button type="submit" name="update_user" class="btn btn-success">Update</button>
        <a href="users.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>
<?php include '../templates/admin_footer.php'; ?>