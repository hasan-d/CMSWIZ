
</main>
<footer class="bg-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="fw-bold mb-3"><?= htmlspecialchars($site_settings['site_name']) ?></h5>
                <p class="text-white-50">Site description placeholder.</p>
            </div>
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="index.php" class="text-white-50 text-decoration-none">Home Page</a></li>
                    <li class="mb-2"><a href="o-nama" class="text-white-50 text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="vijesti" class="text-white-50 text-decoration-none">News</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Let's get connected</h5>
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/profile.php?id=61587457231786" class="text-white-50 fs-4"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.instagram.com/plkutak/" class="text-white-50 fs-4"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://github.com/hasan-d" class="text-white-50 fs-4"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <p class="text-center text-white-50 mb-0">© <?= date('Y') ?> <?= htmlspecialchars($site_settings['site_name']) ?>. All rights reserved.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
window.addEventListener('load', function() {
    document.getElementById('loader').classList.add('hide');
});
</script>
</body>
</html>