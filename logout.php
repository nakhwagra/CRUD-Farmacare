<?php
session_start();

// Menghapus semua sesi
$_SESSION = array();

// Menghancurkan sesi
session_destroy();

// Redirect ke halaman login
header("Location: formlogin.php");
exit;
?>
