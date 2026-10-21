<?php
require __DIR__ . '/auth.php'; require_login();
$cfg = config(); $projects = load_projects(); $cats = categories($projects);
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Dashboard</title><link rel="stylesheet" href="admin.css"></head><body>
<header><b>Admin — <?= e($cfg['site_name']) ?></b><span><a href="../index.php" target="_blank">View Site</a> · <a href="logout.php">Logout</a></span></header>
<main>
  <div class="stats"><div>Total Projects<b><?= count($projects) ?></b></div><div>Categories<b><?= count($cats) ?></b></div></div>
  <p><a class="btn" href="edit.php">+ Add New Project</a></p>
  <table><tr><th>ID</th><th>Title</th><th>Category</th><th>Version</th><th>Active</th><th>Action</th></tr>
  <?php foreach($projects as $p): ?>
    <tr><td><?= e($p['id']) ?></td><td><?= e($p['title']) ?></td><td><?= e($p['category']) ?></td><td><?= e($p['version'] ?? '') ?></td>
    <td><?= (!isset($p['active'])||$p['active'])?'Yes':'No' ?></td>
    <td><a href="edit.php?id=<?= e($p['id']) ?>">Edit</a> ·
        <a href="delete.php?id=<?= e($p['id']) ?>&csrf=<?= e(csrf_token()) ?>" onclick="return confirm('Delete this project?')">Delete</a></td></tr>
  <?php endforeach; ?>
  </table>
</main></body></html>
