<?php
require_once('../helpers/database.php');
require_once('../models/registrar.php');
require_once('../helpers/validator.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    //session_start();
    $registrouser = new Registrouser;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    //if (isset($_SESSION['id_usuario'])) {
    // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
    switch ($_GET['action']) {
       
            case 'create': // Método para ingresar datos.
                $_POST = $registrouser->validateForm($_POST);
                if ($registrouser->setNombre($_POST['nombre'])) {
                    if ($registrouser->setApellido($_POST['apellido'])) {
                        if ($registrouser->setUsuario($_POST['nombreusuario'])) {
                            if ($registrouser->setCorreo($_POST['correo'])) {
                                if ($registrouser->setTelefono($_POST['telefono'])) {
                                    if ($registrouser->setTelefono($_POST['contraseña'])) {
                                        if ($registrouser->createRow()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Usuario creado correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                    $result['exception'] = 'Contraseña incorrecto';
                                        }
                                } else {
                                    $result['exception'] = 'Teléfono incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Correo incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Nombre de usuario incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellido incorrecto';
                    }
                } else {
                    $result['exception'] = 'Nombre incorrecto';
                }
                break;            
            
       
        default: // SI LA ACCION NO COINCIDE CON NINGUNO DE LOS CASOS MUESTRA ESTE MENSAJE
            $result['exception'] = 'Acción no disponible dentro de la sesión';
    }
    header('content-type: application/json; charset=utf-8');
    print(json_encode($result));
 //   } else {
       // print(json_encode('Acceso denegado'));
 //   }
} else {
    print(json_encode('Recurso no disponible'));
}