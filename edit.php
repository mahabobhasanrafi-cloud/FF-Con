<?php
require __DIR__ . '/auth.php'; require_login();
$id = $_GET['id'] ?? '';
$p = $id !== '' ? find_project($id) : null;
$isEdit = $p !== null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) die('Invalid CSRF token');
    $projects = load_projects();
    $item = [
        'id' => $isEdit ? $p['id'] : (count($projects) ? max(array_column($projects,'id'))+1 : 1),
        'title' => trim($_POST['title'] ?? ''),
        'category' => trim($_POST['category'] ?? 'Tools'),
        'version' => trim($_POST['version'] ?? '1.0'),
        'badge' => trim($_POST['badge'] ?? '100% Free'),
        'description' => trim($_POST['description'] ?? ''),
        'link' => trim($_POST['link'] ?? '#'),
        'active' => isset($_POST['active']),
    ];
    if ($item['title'] === '') die('Title is required');
    if ($isEdit) { foreach($projects as &$x) if($x['id']===$p['id']) $x=$item; unset($x); }
    else $projects[] = $item;
    save_projects($projects);
    header('Location: index.php'); exit;
}
$p = $p ?? ['title'=>'','category'=>'Tools','version'=>'1.0','badge'=>'100% Free','description'=>'','link'=>'#','active'=>true];
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= $isEdit?'Edit':'Add' ?> Project</title><link rel="stylesheet" href="admin.css"></head><body>
<header><b><?= $isEdit?'Edit':'Add' ?> Project</b><a href="index.php">← Dashboard</a></header>
<main><form method="post" class="form">
<input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
<label>Title<input name="title" value="<?= e($p['title']) ?>" required></label>
<label>Category<input name="category" value="<?= e($p['category']) ?>" placeholder="Resource / Apk / BOT / Tools / Security"></label>
<label>Version<input name="version" value="<?= e($p['version'] ?? '1.0') ?>"></label>
<label>Badge<input name="badge" value="<?= e($p['badge'] ?? '100% Free') ?>"></label>
<label>Description<textarea name="description" rows="3"><?= e($p['description']) ?></textarea></label>
<label>VIEW Link (URL)<input name="link" value="<?= e($p['link']) ?>"></label>
<label class="check"><input type="checkbox" name="active" <?= $p['active']?'checked':'' ?>> Active (show on website)</label>
<button type="submit">Save Project</button>
</form></main></body></html>
