<?php
require_once 'config.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$page = db_selectOne('pages', ['slug' => $slug, 'status'=>'published']);
if(!$page){
    header("HTTP/1.0 404 Not Found");
    include 'templates/header.php';
    echo '<h1>404 - Page not fount</h1>';
    include 'templates/footer.php';
    exit;
}
include 'templates/header.php';
?>
<h1><?= htmlspecialchars($page['title']) ?></h1>
<?php if(!empty($page['image'])): ?>
    <img src="<?= htmlspecialchars($page['image']) ?>" class="img-fluid mb-3">
<?php endif; ?>
<div><?= $page['content'] ?></div>
<?php include 'templates/footer.php'; ?>