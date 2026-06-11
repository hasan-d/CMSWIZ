<?php
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';
if (!has_role('admin')) {
    redirect('dashboard.php');
}
if (isset($_POST['add_user'])) {
    db_insert('users', [
        'username' => trim($_POST['username']),
        'email' => trim($_POST['email']),
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'role' => $_POST['role']
    ]);
    set_flash('success', 'User created');
    redirect('users.php');
}
?>
<h1>Add User</h1>
<form method="POST" class="card">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <select name="role" class="form-control">
                <option value="user">User</option>
                <option value="editor">Editor</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" name="add_user" class="btn btn-success">Create</button>
        <a href="users.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>
<?php include '../templates/admin_footer.php'; ?>