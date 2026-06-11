<?php 
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';

if(isset($_POST['save_settings'])){
    $site_name = trim($_POST['site_name']);

    //update site_name
    $stmt = $conn->prepare("UPDATE settings SET `value` = ? WHERE `key` = 'site_name'");
    $stmt->bind_param("s", $site_name);
    $stmt->execute();

    //upload logo
    if(isset($_FILES['logo']) && $_FILES['logo']['error'] === 0){
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
        if(in_array($ext,$allowed) && $_FILES['logo']['size'] <= 2 * 1024 * 1024){
            $logo_name = '/logo.' . $ext;
            $logo_path = UPLOADS_PATH . '/logo';
            if(!is_dir($logo_path)) mkdir($logo_path, 0777, true);

            $old_logo = glob($logo_path . 'logo.*');
            foreach($old_logo as $f) unlink($f);

            move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path . $logo_name);

            $stmt = $conn->prepare("UPDATE settings SET `value` = ? WHERE `key` = 'site_logo'");
            $path = 'uploads/logo' . $logo_name;
            $stmt->bind_param("s", $path);
            $stmt->execute();
        }
    }

    set_flash('success', 'Settings saved');
    redirect('settings.php');
}
$result = $conn->query("SELECT `key`, `value` FROM settings");
$settings = [];
while($row = $result->fetch_assoc()){
    $settings[$row['key']] = $row['value'];
}
?>
<h1>Settings</h1>

<form method="POST" enctype="multipart/form-data" class="card">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Site Name</label>
            <input type="text" name="site_name" class="form-control" value="<?= htmlspecialchars($settings['site_name']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" name="logo" class="form-control" accept="image/*">
            <?php if (!empty($settings['site_logo'])): ?>
                <div class="mt-2">
                    <img src="../<?= $settings['site_logo'] ?>" style="max-height: 60px;">
                </div>
            <?php endif; ?>
            <small class="text-muted">Max 2MB. JPG, PNG, GIF, WEBP.</small>
        </div>
        <button type="submit" name="save_settings" class="btn btn-primary">Save</button>
    </div>
</form>

<?php include '../templates/admin_footer.php' ?>