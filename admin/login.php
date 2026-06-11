<?php
require_once __DIR__ . '/../config.php';

if(is_logged_in()){
    redirect('dashboard.php');
}
$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(login($email,$password)) {
        redirect('dashboard.php');
    } else {
        $error = 'Pogresan email ili lozinka!';
    }
}
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Login - <?= htmlspecialchars($site_settings['site_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">
    <div class="container" style="max-width:400px;">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Login</h3>
                <?php if($error): ?>
                    <div class="alert alert-danger"> <?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>