<?php

require_once "../clases/Conexion.php";

class Like {
    private $idLike;
    private $idPost;
    private $usuario;
    private $estado;
    public function __construct()
    {
        $this -> idLike = 0;
        $this -> idPost = 0;
        $this -> usuario = "";
        $this -> estado = "";
    }

    public function darLike($idPost, $usuario, $estado) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "insert into Likes(idPost, usuario, estado) values (?,?,?)";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("isi", $idPost, $usuario, $estado);

        $preparar->execute();

        $conexion->desconectar();
    }

    public static function buscarLikeRepetido($idPost, $usuario) {
            $conexion = new Conexion();
            $conexion -> conectar();
    
            $insertar = "select idPost, Usuario from Likes where idPost = ? and usuario = ?";
    
            $preparar = mysqli_prepare($conexion -> link, $insertar);
    
            $preparar->bind_param("is", $idPost, $usuario);
            
            $preparar->execute();
    
            $respuesta = $preparar->get_result();
             
            $datos = $respuesta->fetch_row();
    
            if ($datos[0] == $idPost && $datos[1] == $usuario) {
                return true;
            }
            return false;
    }

    public static function buscarLike($idPost, $usuario) {
        $conexion = new Conexion();
        $conexion -> conectar();

        $insertar = "select estado from Likes where idPost = ? and usuario = ?";

        $preparar = mysqli_prepare($conexion -> link, $insertar);

        $preparar->bind_param("is", $idPost, $usuario);
        
        $preparar->execute();

        $respuesta = $preparar->get_result();
         
        $datos = $respuesta->fetch_row();

        if ($datos != null && $datos[0] == 1) {
            return true;
        }
        return false;
    }


    public function setIdPost($idPost) {
        $this -> idPost = $idPost;
    }

    public function setUsuario($usuario) {
        $this -> usuario = $usuario;
    }

    public function setEstado($estado) {
        $this -> estado = $estado;
    }

    public function getIdLike() {
        return $this -> idLike;
    }

    public function getIdPost() {
        return $this -> idPost;
    }

    public function getUsuario() {
        return $this -> usuario;
    }

    
    public function getEstado() {
        return $this -> estado;
    }

}