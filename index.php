<?php
require_once 'config.php';
include 'templates/header.php';
$pages = db_selectAll('pages', ['status' => 'published'], 'created_at DESC');
?>


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<div class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Welcome to the <?= htmlspecialchars($site_settings['site_name']) ?></h1>
        <p class="hero-subtitle">This is THE CMS. The one and only - CMSWIZ</p>   
        <a href="<?= $pages[0]['slug'] ?? '#' ?>" class="hero-btn">Kreni</a>
    </div>
</div>

<h1 class="mb-4">Stranice</h1>
<div class="row g-4">
    <?php foreach ($pages as $page): ?>
        <div class="col-md-4" data-aos="fade-up">
            <div class="card h-100 shadow">
                <?php if(!empty($page['image'])): ?>
                    <img src="<?= htmlspecialchars($page['image']) ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                <?php endif; ?>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= htmlspecialchars($page['title']) ?></h5>
                    <p class="card-text text-muted">
                        <?= htmlspecialchars(substr(strip_tags($page['content']), 0, 150)) ?>...
                    </p>
                    <a href="<?= $page['slug'] ?>" class="btn btn-primary mt-auto">Read More</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<script>AOS.init();</script>
<?php include 'templates/footer.php'; ?>