<?php
function config() {
    static $cfg = null;
    if ($cfg === null) $cfg = require __DIR__ . '/../config.php';
    return $cfg;
}
function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function data_file() { return __DIR__ . '/../data/projects.json'; }

function load_projects() {
    $f = data_file();
    if (!file_exists($f)) return [];
    $data = json_decode(file_get_contents($f), true);
    return is_array($data) ? $data : [];
}
function save_projects($projects) {
    $f = data_file();
    file_put_contents($f, json_encode(array_values($projects), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function active_projects() {
    return array_values(array_filter(load_projects(), fn($p) => !isset($p['active']) || $p['active']));
}
function categories($projects) {
    $cats = [];
    foreach ($projects as $p) if (!empty($p['category'])) $cats[$p['category']] = true;
    return array_keys($cats);
}
function find_project($id) {
    foreach (load_projects() as $p) if ((string)$p['id'] === (string)$id) return $p;
    return null;
}
function csrf_token() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}
function csrf_check() {
    return isset($_POST['csrf']) && hash_equals(csrf_token(), $_POST['csrf']);
}
