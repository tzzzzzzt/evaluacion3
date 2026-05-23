<?php
// config/database.php - Funciones CRUD con MySQL
require_once 'db_config.php';

// ==================== BIOGRAFÍA ====================
function getBiografia() {
    return fetchOne("SELECT * FROM biografia WHERE id = 1");
}

function updateBiografia($data) {
    $sql = "UPDATE biografia SET 
            nombre = :nombre,
            titulo = :titulo,
            descripcion = :descripcion,
            descripcion2 = :descripcion2,
            descripcion3 = :descripcion3,
            descripcion4 = :descripcion4,
            imagen = :imagen
            WHERE id = 1";
    
    return executeQuery($sql, $data);
}

// ==================== HABILIDADES ====================
function getHabilidadesAgrupadas() {
    $sql = "SELECT 
                c.id as categoria_id,
                c.nombre as categoria,
                c.orden,
                (SELECT JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'id', h.id,
                        'nombre', h.nombre,
                        'nivel', h.nivel
                    )
                ) FROM habilidades h WHERE h.categoria_id = c.id) as habilidades
            FROM categorias_habilidades c
            ORDER BY c.orden";
    
    return fetchAll($sql);
}

function getCategoriasHabilidades() {
    return fetchAll("SELECT * FROM categorias_habilidades ORDER BY orden");
}

function addCategoria($nombre, $orden = null) {
    if ($orden === null) {
        $orden = getNextCategoriaOrden();
    }
    $sql = "INSERT INTO categorias_habilidades (nombre, orden) VALUES (:nombre, :orden)";
    return insertAndGetId($sql, ['nombre' => $nombre, 'orden' => $orden]);
}

function deleteCategoria($id) {
    $sql = "DELETE FROM categorias_habilidades WHERE id = :id";
    return executeQuery($sql, ['id' => $id]);
}

function addHabilidad($categoria_id, $nombre, $nivel, $orden = null) {
    if ($orden === null) {
        $orden = getNextHabilidadOrden($categoria_id);
    }
    $sql = "INSERT INTO habilidades (categoria_id, nombre, nivel, orden) 
            VALUES (:categoria_id, :nombre, :nivel, :orden)";
    return insertAndGetId($sql, [
        'categoria_id' => $categoria_id,
        'nombre' => $nombre,
        'nivel' => $nivel,
        'orden' => $orden
    ]);
}

function deleteHabilidad($id) {
    $sql = "DELETE FROM habilidades WHERE id = :id";
    return executeQuery($sql, ['id' => $id]);
}

function getNextCategoriaOrden() {
    $result = fetchOne("SELECT MAX(orden) as max_orden FROM categorias_habilidades");
    return ($result['max_orden'] ?? 0) + 1;
}

function getNextHabilidadOrden($categoria_id) {
    $result = fetchOne("SELECT MAX(orden) as max_orden FROM habilidades WHERE categoria_id = :categoria_id", 
                       ['categoria_id' => $categoria_id]);
    return ($result['max_orden'] ?? 0) + 1;
}

// ==================== TECNOLOGÍAS ====================
function getTecnologias() {
    return fetchAll("SELECT * FROM tecnologias ORDER BY orden");
}

function addTecnologia($data) {
    $sql = "INSERT INTO tecnologias (nombre, porcentaje, icono, color, orden) 
            VALUES (:nombre, :porcentaje, :icono, :color, :orden)";
    return insertAndGetId($sql, $data);
}

function updateTecnologia($id, $data) {
    $sql = "UPDATE tecnologias SET 
            nombre = :nombre,
            porcentaje = :porcentaje,
            icono = :icono,
            color = :color
            WHERE id = :id";
    $data['id'] = $id;
    return executeQuery($sql, $data);
}

function deleteTecnologia($id) {
    $sql = "DELETE FROM tecnologias WHERE id = :id";
    return executeQuery($sql, ['id' => $id]);
}

// ==================== PROYECTOS ====================
function getProyectos() {
    return fetchAll("SELECT * FROM proyectos WHERE estado = 'activo' ORDER BY orden");
}

function getAllProyectos() {
    return fetchAll("SELECT * FROM proyectos ORDER BY orden");
}

function addProyecto($data) {
    $sql = "INSERT INTO proyectos (titulo, descripcion, icono, orden, estado) 
            VALUES (:titulo, :descripcion, :icono, :orden, 'activo')";
    return insertAndGetId($sql, $data);
}

function updateProyecto($id, $data) {
    $sql = "UPDATE proyectos SET 
            titulo = :titulo,
            descripcion = :descripcion,
            icono = :icono
            WHERE id = :id";
    $data['id'] = $id;
    return executeQuery($sql, $data);
}

function deleteProyecto($id) {
    $sql = "DELETE FROM proyectos WHERE id = :id";
    return executeQuery($sql, ['id' => $id]);
}

// ==================== USUARIOS ====================
function verificarLogin($username, $password) {
    $sql = "SELECT * FROM usuarios WHERE username = :username AND password = MD5(:password)";
    return fetchOne($sql, ['username' => $username, 'password' => $password]);
}

// ==================== ESTADÍSTICAS ====================
function getDashboardStats() {
    $stats = [
        'total_categorias' => fetchOne("SELECT COUNT(*) as total FROM categorias_habilidades")['total'],
        'total_habilidades' => fetchOne("SELECT COUNT(*) as total FROM habilidades")['total'],
        'total_tecnologias' => fetchOne("SELECT COUNT(*) as total FROM tecnologias")['total'],
        'total_proyectos' => fetchOne("SELECT COUNT(*) as total FROM proyectos")['total']
    ];
    return $stats;
}
?>