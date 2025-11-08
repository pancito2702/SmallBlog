<?php

require_once "Conexion.php";

class Articulo {
    private $idPost;
    private $encabezado;
    private $contenido;
    private $fechaPublicacion;
    private $usuario;
    private $imagen;


    public function __construct()
    {
        $this -> idPost = 0;
        $this -> encabezado = "";
        $this -> contenido = "";
        $this -> fechaPublicacion = "";
        $this -> usuario = "";
        $this -> imagen = "";
    }

    public function agregarPost($encabezado, $contenido, $fechaPublicacion, $usuario, $imagen) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "insert into Posts (Encabezado, Contenido, fechaPublicacion, 
        Usuario, imagen) values (?,?,?,?,?)";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("sssss", $encabezado, $contenido, $fechaPublicacion, $usuario, $imagen);

        $preparar->execute();

        $conexion->desconectar();
    }


    public static function verPosts() {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "select * from Posts";

        $preparar = mysqli_prepare($conexion -> link, $insertar);
        
        $preparar->execute();

        $respuesta = $preparar->get_result();
        $dataArray = $respuesta->fetch_all();

        $posts = [];

        foreach($dataArray as $dato) {
            $post = new Articulo();
            $post -> setIdPost($dato[0]);
        
            $post -> setEncabezado($dato[1]);
    
            $post -> setContenido($dato[2]);
            
            array_push($posts, $post);
        }

        $conexion -> desconectar();

        return $posts;
    }

    public static function verPostEspecifico($idPost) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "select * from Posts where idPost = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("i", $idPost);
        
        $preparar->execute();

        $respuesta = $preparar->get_result();
         
        $datos = $respuesta->fetch_row();

        $conexion -> desconectar();

        $post = new Articulo();

        $post -> setIdPost($datos[0]);
        
        $post -> setEncabezado($datos[1]);

        $post -> setContenido($datos[2]);
        
        $post -> setFechaPublicacion($datos[3]);

        $post -> setUsuario($datos[4]);

        $post -> setImagen($datos[5]);

        return $post;
    }
    
    public static function verSiPostPerteneceUsuario($usuario, $idPost) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "select usuario, idPost from Posts where usuario = ? and idPost = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("si", $usuario, $idPost);
        
        $preparar->execute();

        $respuesta = $preparar->get_result();
         
        $datos = $respuesta->fetch_row();

        $conexion -> desconectar();

        $post = new Articulo();
        
        $post -> setUsuario($datos[0]);

        $post -> setIdPost($datos[1]);
        
        if ($post -> getUsuario() == $usuario && $post -> getIdPost() == $idPost) {
            return true;
        }
        return false;
    }

    public function eliminarPost($idPost) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "delete from Posts where idPost = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("i", $idPost);
        
        $preparar->execute();

        $conexion -> desconectar();

    }

    public function actualizarPost($encabezado, $contenido, $fechaPublicacion,  $imagen, $idPost)
    {
       
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "update Posts set " .
        "encabezado = ?," .
        "contenido = ?," .
        "fechaPublicacion = ?," .
        "imagen = ? " .
        "where idPost = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("ssssi", $encabezado, $contenido, $fechaPublicacion, $imagen, $idPost);
        
        $preparar->execute();

        $conexion -> desconectar();
    }

    public function setIdPost($idPost) {
        $this -> idPost = $idPost;
    }


    public function setEncabezado($encabezado) {
        $this -> encabezado = $encabezado;
    }

    public function setContenido($contenido) {
        $this -> contenido = $contenido;
    }

    public function setFechaPublicacion($fechaPublicacion) {
        $this -> fechaPublicacion = $fechaPublicacion;
    }

    public function setUsuario($usuario) {
        $this -> usuario = $usuario;
    }

    public function setImagen($imagen) {
        $this -> imagen = $imagen;
    }


    public function getIdPost() {
        return $this -> idPost;
    }

    public function getEncabezado() {
        return $this -> encabezado;
    }

    public function getContenido() {
        return $this -> contenido;
    }

    public function getFechaPublicacion() {
        return $this -> fechaPublicacion;
    }

    public function getUsuario() {
        return $this -> usuario;
    }

    public function getImagen() {
        return $this -> imagen;
    }



}