<?php

include "Conexion.php";

class Usuario {

    private $usuario;
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $contra;
    private $correo;

    public function __construct()
    {
        $this->usuario = "";
        $this->nombre = "";
        $this->primerApellido = "";
        $this->segundoApellido = "";
        $this->contra = "";
        $this->correo = "";
    }

    public function registro($usuario, $nombre, $primerApellido, $segundoApellido, $contra, $correo) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "insert into Usuarios (Usuario, nombre, primerApellido, 
        segundoApellido, contraseña, correo) values (?,?,?,?,?,?)";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("ssssss", $usuario, $nombre, $primerApellido, $segundoApellido, $contra, $correo);

        $preparar->execute();

        $conexion->desconectar();
    }

    public static function seleccionarUsuarioRepetido($usuario) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $seleccionarUsu = "select Usuario from usuarios where Usuario = ?";

        $preparar = mysqli_prepare($conexion -> link, $seleccionarUsu);

        $preparar->bind_param("s", $usuario);

        $preparar->execute();

        $respuesta = $preparar->get_result();
         
        $datos = $respuesta->fetch_row();

        $conexion->desconectar();

        if (isset($datos[0]) == $usuario) {
            return true;
        } 
        return false;
    }

    public static function seleccionarCorreoRepetido($correo) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $seleccionarCor = "select correo from usuarios where correo = ?";

        $preparar = mysqli_prepare($conexion -> link, $seleccionarCor);

        $preparar->bind_param("s", $correo);

        $preparar->execute();

        $respuesta = $preparar->get_result();
         
        $datos = $respuesta->fetch_row();

        if (isset($datos[0]) == $correo) {
            return true;
        } 

        $conexion->desconectar();

        return false;
    }


    public static function iniciarSesion($usuario, $contra) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "select * from usuarios where usuario = ? and contraseña = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("ss", $usuario, $contra);
        
        $preparar->execute();

        $respuesta = $preparar->get_result();
         
        $datos = $respuesta->fetch_row();

        if ($datos[0] == $usuario && $datos[4] == $contra) {
            $usuarioLog = new Usuario();
            $usuarioLog -> setUsuario($datos[0]);
            $usuarioLog -> setNombre($datos[1]);
            $usuarioLog -> setPrimerApellido($datos[2]);
            $usuarioLog -> setSegundoApellido($datos[3]);
            $usuarioLog -> setContra($datos[4]);
            $usuarioLog -> setCorreo($datos[5]);
            return $usuarioLog;
        }

        $conexion -> desconectar();

        return null;
    }




    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPrimerApellido($primerApellido) {
        $this->primerApellido = $primerApellido;
    }

    public function setSegundoApellido($segundoApellido) {
        $this->segundoApellido = $segundoApellido;
    }


    public function setContra($contra) {
        $this->contra = $contra;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }   


    public function getUsuario() {
        return $this->usuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrimerApellido() {
        return $this->primerApellido;
    }

    public function getSegundoApellido() {
        return $this->segundoApellido;
    }

    public function getContra() {
        return $this->contra;
    }

    public function getCorreo() {
        return $this->correo;
    }




}