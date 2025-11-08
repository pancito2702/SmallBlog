<?php
include "Conexion.php";

class Contacto {
    private $idMensajeContacto;
    private $Usuario;
    private $correo;
    private $mensaje;

    public function __construct()
    {
        $this -> idMensajeContacto = "";
        $this -> Usuario = "";
        $this -> correo = "";
        $this -> mensaje = "";
    }


    public function contactar($usuario, $correo, $mensaje) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "insert into contacto (Usuario, correo, mensaje) values (?,?,?)";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("sss", $usuario, $correo, $mensaje);

        $preparar->execute();

        $conexion->desconectar();
    }


    public function setIdMensajeContacto($idMensajeContacto) {
        $this -> idMensajeContacto = $idMensajeContacto;
    }

    public function setUsuario($usuario) {
        $this -> Usuario = $usuario;
    }

    public function setCorreo($correo) {
        $this -> correo = $correo;
    }

    public function setMensaje($mensaje) {
        $this -> mensaje = $mensaje;
    }

    public function getIdMensajeContacto() {
        return $this -> idMensajeContacto;
    }

    public function getUsuario() {
        return $this -> Usuario;
    }

    public function getCorreo() {
        return $this -> correo;
    }

    public function getMensaje() {
        return $this -> mensaje;
    }


}