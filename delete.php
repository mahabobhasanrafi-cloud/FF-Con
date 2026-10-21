<?php
require __DIR__ . '/auth.php'; require_login();
if (!isset($_GET['csrf']) || !hash_equals(csrf_token(), $_GET['csrf'])) die('Invalid CSRF token');
$id = $_GET['id'] ?? '';
$projects = array_filter(load_projects(), fn($p) => (string)$p['id'] !== (string)$id);
save_projects($projects);
header('Location: index.php'); exit;
