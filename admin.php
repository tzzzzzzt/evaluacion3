<?php
// admin.php - Panel de administración con MySQL
session_start();
require_once 'database.php';

// Verificar acceso - Protección administrativa
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

$active_section = $_GET['section'] ?? 'dashboard';
$message = '';
$error = '';

// Procesar formularios CRUD
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // ==================== ACTUALIZAR BIOGRAFÍA ====================
    if (isset($_POST['update_biografia'])) {
        try {
            $data = [
                'nombre' => $_POST['nombre'],
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'descripcion2' => $_POST['descripcion2'],
                'descripcion3' => $_POST['descripcion3'],
                'descripcion4' => $_POST['descripcion4'],
                'imagen' => $_POST['imagen']
            ];
            updateBiografia($data);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> Biografía actualizada exitosamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>';
        } catch(Exception $e) {
            $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }
    
    // ==================== AGREGAR CATEGORÍA DE HABILIDAD ====================
    if (isset($_POST['add_categoria'])) {
        try {
            addCategoria($_POST['categoria']);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> Categoría agregada exitosamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>';
        } catch(Exception $e) {
            $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }
    
    // ==================== ELIMINAR CATEGORÍA ====================
    if (isset($_POST['delete_categoria'])) {
        try {
            deleteCategoria($_POST['categoria_id']);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> Categoría eliminada exitosamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>';
        } catch(Exception $e) {
            $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }
    
    // ==================== AGREGAR HABILIDAD ====================
    if (isset($_POST['add_habilidad'])) {
        try {
            addHabilidad($_POST['categoria_id'], $_POST['nombre'], $_POST['nivel']);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> Habilidad agregada exitosamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>';
        } catch(Exception $e) {
            $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }
    
    // ==================== ELIMINAR HABILIDAD ====================
    if (isset($_POST['delete_habilidad'])) {
        try {
            deleteHabilidad($_POST['habilidad_id']);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> Habilidad eliminada exitosamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>';
        } catch(Exception $e) {
            $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }
    
    // ==================== AGREGAR TECNOLOGÍA ====================
    if (isset($_POST['add_tecnologia'])) {
        try {
            $data = [
                'nombre' => $_POST['nombre'],
                'porcentaje' => (int)$_POST['porcentaje'],
                'icono' => $_POST['icono'],
                'color' => $_POST['color'],
                'orden' => null
            ];
            addTecnologia($data);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> Tecnología agregada exitosamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>';
        } catch(Exception $e) {
            $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }
    
    // ==================== EDITAR TECNOLOGÍA ====================
    if (isset($_POST['edit_tecnologia'])) {
        try {
            $data = [
                'nombre' => $_POST['nombre'],
                'porcentaje' => (int)$_POST['porcentaje'],
                'icono' => $_POST['icono'],
                'color' => $_POST['color']
            ];
            updateTecnologia($_POST['tecnologia_id'], $data);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> Tecnología actualizada exitosamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>';
        } catch(Exception $e) {
            $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }
    
    // ==================== ELIMINAR TECNOLOGÍA ====================
    if (isset($_POST['delete_tecnologia'])) {
        try {
            deleteTecnologia($_POST['tecnologia_id']);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> Tecnología eliminada exitosamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>';
        } catch(Exception $e) {
            $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }
    
// ==================== AGREGAR PROYECTO ====================
if (isset($_POST['add_proyecto'])) {
    try {
        $data = [
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'],
            'icono' => $_POST['icono'],
            'github_url' => $_POST['github_url'] ?? null,
            'orden' => null
        ];
        addProyecto($data);
        $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> Proyecto agregado exitosamente
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
    } catch(Exception $e) {
        $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
    }
}

// ==================== EDITAR PROYECTO ====================
if (isset($_POST['edit_proyecto'])) {
    try {
        $data = [
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'],
            'icono' => $_POST['icono'],
            'github_url' => $_POST['github_url'] ?? null
        ];
        updateProyecto($_POST['proyecto_id'], $data);
        $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> Proyecto actualizado exitosamente
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
    } catch(Exception $e) {
        $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
    }
}
    
    // ==================== ELIMINAR PROYECTO ====================
    if (isset($_POST['delete_proyecto'])) {
        try {
            deleteProyecto($_POST['proyecto_id']);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> Proyecto eliminado exitosamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>';
        } catch(Exception $e) {
            $error = '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }
}

// Obtener datos actualizados después de las operaciones CRUD
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
    <title>Panel Administrativo - Mi Portafolio</title>
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
    <!-- Toggle Sidebar Button (Mobile) -->
    <button class="btn btn-primary toggle-sidebar mb-3" onclick="toggleSidebar()">
        <i class="bi bi-list"></i> Menú
    </button>
    
    <!-- Messages -->
    <?php echo $message; ?>
    <?php echo $error; ?>
    
    <!-- Dashboard Section -->
    <?php if ($active_section == 'dashboard'): ?>
        <div class="glass-card">
            <h2 class="mb-4">
                <i class="bi bi-speedometer2 text-primary"></i> 
                Dashboard Administrativo
            </h2>
            <hr>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <div class="stats-icon text-primary">
                            <i class="bi bi-tags"></i>
                        </div>
                        <h3><?php echo $stats['total_categorias']; ?></h3>
                        <p class="text-muted mb-0">Categorías</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <div class="stats-icon text-success">
                            <i class="bi bi-star"></i>
                        </div>
                        <h3><?php echo $stats['total_habilidades']; ?></h3>
                        <p class="text-muted mb-0">Habilidades</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <div class="stats-icon text-info">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <h3><?php echo $stats['total_tecnologias']; ?></h3>
                        <p class="text-muted mb-0">Tecnologías</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <div class="stats-icon text-warning">
                            <i class="bi bi-folder"></i>
                        </div>
                        <h3><?php echo $stats['total_proyectos']; ?></h3>
                        <p class="text-muted mb-0">Proyectos</p>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-info mt-3">
                <i class="bi bi-info-circle"></i> 
                Bienvenido al panel de administración. Aquí puedes gestionar todo el contenido del portafolio en tiempo real.
                Los cambios se guardan automáticamente en la base de datos.
            </div>
        </div>
    
    <!-- Biografía Section -->
    <?php elseif ($active_section == 'biografia'): ?>
        <div class="glass-card">
            <h2 class="mb-4">
                <i class="bi bi-person text-primary"></i> 
                Editar Biografía
            </h2>
            <hr>
            <form method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-person"></i> Nombre
                            </label>
                            <input type="text" name="nombre" class="form-control" 
                                   value="<?php echo htmlspecialchars($biografia['nombre'] ?? ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-briefcase"></i> Título
                            </label>
                            <input type="text" name="titulo" class="form-control" 
                                   value="<?php echo htmlspecialchars($biografia['titulo'] ?? ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-image"></i> Imagen (ruta)
                            </label>
                            <input type="text" name="imagen" class="form-control" 
                                   value="<?php echo htmlspecialchars($biografia['imagen'] ?? 'assets/img/yo.png'); ?>">
                            <small class="text-muted">Ruta relativa desde la raíz del proyecto</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-chat-quote"></i> Descripción 1
                            </label>
                            <textarea name="descripcion" class="form-control" rows="3"><?php echo htmlspecialchars($biografia['descripcion'] ?? ''); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción 2</label>
                            <textarea name="descripcion2" class="form-control" rows="2"><?php echo htmlspecialchars($biografia['descripcion2'] ?? ''); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción 3</label>
                            <textarea name="descripcion3" class="form-control" rows="2"><?php echo htmlspecialchars($biografia['descripcion3'] ?? ''); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción 4</label>
                            <textarea name="descripcion4" class="form-control" rows="2"><?php echo htmlspecialchars($biografia['descripcion4'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" name="update_biografia" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    
    <!-- Habilidades Section -->
    <?php elseif ($active_section == 'habilidades'): ?>
        <div class="glass-card">
            <h2 class="mb-4">
                <i class="bi bi-star text-primary"></i> 
                Gestionar Habilidades
            </h2>
            <hr>
            
            <!-- Botones para agregar -->
            <div class="mb-4">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoriaModal">
                    <i class="bi bi-plus-circle"></i> Agregar Categoría
                </button>
                <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#addHabilidadModal">
                    <i class="bi bi-plus-lg"></i> Agregar Habilidad
                </button>
            </div>
            
            <!-- Lista de categorías y habilidades - SOLO BLOQUES -->
            <div class="row">
                <?php foreach ($habilidades as $categoria): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="categoria-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0 text-primary">
                                    <i class="bi bi-folder"></i> 
                                    <?php echo htmlspecialchars($categoria['categoria']); ?>
                                </h5>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="categoria_id" value="<?php echo $categoria['categoria_id']; ?>">
                                    <button type="submit" name="delete_categoria" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Eliminar esta categoría y todas sus habilidades?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="skills-container">
                                <?php 
                                $habilidadesLista = json_decode($categoria['habilidades'], true);
                                if ($habilidadesLista && is_array($habilidadesLista)):
                                    foreach ($habilidadesLista as $habilidad): 
                                ?>
                                    <div class="skill-item-wrapper">
                                        <span class="skill-badge">
                                            <?php echo htmlspecialchars($habilidad['nombre']); ?>
                                        </span>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="habilidad_id" value="<?php echo $habilidad['id']; ?>">
                                            <button type="submit" name="delete_habilidad" class="btn btn-sm btn-outline-danger delete-skill-btn" 
                                                    onclick="return confirm('¿Eliminar esta habilidad?')">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php 
                                    endforeach;
                                else:
                                ?>
                                    <p class="text-muted">No hay habilidades en esta categoría</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Modal Agregar Categoría -->
        <div class="modal fade" id="addCategoriaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-folder-plus"></i> Agregar Categoría
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nombre de la Categoría</label>
                                <input type="text" name="categoria" class="form-control" required 
                                       placeholder="Ej: Frameworks, Bases de Datos, etc.">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="add_categoria" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Modal Agregar Habilidad -->
        <div class="modal fade" id="addHabilidadModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle"></i> Agregar Habilidad
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Categoría</label>
                                <select name="categoria_id" class="form-control" required>
                                    <option value="">Seleccionar categoría</option>
                                    <?php foreach ($categorias as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>">
                                            <?php echo htmlspecialchars($cat['nombre']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nombre de la Habilidad</label>
                                <input type="text" name="nombre" class="form-control" required 
                                       placeholder="Ej: Laravel, React, MySQL">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nivel (%)</label>
                                <input type="number" name="nivel" class="form-control" min="0" max="100" required 
                                       placeholder="Ej: 85">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="add_habilidad" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    <!-- Tecnologías Section -->
    <?php elseif ($active_section == 'tecnologias'): ?>
        <div class="glass-card">
            <h2 class="mb-4">
                <i class="bi bi-code-slash text-primary"></i> 
                Gestionar Tecnologías
            </h2>
            <hr>
            
            <div class="mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTecnologiaModal">
                    <i class="bi bi-plus-circle"></i> Agregar Tecnología
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tecnología</th>
                            <th>Porcentaje</th>
                            <th>Icono</th>
                            <th>Color</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tecnologias as $index => $tec): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($tec['nombre']); ?></strong>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1" style="height: 8px; width: 120px;">
                                        <div class="progress-bar bg-<?php echo $tec['color']; ?>" 
                                             style="width: <?php echo $tec['porcentaje']; ?>%"></div>
                                    </div>
                                    <span class="ms-2"><?php echo $tec['porcentaje']; ?>%</span>
                                </div>
                            </td>
                            <td>
                                <i class="bi bi-<?php echo $tec['icono']; ?> fs-5"></i>
                                <small class="text-muted"><?php echo $tec['icono']; ?></small>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo $tec['color']; ?>"><?php echo $tec['color']; ?></span>
                            </td>
                            <td class="table-actions">
                                <button class="btn btn-sm btn-primary edit-tecnologia" 
                                        data-id="<?php echo $tec['id']; ?>"
                                        data-nombre="<?php echo htmlspecialchars($tec['nombre']); ?>"
                                        data-porcentaje="<?php echo $tec['porcentaje']; ?>"
                                        data-icono="<?php echo $tec['icono']; ?>"
                                        data-color="<?php echo $tec['color']; ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="tecnologia_id" value="<?php echo $tec['id']; ?>">
                                    <button type="submit" name="delete_tecnologia" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Eliminar esta tecnología?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Modal Agregar Tecnología -->
        <div class="modal fade" id="addTecnologiaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle"></i> Agregar Tecnología
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Porcentaje (0-100)</label>
                                <input type="number" name="porcentaje" class="form-control" min="0" max="100" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Icono Bootstrap</label>
                                <input type="text" name="icono" class="form-control" placeholder="Ej: filetype-html, github">
                                <small class="text-muted">Ver iconos en Bootstrap Icons</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Color</label>
                                <select name="color" class="form-control">
                                    <option value="primary">Azul (primary)</option>
                                    <option value="success">Verde (success)</option>
                                    <option value="danger">Rojo (danger)</option>
                                    <option value="warning">Amarillo (warning)</option>
                                    <option value="info">Celeste (info)</option>
                                    <option value="secondary">Gris (secondary)</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="add_tecnologia" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Modal Editar Tecnología -->
        <div class="modal fade" id="editTecnologiaModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">
                            <i class="bi bi-pencil"></i> Editar Tecnología
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="tecnologia_id" id="edit_id">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Porcentaje</label>
                                <input type="number" name="porcentaje" id="edit_porcentaje" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Icono</label>
                                <input type="text" name="icono" id="edit_icono" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Color</label>
                                <select name="color" id="edit_color" class="form-control">
                                    <option value="primary">Azul</option>
                                    <option value="success">Verde</option>
                                    <option value="danger">Rojo</option>
                                    <option value="warning">Amarillo</option>
                                    <option value="info">Celeste</option>
                                    <option value="secondary">Gris</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="edit_tecnologia" class="btn btn-warning">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    <!-- Proyectos Section -->
    <?php elseif ($active_section == 'proyectos'): ?>
        <div class="glass-card">
            <h2 class="mb-4">
                <i class="bi bi-folder text-primary"></i> 
                Gestionar Proyectos
            </h2>
            <hr>
            
            <div class="mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProyectoModal">
                    <i class="bi bi-plus-circle"></i> Agregar Proyecto
                </button>
            </div>
            
            <!-- Listado de proyectos en admin -->
<div class="row">
    <?php foreach ($proyectos as $proyecto): ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-<?php echo $proyecto['icono']; ?>" style="font-size: 3rem; color: #667eea;"></i>
                    </div>
                    <h5 class="card-title"><?php echo htmlspecialchars($proyecto['titulo']); ?></h5>
                    <p class="card-text text-muted"><?php echo htmlspecialchars($proyecto['descripcion']); ?></p>
                    <?php if (!empty($proyecto['github_url'])): ?>
                        <div class="mb-2">
                            <a href="<?php echo htmlspecialchars($proyecto['github_url']); ?>" 
                               target="_blank" class="text-decoration-none">
                                <i class="bi bi-github"></i> Ver repositorio
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button class="btn btn-sm btn-primary edit-proyecto"
                                data-id="<?php echo $proyecto['id']; ?>"
                                data-titulo="<?php echo htmlspecialchars($proyecto['titulo']); ?>"
                                data-descripcion="<?php echo htmlspecialchars($proyecto['descripcion']); ?>"
                                data-icono="<?php echo $proyecto['icono']; ?>"
                                data-github="<?php echo htmlspecialchars($proyecto['github_url'] ?? ''); ?>">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="proyecto_id" value="<?php echo $proyecto['id']; ?>">
                            <button type="submit" name="delete_proyecto" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Eliminar este proyecto?')">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
        </div>
        
        <!-- Modal Agregar Proyecto -->
<div class="modal fade" id="addProyectoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="bi bi-plus-circle"></i> Agregar Proyecto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icono</label>
                        <input type="text" name="icono" class="form-control" placeholder="Ej: phone, cart, graph-up">
                        <small class="text-muted">Icono de Bootstrap Icons</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-github"></i> URL de GitHub
                        </label>
                        <input type="url" name="github_url" class="form-control" 
                               placeholder="https://github.com/usuario/proyecto">
                        <small class="text-muted">Enlace al repositorio del proyecto</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="add_proyecto" class="btn btn-success">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
        
 <!-- Modal Editar Proyecto -->
<div class="modal fade" id="editProyectoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">
                    <i class="bi bi-pencil"></i> Editar Proyecto
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="proyecto_id" id="edit_proy_id">
                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" id="edit_proy_titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" id="edit_proy_descripcion" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icono</label>
                        <input type="text" name="icono" id="edit_proy_icono" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-github"></i> URL de GitHub
                        </label>
                        <input type="url" name="github_url" id="edit_proy_github" class="form-control" 
                               placeholder="https://github.com/usuario/proyecto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="edit_proyecto" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Admin JS -->
 <script src="assets/js/admin.js"></script>
</body>
</html>