<?php
require_once('../helpers/database.php');
require_once('../models/registrar.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    //session_start();
    $registrouser = new Registrouser;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    //if (isset($_SESSION['id_usuario'])) {
    // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
    switch ($_GET['action']) {
        case 'readAll': //Método para mostras todos los registros
            if ($result['dataset'] = $registrouser->readAll()) {
                $result['status'] = 1;
            } else {
                if (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay usuarios registrados';
                }
            }
            break;
        case 'search': //Método para buscar
            $registrouser->validateForm($_POST);
            if ($_POST['search'] != '') {
                if ($result['dataset'] = $registrouser->searchRows($_POST['search'])) {
                    $result['status'] = 1;
                    $rows = count($result['dataset']);
                    if ($rows > 1) {
                        $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                    } else {
                        $result['message'] = 'Solo existe una coincidencia';
                    }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                }
            } else {
                $result['exception'] = 'Ingrese un valor para buscar';
            }
            break;
            case 'create': // Método para ingresar datos.
                $_POST = $registrouser->validateForm($_POST);
                if ($registrouser->setNombre($_POST['nombre'])) {
                    if ($registrouser->setApellido($_POST['apellido'])) {
                        if ($registrouser->setUsuario($_POST['nombreusuario'])) {
                            if ($registrouser->setCorreo($_POST['correo'])) {
                                if ($registrouser->setTelefono($_POST['telefono'])) {
                                    if ($registrouser->createRow()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Usuario creado correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
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
            
        case 'readOne': //Método para tomar los datos de cada registro y mostrarlos al momento de actualizar y el id para eliminar
            if ($cliente->setId($_POST['id_usuario'])) {
                if ($result['dataset'] = $cliente->readOne()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Cliente inexistente';
                    }
                }
            } else {
                $result['exception'] = 'Cliente incorrecto';
            }
            break;
        case 'update': //Método para actualizar un registro
            $_POST = $cliente->validateForm($_POST);
            if ($cliente->setId($_POST['id_usuario'])) {
                if ($cliente->readOne()) {
                    if ($cliente->setNombre($_POST['nombre'])) {
                        if ($cliente->setApellido($_POST['apellido'])) {
                            if ($cliente->setUsuario($_POST['nombreusuario'])) {
                                if ($cliente->setCorreo($_POST['correo'])) {
                                    if ($cliente->setTelefono($_POST['telefono'])) {
                                        if ($cliente->setFlog($_POST['fecha_login'])) {                                                    
                                            if ($cliente->updateRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Cliente modificado correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                            }
                                        } else {
                                            $result['exception'] = 'Fecha de login incorrecta';
                                        }
                                    } else {
                                        $result['exception'] = 'Teléfono incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Usuario incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Apellido incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Nombre incorrecto';
                    }
                } else {
                    $result['exception'] = 'Cliente inexistente';
                }
            } else {
                $result['exception'] = 'Cliente incorrecto';
            }
            break;

        case 'delete': // METODO PARA ELIMINAR UN REGISTRO 
            $_POST = $cliente->validateForm($_POST);
            if ($cliente->setId($_POST['id_usuario'])) {
                if ($data = $cliente->readOne()) {
                    if ($cliente->deleteRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Usuario eliminado correctamente';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'Usuario inexistente';
                }
            } else {
                $result['exception'] = 'Usuario incorrecto';
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