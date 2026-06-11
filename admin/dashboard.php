<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config.php';
include '../templates/admin_header.php';

$user_count = db_selectOne('users', [], 'COUNT(*) as count')['count'];
$media_count = db_selectOne('media', [], 'COUNT(*) as count')['count'];
$menu_count = db_selectOne('navigation', [], 'COUNT(*) as count')['count'];

$users_by_month = $conn->query("SELECT DATE_FORMAT(created_at, '%Y-%m')as m, COUNT(*) as c
FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH) GROUP BY m ORDER BY m ")->fetch_all(MYSQLI_ASSOC);

$pages_by_month = $conn->query("SELECT DATE_FORMAT(created_at, '%Y-%m') as m, COUNT(*) as c
FROM pages WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
GROUP BY m ORDER BY m
")->fetch_all(MYSQLI_ASSOC);

$media_by_month = $conn->query("SELECT DATE_FORMAT(created_at, '%Y-%m') as m, COUNT(*) as c
FROM media WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
GROUP BY m ORDER BY m
")->fetch_all(MYSQLI_ASSOC);

$roles_data = $conn->query("SELECT role, COUNT(*) as c FROM users GROUP BY role")->fetch_all(MYSQLI_ASSOC);
$months = array_unique(array_merge(
    array_column($users_by_month, 'm'),
    array_column($pages_by_month, 'm'),
    array_column($media_by_month, 'm')
));
sort($months);

function get_counts($data, $months){
    $map = [];
    foreach ($data as $row) $map[$row['m']] = (int)$row['c'];
    return array_map(fn($m)=>$map[$m]??0,$months);
}
$user_counts = get_counts($users_by_month, $months);
$running = 0;
foreach ($user_counts as $i => $val) {
    $running += $val;
    $user_counts[$i] = $running;
}
$page_counts = get_counts($pages_by_month, $months);
$media_counts = get_counts($media_by_month, $months);
$role_labels = array_column($roles_data, 'role');
$role_counts = array_map('intval', array_column($roles_data, 'c'));
?>
<h1>Dashboard</h1>
<p class="text-muted">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></p>
<div class="row g-3 mt-3">
    <div class="col-md-4">
        <div class="card text-bg-primary">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <p class="card-text display-6"><?= $user_count ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-success">
            <div class="card-body">
                <h5 class="card-title">Media</h5>
                <p class="card-text display-6"><?= $media_count ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-warning">
            <div class="card-body">
                <h5 class="card-title">Menu Items</h5>
                <p class="card-text display-6"><?= $menu_count ?> </p>
            </div>
        </div>
    </div>
</div>
<div class="row g-4 mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Users per Month</h5>
                <canvas id="chartUsers" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Content per Month</h5>
                <canvas id="chartContent" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 mx-auto">
        <div class="card">
            <div class="card-body">
                <h5>User Roles</h5>
                <canvas id="chartRoles" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
const months = <?= json_encode($months) ?>;
const userCounts = <?= json_encode($user_counts) ?>;
const pageCounts = <?= json_encode($page_counts) ?>;
const mediaCounts = <?= json_encode($media_counts) ?>;
const roleLabels = <?= json_encode($role_labels) ?>;
const roleCounts = <?= json_encode($role_counts) ?>;
new Chart(document.getElementById('chartUsers'), {
    type: 'line',
    data: {
        labels: months,
        datasets: [{ label: 'Users', data: userCounts, borderColor: '#0d6efd', fill: true }]
    }
});
new Chart(document.getElementById('chartContent'), {
    type: 'line',
    data: {
        labels: months,
        datasets: [
            { label: 'Pages', data: pageCounts, borderColor: '#198754', fill: true },
            { label: 'Media', data: mediaCounts, borderColor: '#dc3545', fill: true }
        ]
    }
});
new Chart(document.getElementById('chartRoles'), {
    type: 'doughnut',
    data: {
        labels: roleLabels,
        datasets: [{ data: roleCounts, backgroundColor: ['#0d6efd', '#198754', '#ffc107'] }]
    }
});
</script>
<?php include '../templates/admin_footer.php' ?>