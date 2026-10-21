<?php
// Admin auth - this whole admin/ folder is the SEPARATE admin website.
// You can point a subdomain like admin.yourdomain.com to this folder.
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../lib/functions.php';

function require_login() {
    if (empty($_SESSION['admin_logged_in'])) {
        header('Location: login.php'); exit;
    }
}
