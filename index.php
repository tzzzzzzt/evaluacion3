<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio Evaluacion 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
 
</head>
<body>

<?php
// Lógica de inicio de sesión
session_start();

$login_error = '';
$login_success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Credenciales de ejemplo
    if ($username == 'admin' && $password == '123456') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $login_success = 'Inicio de sesión exitoso!';
    } else {
        $login_error = 'Usuario o contraseña incorrectos';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}






$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <img src="assets/img/sonic.png" width="100px"  alt="hola">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#biografia">Biografia</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#habilidades">Habilidades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#herramientas">Herramientas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#proyectos">Proyectos</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Hero / Logo Section -->
<div class="hero-section text-center">
    <div class="container">
        <h1 class="display-4">Mauricio Inostroza</h1>
        <p class="lead">Desarrollador Web Full Stack</p>
        <i class="bi bi-code-slash" style="font-size: 3rem;"></i>
    </div>
</div>

<main class="py-5">
    <div class="container">
        
        <!-- Biografía Section -->
        <section id="biografia" class="mb-5">
            <h2 class="text-center mb-4" style="color: #667eea;">BIOGRAFÍA</h2>
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">loeprelpoakfpoaskfpdsnfkdsanvkndavkcnxkvnkcx.</p>
                            <p class="card-text">loremipsumbablablablablablablablablablblbalba</p>
                            <p class="card-text">blabalblablablablabalblabalbalbalbalbalbalbalbalbalbalaba</p>
                            <p class="card-text">me gusta sonic y tf2</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm text-center bg-primary text-white">
                        <div class="card-body">
                            <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                            <h3 class="mt-3">Mauricio Inostroza</h3>
                            <p>Desarrollador Full Stack</p>
                            <i class="bi bi-github fs-3 me-2"></i>
                            <i class="bi bi-linkedin fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Habilidades Section -->
        <section id="habilidades" class="mb-5">
            
            <h2 class="text-center mb-4" style="color: #667eea;">HABILIDADES Y HERRAMIENTAS</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white text-center">
                            <h3 class="h5 mb-0">Frontend</h3>
                        </div>
                        <div class="card-body text-center">
                            <span class="badge bg-secondary skill-badge">HTML5</span>
                            <span class="badge bg-secondary skill-badge">CSS3</span>
                            <span class="badge bg-secondary skill-badge">JavaScript</span>
                            <span class="badge bg-secondary skill-badge">React</span>
                            <span class="badge bg-secondary skill-badge">Vue.js</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white text-center">
                            <h3 class="h5 mb-0">Backend</h3>
                        </div>
                        <div class="card-body text-center">
                            <span class="badge bg-secondary skill-badge">PHP</span>
                            <span class="badge bg-secondary skill-badge">Python</span>
                            <span class="badge bg-secondary skill-badge">Node.js</span>
                            <span class="badge bg-secondary skill-badge">MySQL</span>
                            <span class="badge bg-secondary skill-badge">MongoDB</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white text-center">
                            <h3 class="h5 mb-0">Herramientas</h3>
                        </div>
                        <div class="card-body text-center">
                            <span class="badge bg-secondary skill-badge">GitHub</span>
                            <span class="badge bg-secondary skill-badge">Bootstrap</span>
                            <span class="badge bg-secondary skill-badge">Docker</span>
                            <span class="badge bg-secondary skill-badge">AWS</span>
                            <span class="badge bg-secondary skill-badge">Figma</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<section id="tecnologias" class="mb-5">
    <h2 class="text-center mb-4" style="color: #667eea;">TECNOLOGÍAS DOMINADAS</h2>
    
    <div class="row g-4">
        <!-- Columna 1 -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="h5 mb-3">Lenguajes de Programación</h3>
                    
                    <!-- HTML -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-filetype-html text-danger"></i> HTML5</span>
                            <span class="badge bg-primary">2%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- CSS -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-filetype-css text-primary"></i> CSS3</span>
                            <span class="badge bg-primary">90%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- JavaScript -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-filetype-js text-warning"></i> JavaScript</span>
                            <span class="badge bg-primary">85%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- PHP -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-filetype-php text-info"></i> PHP</span>
                            <span class="badge bg-primary">80%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Columna 2 -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="h5 mb-3">Frameworks & Herramientas</h3>
                    
                    <!-- Bootstrap -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-bootstrap-fill text-primary"></i> Bootstrap</span>
                            <span class="badge bg-primary">88%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- GitHub -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-github"></i> GitHub</span>
                            <span class="badge bg-primary">85%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- Git -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-git text-danger"></i> Git</span>
                            <span class="badge bg-primary">82%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- jQuery -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-code-square"></i> jQuery</span>
                            <span class="badge bg-primary">75%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Columna 3 (Opcional - más tecnologías) -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="h5 mb-3">Bases de Datos</h3>
                    
                    <!-- MySQL -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-database"></i> MySQL</span>
                            <span class="badge bg-primary">85%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- PostgreSQL -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-database"></i> PostgreSQL</span>
                            <span class="badge bg-primary">70%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- MongoDB -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-database"></i> MongoDB</span>
                            <span class="badge bg-primary">65%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Columna 4 -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="h5 mb-3">Otras Tecnologías</h3>
                    
                    <!-- React -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-braces"></i> React</span>
                            <span class="badge bg-primary">70%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- Node.js -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-node-plus"></i> Node.js</span>
                            <span class="badge bg-primary">75%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <!-- Docker -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="bi bi-box"></i> Docker</span>
                            <span class="badge bg-primary">60%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <!-- Proyectos Section -->
        <section id="proyectos" class="mb-5">
            <h2 class="text-center mb-4" style="color: #667eea;">PROYECTOS</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm card-hover h-100">
                        <div class="proyecto-img">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 card-title">PROYECTO 1</h3>
                            <p class="card-text">el mejor fokin proyecto del univelso</p>
                            <a href="#" class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm card-hover h-100">
                        <div class="proyecto-img">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 card-title">PROYECTO 2</h3>
                            <p class="card-text">hola </p>
                            <a href="#" class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm card-hover h-100">
                        <div class="proyecto-img">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 card-title">PROYECTO 3</h3>
                            <p class="card-text">anuncio de futura presidencia</p>
                            <a href="#" class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Iniciar Sesión Section -->
        <?php if (!$is_logged_in): ?>
        <section id="login" class="mb-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h3 class="h5 mb-0">INICIAR SESIÓN</h3>
                        </div>
                        <div class="card-body">
                            <?php if ($login_error): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo htmlspecialchars($login_error); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            <?php if ($login_success): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo htmlspecialchars($login_success); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="admin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="123456" required>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary w-100">Iniciar Sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php else: ?>
        <section class="mb-5">
            <div class="alert alert-success text-center" role="alert">
                <i class="bi bi-check-circle-fill fs-3"></i>
                <h4 class="mt-2">¡Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h4>
                <p>Has iniciado sesión correctamente.</p>
            </div>
        </section>
        <?php endif; ?>
        
    </div>
</main>

<!-- Footer -->
<footer class="footer py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h4>MAURICIO INOSTROZA</h4>
                <p>Desarrollador Web Full Stack</p>
                <p>Transformando ideas en código</p>
                <i class="bi bi-code-slash fs-3"></i>
            </div>
            <div class="col-md-4">
                <h4>CONTACTO</h4>
                <p><i class="bi bi-envelope"></i> mauricio@inostroza.com</p>
                <p><i class="bi bi-telephone"></i> +56 9 1234 5678</p>
                <p><i class="bi bi-geo-alt"></i> Santiago, Chile</p>
            </div>
            <div class="col-md-4">
                <h4>SÍGUEME</h4>
                <div class="social-icons">
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-github"></i></a>
                </div>
                <div class="mt-3">
                    <p><i class="bi bi-envelope"></i> contacto@mauricio.cl</p>
                </div>
            </div>
        </div>
        <hr class="mt-4 mb-3 bg-light">
        <div class="text-center">
            <p class="mb-0">COPYRIGHT © 2024 MAURICIO INOSTROZA - Todos los derechos reservados</p>
            <p class="mt-2">
                <i class="bi bi-instagram"></i> INSTAGRAM &nbsp;|&nbsp;
                <i class="bi bi-facebook"></i> FACEBOOK &nbsp;|&nbsp;
                <i class="bi bi-envelope"></i> CONTACTO
            </p>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Smooth scroll para los enlaces
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Tooltips initialization (opcional)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>

</body>
</html>