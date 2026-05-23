<?php
// logout.php - Cierre de sesión
session_start();
session_destroy();
header('Location: index.php');
exit();
?>