// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_USUARIO = '../api/registrar.php?action=';


// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_USUARIO);
});



// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    document.getElementById('save-form').reset();
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    document.getElementById('modal-title').textContent = 'Registrar trabajador';    
}



// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    event.preventDefault();
    let action = '';
    if (document.getElementById('id').value) {
        action = 'update';
    } else {
        action = 'create';
    }
    saveRow(API_TRABAJADOR, action, 'save-form', 'save-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {   
    const data = new FormData();
    data.append('id', id);
    confirmDelete(API_USUARIO, data);
}