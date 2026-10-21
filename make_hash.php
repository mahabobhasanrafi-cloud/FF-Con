<?php
// Open ONCE in browser: make_hash.php?pw=YourNewPassword
// Copy the hash into config.php -> admin_pass_hash, then DELETE this file.
if (!isset($_GET['pw'])) die('Add ?pw=YourNewPassword to the URL');
echo password_hash($_GET['pw'], PASSWORD_DEFAULT);
