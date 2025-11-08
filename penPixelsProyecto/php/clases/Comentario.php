<?php

require_once "Conexion.php";


class Comentario {
    private $idComentario;
    private $usuario;
    private $idPost;
    private $contenido;

    public function __construct()
    {
        $this -> idComentario = 0;
        $this -> usuario = "";
        $this -> idPost = "";
        $this -> contenido;
    }

    public function comentar($usuario, $idPost, $contenido) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "insert into comentariosPost (Usuario, idPost, contenido) values (?,?,?)";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("sis", $usuario, $idPost, $contenido);

        $preparar->execute();

        $conexion->desconectar();
    }

    public static function verComentarios($idPost) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "select * from comentariosPost where idPost = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);
        
        $preparar->bind_param("i", $idPost);

        $preparar->execute();

        $respuesta = $preparar->get_result();
         
        $dataArray = $respuesta->fetch_all();

        $comentarios = [];

        foreach ($dataArray as $dato) {
            $comentario = new Comentario();

            $comentario -> setIdComentario($dato[0]);

            $comentario -> setUsuario($dato[1]);

            $comentario -> setContenido($dato[3]);

            array_push($comentarios, $comentario);
        }

        $conexion -> desconectar();

        return $comentarios;
    }


    public function eliminarComentario($idComentario) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "delete from comentariosPost where idComentario = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("i", $idComentario);
        
        $preparar->execute();

        $conexion -> desconectar();

    }

    public static function verSiComentarioPerteneceUsuario($usuario, $idComentario) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "select usuario, idComentario from comentariosPost where usuario = ? and idComentario = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("si", $usuario, $idComentario);
        
        $preparar->execute();

        $respuesta = $preparar->get_result();
         
        $datos = $respuesta->fetch_row();

        $conexion -> desconectar();

        $comentario = new Comentario();
        
        $comentario -> setUsuario($datos[0]);

        $comentario -> setIdComentario($datos[1]);
        
        if ($comentario -> getUsuario() == $usuario && $comentario -> getIdComentario() == $idComentario) {
            return true;
        }
        return false;
    }

    public static function verComentarioEspecifico($idComentario) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "select * from comentariosPost where idComentario = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("i", $idComentario);
        
        $preparar->execute();

        $respuesta = $preparar->get_result();
         
        $datos = $respuesta->fetch_row();

        $conexion -> desconectar();

        $comentario = new Comentario();

        $comentario -> setIdComentario($datos[0]);

        $comentario -> setContenido($datos[3]);

        return $comentario;
    }

    public function actualizarComentario($contenido, $idComentario)
    {
       
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "update comentariosPost set " .
        "contenido = ? " .
        "where idComentario = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("si",  $contenido, $idComentario);
        
        $preparar->execute();

        $conexion -> desconectar();
    }

    public function setIdComentario($idComentario) {
        $this -> idComentario = $idComentario;
    }

    public function setUsuario($usuario) {
        $this -> usuario = $usuario;
    }

    public function setIdPost($idPost) {
        $this -> idPost = $idPost;
    }

    public function setContenido($contenido) {
        $this -> contenido = $contenido;
    }

    public function getIdComentario() {
        return $this -> idComentario;
    }

    public function getUsuario() {
        return $this -> usuario;
    }

    public function getIdPost() {
        return $this -> idPost;
    }

    public function getContenido() {
        return $this -> contenido;
    }


}