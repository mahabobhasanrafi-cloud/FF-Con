<?php
require __DIR__ . '/auth.php';
$cfg = config();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? ''; $p = $_POST['password'] ?? '';
    if ($u === $cfg['admin_user'] && password_verify($p, $cfg['admin_pass_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php'); exit;
    }
    $error = 'Wrong username or password.';
}
if (!empty($_SESSION['admin_logged_in'])) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login - <?= e($cfg['site_name']) ?></title><link rel="stylesheet" href="admin.css"></head>
<body class="center">
<form class="login-box" method="post">
  <h1>Admin Panel</h1><p><?= e($cfg['site_name']) ?></p>
  <?php if($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>
  <label>Username<input name="username" required autofocus></label>
  <label>Password<input type="password" name="password" required></label>
  <button type="submit">Login</button>
  <small>Default: admin / admin123 — change it in config.php</small>
</form></body></html>
