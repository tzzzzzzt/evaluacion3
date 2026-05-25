-- =============================================
-- PORTFOLIO DATABASE
-- Base de datos para sistema de portafolio
-- =============================================

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS minostroza_db1;
USE minostroza_db1;

-- =============================================
-- TABLA: usuarios
-- Para el sistema de autenticación
-- =============================================
CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    rol ENUM('admin', 'editor', 'lector') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insertar usuario administrador por defecto
-- Contraseña: 123456 (encriptada con MD5 - para ejemplo)
INSERT INTO usuarios (username, password, email, rol) VALUES 
('admin', MD5('123456'), 'admin@portfolio.com', 'admin');

-- =============================================
-- TABLA: biografia
-- Almacena la información de la biografía
-- =============================================
CREATE TABLE IF NOT EXISTS biografia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    titulo VARCHAR(200),
    descripcion TEXT,
    descripcion2 TEXT,
    descripcion3 TEXT,
    descripcion4 TEXT,
    imagen VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insertar biografía inicial
INSERT INTO biografia (nombre, titulo, descripcion, descripcion2, descripcion3, descripcion4, imagen) VALUES 
('Mauricio Inostroza', 
 'Desarrollador Full Stack',
 'Soy un desarrollador web apasionado por la tecnología y la creación de soluciones innovadoras. Con más de 20 años de experiencia en el desarrollo de aplicaciones web, me especializo en crear experiencias digitales únicas y funcionales.',
 'Mi viaje en el mundo de la programación comenzó cuando descubrí mi alto coeficiente intelectual de más de 1020319203120321030210 dígitos.',
 'A lo largo de mi carrera, he trabajado con diversas empresas y startups como google facebook steam y sony tambien hice la playstation 2 de hecho fue mi idea.',
 'me gusta sonic y tf2',
 'assets/img/yo.png'
);

-- =============================================
-- TABLA: categorias_habilidades
-- Categorías para agrupar habilidades
-- =============================================
CREATE TABLE IF NOT EXISTS categorias_habilidades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    orden INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar categorías iniciales
INSERT INTO categorias_habilidades (nombre, orden) VALUES 
('Frontend', 1),
('Backend', 2),
('Herramientas', 3);

-- =============================================
-- TABLA: habilidades
-- Almacena cada habilidad individual
-- =============================================
CREATE TABLE IF NOT EXISTS habilidades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    categoria_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    nivel INT DEFAULT 0,
    orden INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias_habilidades(id) ON DELETE CASCADE
);

-- Insertar habilidades iniciales
-- Frontend (categoria_id = 1)
INSERT INTO habilidades (categoria_id, nombre, nivel, orden) VALUES 
(1, 'HTML5', 90, 1),
(1, 'CSS3', 90, 2),
(1, 'JavaScript', 85, 3),
(1, 'React', 70, 4),
(1, 'Vue.js', 65, 5);

-- Backend (categoria_id = 2)
INSERT INTO habilidades (categoria_id, nombre, nivel, orden) VALUES 
(2, 'PHP', 60, 1),
(2, 'Python', 75, 2),
(2, 'Node.js', 70, 3),
(2, 'MySQL', 85, 4),
(2, 'MongoDB', 65, 5);

-- Herramientas (categoria_id = 3)
INSERT INTO habilidades (categoria_id, nombre, nivel, orden) VALUES 
(3, 'GitHub', 85, 1),
(3, 'Bootstrap', 80, 2),
(3, 'Docker', 60, 3),
(3, 'AWS', 55, 4),
(3, 'Figma', 70, 5);

-- =============================================
-- TABLA: tecnologias
-- Tecnologías con porcentajes de dominio
-- =============================================
CREATE TABLE IF NOT EXISTS tecnologias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    porcentaje INT DEFAULT 0,
    icono VARCHAR(50),
    color VARCHAR(20),
    orden INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insertar tecnologías iniciales
INSERT INTO tecnologias (nombre, porcentaje, icono, color, orden) VALUES 
('HTML5', 90, 'filetype-html', 'danger', 1),
('CSS3', 90, 'filetype-css', 'primary', 2),
('JavaScript', 85, 'filetype-js', 'warning', 3),
('PHP', 60, 'filetype-php', 'info', 4),
('Bootstrap', 70, 'bootstrap', 'primary', 5),
('GitHub', 85, 'github', 'secondary', 6),
('Git', 82, 'git', 'danger', 7),
('MySQL', 85, 'database', 'success', 8),
('MongoDB', 65, 'database', 'warning', 9),
('Docker', 60, 'box', 'secondary', 10);

-- =============================================
-- TABLA: proyectos
-- Proyectos del portafolio
-- =============================================
CREATE TABLE IF NOT EXISTS proyectos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT,
    icono VARCHAR(50),
    github_url VARCHAR(500),
    imagen VARCHAR(255),
    url VARCHAR(500),
    tecnologias TEXT,
    orden INT DEFAULT 0,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insertar proyectos iniciales
INSERT INTO proyectos (titulo, descripcion, icono, github_url, orden) VALUES 
('English Project', 'el mejor fokin proyecto del universo q hice yo solito', 'phone', 'https://github.com/tzzzzzzt/EnglishProject11', 1),
('Proyecto Gestor de Tareas', 'una prueba', 'cart', 'https://github.com/tzzzzzzt/proyecto_tareas_gestor', 2),
('Proyecto MirandaPet', 'mirandapet volvera', 'graph-up', 'https://github.com/tareasmiranda/mirandapet',3);


-- =============================================
-- TABLA: contacto_mensajes
-- Para almacenar mensajes del formulario de contacto
-- =============================================
CREATE TABLE IF NOT EXISTS contacto_mensajes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    asunto VARCHAR(200),
    mensaje TEXT,
    leido BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- VISTAS ÚTILES
-- =============================================

-- Vista: habilidades_por_categoria
CREATE OR REPLACE VIEW vista_habilidades AS
SELECT 
    c.id as categoria_id,
    c.nombre as categoria,
    c.orden as categoria_orden,
    h.id as habilidad_id,
    h.nombre as habilidad,
    h.nivel,
    h.orden as habilidad_orden
FROM categorias_habilidades c
LEFT JOIN habilidades h ON c.id = h.categoria_id
ORDER BY c.orden, h.orden;

-- =============================================
-- PROCEDIMIENTOS ALMACENADOS
-- =============================================

DELIMITER //

-- Procedimiento para obtener todas las habilidades agrupadas
CREATE PROCEDURE sp_get_habilidades_agrupadas()
BEGIN
    SELECT 
        c.id as categoria_id,
        c.nombre as categoria,
        JSON_ARRAYAGG(
            JSON_OBJECT(
                'id', h.id,
                'nombre', h.nombre,
                'nivel', h.nivel
            )
        ) as habilidades
    FROM categorias_habilidades c
    LEFT JOIN habilidades h ON c.id = h.categoria_id
    GROUP BY c.id, c.nombre
    ORDER BY c.orden;
END//

-- Procedimiento para obtener estadísticas del dashboard
CREATE PROCEDURE sp_get_dashboard_stats()
BEGIN
    SELECT 
        (SELECT COUNT(*) FROM categorias_habilidades) as total_categorias,
        (SELECT COUNT(*) FROM habilidades) as total_habilidades,
        (SELECT COUNT(*) FROM tecnologias) as total_tecnologias,
        (SELECT COUNT(*) FROM proyectos) as total_proyectos,
        (SELECT COUNT(*) FROM usuarios WHERE rol = 'admin') as total_admins;
END//

DELIMITER ;

-- =============================================
-- TRIGGERS
-- =============================================

-- Trigger para actualizar timestamp
DELIMITER //
CREATE TRIGGER before_update_biografia 
BEFORE UPDATE ON biografia
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER before_update_tecnologias 
BEFORE UPDATE ON tecnologias
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER before_update_proyectos 
BEFORE UPDATE ON proyectos
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END//

DELIMITER ;

CREATE INDEX idx_usuarios_username ON usuarios(username);
CREATE INDEX idx_habilidades_categoria ON habilidades(categoria_id);
CREATE INDEX idx_proyectos_estado ON proyectos(estado);
CREATE INDEX idx_contacto_leido ON contacto_mensajes(leido);