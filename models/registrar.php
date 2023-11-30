<?php

class Trabajador extends Validator
{

    // Declaración de atributos de la tabla proveedor (propiedades).

    private $id = null;
    private $nombre = null;
    private $apellido = null;
    private $nombreusuario = null
    private $correo = null;
    private $telefono = null;
    private $nacimiento = null;
    private $telefono = null;
    private $salario = null;
    private $direccion = null;
    private $tipotrabajador = null;
    private $apellidos = null;
    private $alias = null;
    private $estado = null;

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

   

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNacimiento($value)
    {
        if ($this->validateDate($value)) {
            $this->nacimiento = $value;
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

    public function setSalario($value)
    {
        if ($this->validateMoney($value)) {
            $this->salario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDireccion($value)
    {
        if ($this->validateString($value, 1, 300)) {
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTipotrabajador($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->tipotrabajador = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 200)) {
            $this->apellidos = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAlias($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->alias = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->estado = $value;
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

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getDui()
    {
        return $this->dui;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    
    public function getTipotrabajador()
    {
        return $this->tipotrabajador;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function getEstado()
    {
        return $this->estado;
    }

       /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql =  'SELECT "Id_trabajador", nombres, dui, correo, clave, fecha_nacimiento, telefono, salario, direccion, "Id_tipo_trabajador", apellidos, nomusuario, estado
                FROM "Trabajador" INNER JOIN "Tipo_trabajador" USING("Id_tipo_trabajador")
                WHERE nombres ILIKE ? OR apellidos ILIKE ? OR correo ILIKE ?
                ORDER BY apellidos';
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);

    }

    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO "Trabajador"(nombres, dui, correo, clave, fecha_nacimiento, telefono, salario, direccion, "Id_tipo_trabajador", apellidos, nomusuario, estado)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombres, $this->dui, $this->correo, $hash , $this->nacimiento, $this->telefono, $this->salario , $this->direccion, $this->tipotrabajador, $this->apellidos,  $this->alias, $this->estado );
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT "Id_trabajador", nombres, dui, correo, clave, fecha_nacimiento, telefono, salario, direccion, "Id_tipo_trabajador", apellidos, nomusuario, estado
                FROM "Trabajador" INNER JOIN "Tipo_trabajador" USING("Id_tipo_trabajador")
                ORDER BY apellidos';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT "Id_trabajador", nombres, dui, correo, clave, fecha_nacimiento, telefono, salario, direccion, "Id_tipo_trabajador", apellidos, nomusuario, estado
                FROM "Trabajador"
                WHERE "Id_trabajador" = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE "Trabajador"
                SET nombres =?, dui=?, correo=?, clave=?, fecha_nacimiento=?, telefono=?, salario=?, direccion=?, "Id_tipo_trabajador"=?, apellidos=?, nomusuario=?, estado=?
                WHERE "Id_trabajador" = ?';
        $params = array($this->nombres, $this->dui, $this->correo, $this->clave, $this->nacimiento, $this->telefono, $this->salario , $this->direccion, $this->tipotrabajador, $this->apellidos,  $this->alias, $this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM "Trabajador"
                WHERE "Id_trabajador" = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    //Funciones para login
    public function checkUser($alias)
    {
        $sql = 'SELECT id_usuario FROM usuarios WHERE alias_usuario = ?';
        $params = array($alias);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_usuario'];
            $this->alias = $alias;
            return true;
        } else {
            return false;
        }
    }

    public function checkUsuario($nomusuario , $password)
    {
        $sql = 'SELECT clave , nomusuario , Id_trabajador FROM "Trabajadores" WHERE nomusuario = ?';
        $params = array($nomusuario);
        $data = Database::getRow($sql, $params);
        $this->id = $data['Id_trabajador'];
        // Se verifica si la contraseña coincide con el hash almacenado en la base de datos.
        if (password_verify($password, $data['clave'])) {
            return true;
        } else {
            return false;
        }
    }

}