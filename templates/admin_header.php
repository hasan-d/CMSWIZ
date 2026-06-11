<?php 
if(!is_logged_in()){
    redirect('../admin/login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($site_settings['site_name']) ?> - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="d-flex" style="min-height:100vh;">
    <nav class="bg-dark text-white p-3" style="width:250px;">
        <h5 class="text-center mb-4"><?= htmlspecialchars($site_settings['site_name']) ?></h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="dashboard.php" class="nav-link text-white">Dashboard</a></li>
            <li class="nav-item"><a href="users.php" class="nav-link text-white">Users</a></li>
            <li class="nav-item"><a href="media.php" class="nav-link text-white">Media</a></li>
            <li class="nav-item"><a href="pages.php" class="nav-link text-white">Pages</a></li>
            <li class="nav-item"><a href="menu.php" class="nav-link text-white">Menu</a></li>
            <li class="nav-item"><a href="settings.php" class="nav-link text-white">Settings</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
        </ul>
    </nav>
    <?php if(has_flash('success')): ?>
    <div class="alert alert-success"><?= get_flash('success') ?></div>
    <?php endif; ?>
<main class="flex-grow-1 p-4">