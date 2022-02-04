<?php

class Database {

    private $hostname = "localhost"; //Tambien se puede colocar en vez de localhost la ip de la maquina que aloja la database
    private $database = "tienda_online";
    private $username = "root";
    private $password = ""; //contraseña en blanco debido al uso de xamp para conectar con phpmyadmin
    private $charset = "utf8";

    function conectar()
    {
        try{
        $conexion = "mysql:host=" . $this->hostname . "; dbname=" . $this->database . "; charset=" . $this->charset;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $pdo = new PDO($conexion, $this->username, $this->password, $options);

        return $pdo;
    } catch(PDOException $e){
        echo 'Error conexion: ' . $e->getMessage();
        exit; 
    }    
    }
}

?>