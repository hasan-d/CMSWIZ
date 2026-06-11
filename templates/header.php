<?php
require_once __DIR__ . '/../config.php';

$menu_items = get_menu_items();
$menu_tree = build_menu_tree($menu_items);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($site_settings['site_name']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div id="loader">
    <div class="spinner"></div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <?php if(!empty($site_settings['site_logo'])): ?>
                    <img src="<?= $site_settings['site_logo'] ?>" alt="logo" style="height:40px;">
                <?php else: ?>
                    <?= htmlspecialchars($site_settings['site_name']) ?>
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" ></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?= render_menu($menu_tree) ?>
            </div>
        </div> 
                </nav>
                <main class="container mt-4">