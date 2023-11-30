<?php

class Usuario extends Validator
{

    // Declaración de atributos de la tabla proveedor (propiedades).

    private $id = null;
    private $nombre = null;
    private $apellido = null;
    private $nombreusuario = null
    private $correo = null;
    private $telefono = null;


        /*
    *   Métodos para dar (guardarlos) valores a los atributos.
    */

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value)
    {
        if ($this->validateAlphabetic($value, 1, 200)) {
            $this->nombres = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setApellido($value)
    {
        if ($this->validateAlphabetic($value, 1, 200)) {
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombreUsuario($value)
    {
        if ($this->validateAlphabetic($value, 1, 200)) {
            $this->nombreusuario = $value;
            return true;
        } else {
            return false;
        }
    }
   

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefono = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setContraseña($value)
    {
        if ($this->validatePassword($value)) {
            $this->contraseña = $value;
            return true;
        } else {
            return false;
        }
    }

 
        /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getNombreUsuario()
    {
        return $this->nombreusuario;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }


       /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */


    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO "usuario"(nombre, apellido, nombreusuario, correo, telefono, contraseña)
                VALUES(?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->apellido, $this->nombreusuario, $this->correo, $this->telefono, $this->contraseña);
        return Database::executeRow($sql, $params);
    }


}