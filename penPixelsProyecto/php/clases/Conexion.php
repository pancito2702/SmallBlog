<?php

class Conexion {

    public $link;

    // Esto varia segun la computadora del que programa, cambiar segun necesidades
    public function conectar() {
        $this->link = mysqli_connect("localhost", "root", "chepis2702", "PenAndPixels");
    }

    public function desconectar() {
        $this->link->close();
    }

    
}