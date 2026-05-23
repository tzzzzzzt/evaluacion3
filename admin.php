<?php
// admin.php - Panel de administración
session_start();
require_once 'database.php';

// Verificar acceso
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

$active_section = $_GET['section'] ?? 'dashboard';
$message = '';
$error = '';

// Procesar formularios CRUD (mismo código que antes)
// ... (mantener toda la lógica PHP igual)

// Obtener datos
$biografia = getBiografia();
$categorias = getCategoriasHabilidades();
$habilidades = getHabilidadesAgrupadas();
$tecnologias = getTecnologias();
$proyectos = getAllProyectos();
$stats = getDashboardStats();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Admin CSS -->
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<!-- Sidebar -->
<div class="admin-sidebar" id="sidebar">
    <div class="user-info">
        <img src="assets/img/sonic.png" alt="Avatar" class="user-avatar">
        <h6 class="mb-1"><?php echo htmlspecialchars($_SESSION['username']); ?></h6>
        <small class="text-white-50">Administrador</small>
    </div>
    <nav class="nav flex-column mt-3">
        <a class="nav-link <?php echo $active_section == 'dashboard' ? 'active' : ''; ?>" href="?section=dashboard">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a class="nav-link <?php echo $active_section == 'biografia' ? 'active' : ''; ?>" href="?section=biografia">
            <i class="bi bi-person"></i> Biografía
        </a>
        <a class="nav-link <?php echo $active_section == 'habilidades' ? 'active' : ''; ?>" href="?section=habilidades">
            <i class="bi bi-star"></i> Habilidades
        </a>
        <a class="nav-link <?php echo $active_section == 'tecnologias' ? 'active' : ''; ?>" href="?section=tecnologias">
            <i class="bi bi-code-slash"></i> Tecnologías
        </a>
        <a class="nav-link <?php echo $active_section == 'proyectos' ? 'active' : ''; ?>" href="?section=proyectos">
            <i class="bi bi-folder"></i> Proyectos
        </a>
        <hr class="mx-3 my-2 bg-secondary">
        <a class="nav-link text-danger" href="logout.php">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </a>
    </nav>
</div>

<!-- Main Content -->
<div class="admin-content">
    <button class="btn btn-primary toggle-sidebar mb-3" onclick="toggleSidebar()">
        <i class="bi bi-list"></i> Menú
    </button>
    
    <?php echo $message; ?>
    <?php echo $error; ?>
    
    <!-- Contenido según sección (igual que antes pero sin estilos inline) -->
    <!-- ... mantener el mismo HTML pero eliminando todos los style="" inline ... -->
    
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Admin JS -->
<script src="assets/js/admin.js"></script>
</body>
</html>