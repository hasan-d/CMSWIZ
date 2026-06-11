<?php 
require_once 'config.php';
$pages = db_selectAll('pages', ['status'=>'published'], 'title ASC');

header('Content-type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= SITE_URL ?> </loc>
        <priority>1.0</priority>
    </url>
    <?php foreach ($pages as $page): ?>
        <url>
            <loc><?= SITE_URL ?>/<?= htmlspecialchars($page['slug']) ?></loc>
            <lastmod><?= date('Y-m-d', strtotime($page['created_at'])) ?></lastmod>
            <priority>0.8</priority>
        </url>
        <?php endforeach; ?>
</urlset>