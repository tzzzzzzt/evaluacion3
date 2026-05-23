<?php
// login.php - Procesamiento de login con MySQL
session_start();
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $usuario = verificarLogin($username, $password);
    
    if ($usuario) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $usuario['username'];
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_rol'] = $usuario['rol'];
        header('Location: admin.php');
        exit();
    } else {
        $_SESSION['login_error'] = 'Usuario o contraseña incorrectos';
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>