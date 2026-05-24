<?php
// index.php - Página principal del portafolio
session_start();
require_once 'database.php';

// Obtener datos de la base de datos
$biografia = getBiografia();
$habilidades = getHabilidadesAgrupadas();
$tecnologias = getTecnologias();
$proyectos = getProyectos();

$login_error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
$login_success = $_SESSION['login_success'] ?? '';
unset($_SESSION['login_success']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio - Mauricio Inostroza</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary fixed-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="assets/img/sonic.png" width="50px" alt="logo">
            <span class="ms-2">Mi Portafolio</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#biografia"><i class="bi bi-person"></i> Biografia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#habilidades"><i class="bi bi-star"></i> Habilidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tecnologias"><i class="bi bi-code-slash"></i> Tecnologías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#proyectos"><i class="bi bi-folder"></i> Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacto"><i class="bi bi-envelope"></i> Contacto</a>
                </li>
            </ul>
            <button type="button" class="btn btn-outline-light ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="bi bi-box-arrow-in-right"></i> INICIAR SESIÓN
            </button>
        </div>
    </div>
</nav>

<!-- Modal de Login -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-key"></i> Iniciar Sesión</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if ($login_error): ?>
                    <div class="alert alert-danger"><?php echo $login_error; ?></div>
                <?php endif; ?>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>

<main class="py-5" style="margin-top: 56px;">
    <div class="container">
        <!-- Biografía Section -->
        <section id="biografia" class="mb-5 pt-4">
            <h2 class="text-center mb-5">BIOGRAFÍA</h2>
            <div class="row align-items-center">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card shadow-lg text-center bg-primary text-white border-0">
                        <div class="card-body py-4">
                            <?php if ($biografia && $biografia['imagen']): ?>
                                <img src="<?php echo htmlspecialchars($biografia['imagen']); ?>" 
                                     class="rounded-circle mb-3" width="180" height="180"
                                     style="object-fit: cover; border: 4px solid white;" alt="Foto">
                            <?php else: ?>
                                <i class="bi bi-person-circle" style="font-size: 8rem;"></i>
                            <?php endif; ?>
                            <h3 class="mt-3"><?php echo htmlspecialchars($biografia['nombre'] ?? 'Mauricio Inostroza'); ?></h3>
                            <p><?php echo htmlspecialchars($biografia['titulo'] ?? 'Desarrollador Full Stack'); ?></p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="https://github.com/tzzzzzzt" class="text-white"><i class="bi bi-github fs-4"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <p><?php echo nl2br(htmlspecialchars($biografia['descripcion'] ?? '')); ?></p>
                            <p><?php echo nl2br(htmlspecialchars($biografia['descripcion2'] ?? '')); ?></p>
                            <p><?php echo nl2br(htmlspecialchars($biografia['descripcion3'] ?? '')); ?></p>
                            <p><?php echo nl2br(htmlspecialchars($biografia['descripcion4'] ?? '')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Habilidades Section - SOLO BLOQUES, SIN BARRAS -->
        <section id="habilidades" class="mb-5 pt-4">
            <h2 class="text-center mb-5">HABILIDADES Y HERRAMIENTAS</h2>
            <div class="row g-4">
                <?php if ($habilidades && count($habilidades) > 0): ?>
                    <?php foreach ($habilidades as $categoria): ?>
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100 border-0">
                                <div class="card-header bg-primary text-white text-center py-3">
                                    <h3 class="h5 mb-0"><?php echo htmlspecialchars($categoria['categoria']); ?></h3>
                                </div>
                                <div class="card-body text-center">
                                    <?php 
                                    $habilidadesLista = json_decode($categoria['habilidades'], true);
                                    if ($habilidadesLista && is_array($habilidadesLista)):
                                        foreach ($habilidadesLista as $habilidad): 
                                    ?>
                                        <span class="skill-badge">
                                            <?php echo htmlspecialchars($habilidad['nombre']); ?>
                                        </span>
                                    <?php 
                                        endforeach;
                                    endif; 
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <div class="alert alert-info">No hay habilidades cargadas aún.</div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Tecnologías Section -->
        <section id="tecnologias" class="mb-5 pt-4">
            <h2 class="text-center mb-5">TECNOLOGÍAS DOMINADAS</h2>
            <div class="row">
                <?php if ($tecnologias && count($tecnologias) > 0): ?>
                    <?php 
                    $mitad = ceil(count($tecnologias) / 2);
                    $tecnologias_col1 = array_slice($tecnologias, 0, $mitad);
                    $tecnologias_col2 = array_slice($tecnologias, $mitad);
                    ?>
                    <div class="col-md-6">
                        <?php foreach ($tecnologias_col1 as $tecnologia): ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>
                                        <i class="bi bi-<?php echo htmlspecialchars($tecnologia['icono'] ?? 'code-slash'); ?>"></i>
                                        <?php echo htmlspecialchars($tecnologia['nombre']); ?>
                                    </span>
                                    <span class="badge bg-primary"><?php echo $tecnologia['porcentaje']; ?>%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-<?php echo htmlspecialchars($tecnologia['color'] ?? 'primary'); ?>" 
                                         style="width: <?php echo $tecnologia['porcentaje']; ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-6">
                        <?php foreach ($tecnologias_col2 as $tecnologia): ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>
                                        <i class="bi bi-<?php echo htmlspecialchars($tecnologia['icono'] ?? 'code-slash'); ?>"></i>
                                        <?php echo htmlspecialchars($tecnologia['nombre']); ?>
                                    </span>
                                    <span class="badge bg-primary"><?php echo $tecnologia['porcentaje']; ?>%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-<?php echo htmlspecialchars($tecnologia['color'] ?? 'primary'); ?>" 
                                         style="width: <?php echo $tecnologia['porcentaje']; ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <div class="alert alert-info">No hay tecnologías cargadas aún.</div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Proyectos Section -->
        <section id="proyectos" class="mb-5 pt-4">
            <h2 class="text-center mb-5">PROYECTOS DESTACADOS</h2>
            <div class="row g-4">
                <?php if ($proyectos && count($proyectos) > 0): ?>
                    <?php foreach ($proyectos as $proyecto): ?>
                        <div class="col-md-4">
                            <div class="card shadow-sm card-hover h-100 border-0">
                                <div class="proyecto-img">
                                    <i class="bi bi-<?php echo htmlspecialchars($proyecto['icono'] ?? 'folder'); ?>"></i>
                                </div>
                                <div class="card-body">
                                    <h3 class="h5 card-title"><?php echo htmlspecialchars($proyecto['titulo']); ?></h3>
                                    <p class="card-text text-muted"><?php echo htmlspecialchars($proyecto['descripcion']); ?></p>
                                    <a href="#" class="btn btn-primary btn-sm">Ver más <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <div class="alert alert-info">No hay proyectos cargados aún.</div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Contacto Section -->
        <section id="contacto" class="mb-5 pt-4">
            <h2 class="text-center mb-5">CONTACTO</h2>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body p-4">
                            <hr>
                            <div class="mb-3">
                                <i class="bi bi-envelope-fill contacto-icon"></i>
                                <strong>Email:</strong> minostroza2025@alu.uct.cl
                            </div>
                            <div class="mb-3">
                                <i class="bi bi-geo-alt-fill contacto-icon"></i>
                                <strong>Ubicación:</strong> Temuco, Chile
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h4 class="mb-4"><i class="bi bi-send"></i> Envíame un mensaje</h4>
                            <form action="enviar_contacto.php" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mensaje</label>
                                    <textarea name="mensaje" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Enviar Mensaje</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<!-- Footer -->
<footer class="footer py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <img src="assets/img/sonic.png" width="60px" alt="logo">
                <h5 class="mt-3">MAURICIO INOSTROZA</h5>
                <p>Desarrollador Web Full Stack</p>
            </div>
            <div class="col-md-4">
                <h5>Enlaces Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="#biografia" class="text-decoration-none text-white-50">Biografía</a></li>
                    <li><a href="#habilidades" class="text-decoration-none text-white-50">Habilidades</a></li>
                    <li><a href="#tecnologias" class="text-decoration-none text-white-50">Tecnologías</a></li>
                    <li><a href="#proyectos" class="text-decoration-none text-white-50">Proyectos</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contacto</h5>
                <p><i class="bi bi-envelope"></i> minostroza2025@alu.uct.cl</p>
                <p><i class="bi bi-geo-alt"></i> Temuco, Chile</p>
            </div>
        </div>
        <hr class="mt-4 mb-3 bg-secondary">
        <div class="text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> MAURICIO INOSTROZA - Todos los derechos reservados</p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>