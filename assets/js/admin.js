// ============================================
// admin.js - JavaScript del panel administrativo
// ============================================

// Toggle sidebar en móvil
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar) {
        sidebar.classList.toggle('show');
    }
}

// Cerrar sidebar al hacer click en un enlace (móvil)
if (window.innerWidth <= 768) {
    document.querySelectorAll('.admin-sidebar .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.classList.remove('show');
            }
        });
    });
}

// Editar Tecnología
function setupTecnologiaEdicion() {
    document.querySelectorAll('.edit-tecnologia').forEach(btn => {
        btn.addEventListener('click', function() {
            const editId = document.getElementById('edit_id');
            const editNombre = document.getElementById('edit_nombre');
            const editPorcentaje = document.getElementById('edit_porcentaje');
            const editIcono = document.getElementById('edit_icono');
            const editColor = document.getElementById('edit_color');
            
            if (editId) editId.value = this.dataset.id;
            if (editNombre) editNombre.value = this.dataset.nombre;
            if (editPorcentaje) editPorcentaje.value = this.dataset.porcentaje;
            if (editIcono) editIcono.value = this.dataset.icono;
            if (editColor) editColor.value = this.dataset.color;
            
            const modal = document.getElementById('editTecnologiaModal');
            if (modal) {
                new bootstrap.Modal(modal).show();
            }
        });
    });
}

// Editar Proyecto
function setupProyectoEdicion() {
    document.querySelectorAll('.edit-proyecto').forEach(btn => {
        btn.addEventListener('click', function() {
            const editId = document.getElementById('edit_proy_id');
            const editTitulo = document.getElementById('edit_proy_titulo');
            const editDescripcion = document.getElementById('edit_proy_descripcion');
            const editIcono = document.getElementById('edit_proy_icono');
            
            if (editId) editId.value = this.dataset.id;
            if (editTitulo) editTitulo.value = this.dataset.titulo;
            if (editDescripcion) editDescripcion.value = this.dataset.descripcion;
            if (editIcono) editIcono.value = this.dataset.icono;
            
            const modal = document.getElementById('editProyectoModal');
            if (modal) {
                new bootstrap.Modal(modal).show();
            }
        });
    });
}

// Confirmaciones de eliminación
function setupDeleteConfirmations() {
    const deleteButtons = document.querySelectorAll('button[onclick*="confirm"]');
    deleteButtons.forEach(btn => {
        const originalOnclick = btn.getAttribute('onclick');
        if (originalOnclick) {
            btn.removeAttribute('onclick');
            btn.addEventListener('click', (e) => {
                if (confirm(originalOnclick.match(/confirm\(['"](.+?)['"]\)/)?.[1] || '¿Estás seguro de eliminar este elemento?')) {
                    const form = btn.closest('form');
                    if (form) form.submit();
                }
            });
        }
    });
}

// Preview de iconos en tiempo real
function setupIconPreview() {
    const iconInput = document.querySelector('input[name="icono"]');
    if (iconInput) {
        iconInput.addEventListener('input', function() {
            const preview = document.querySelector('.icon-preview');
            if (preview) {
                preview.innerHTML = `<i class="bi bi-${this.value} fs-1"></i>`;
            }
        });
    }
}

// Auto-refresh de estadísticas del dashboard
function refreshDashboardStats() {
    fetch('api/stats.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const statsElements = {
                    'total_categorias': document.querySelector('.stat-categorias'),
                    'total_habilidades': document.querySelector('.stat-habilidades'),
                    'total_tecnologias': document.querySelector('.stat-tecnologias'),
                    'total_proyectos': document.querySelector('.stat-proyectos')
                };
                
                for (const [key, element] of Object.entries(statsElements)) {
                    if (element && data[key]) {
                        element.textContent = data[key];
                    }
                }
            }
        })
        .catch(error => console.error('Error refreshing stats:', error));
}

// Auto-refresh cada 30 segundos si está en dashboard
if (window.location.href.includes('section=dashboard')) {
    setInterval(refreshDashboardStats, 30000);
}

// Función para mostrar notificaciones toast
function showToast(message, type = 'success') {
    const toastContainer = document.getElementById('toast-container');
    if (!toastContainer) return;
    
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0`;
    toast.role = 'alert';
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    toastContainer.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast, { delay: 3000 });
    bsToast.show();
    
    toast.addEventListener('hidden.bs.toast', () => toast.remove());
}

// Validación de formularios en admin
function validateAdminForm(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    return isValid;
}

// Configurar validación en todos los formularios admin
document.querySelectorAll('.admin-content form').forEach(form => {
    form.addEventListener('submit', (e) => {
        if (!validateAdminForm(form)) {
            e.preventDefault();
            showToast('Por favor completa todos los campos requeridos', 'danger');
        }
    });
});

// Eliminar mensajes de error al escribir
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });
});

// Inicializar todas las funcionalidades
document.addEventListener('DOMContentLoaded', () => {
    setupTecnologiaEdicion();
    setupProyectoEdicion();
    setupDeleteConfirmations();
    setupIconPreview();
    
    // Inicializar tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
    
    // Inicializar popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(el => new bootstrap.Popover(el));
    
    // Cerrar alertas automáticamente
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            if (bsAlert) bsAlert.close();
        }, 5000);
    });
});