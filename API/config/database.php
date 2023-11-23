<?php
    class Conexion
    {
        private $host = "localhost";
        private $database = "eco";
        private $user = "root";
        private $password = "";
        private $charset = "utf8";

        function conectar()
        {
            try 
            {
                $conexion = "mysql:host=" . $this -> host . ";dbname=" . $this -> database . ";charset=" . $this -> charset;

                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                $pdo = new PDO($conexion, $this -> user, $this -> password, $options);

                return $pdo;
            }
            catch(PDOException $e)
            {
                echo 'Error conexion: ' . $e -> getMessage();
                exit;
            }
        }
    }
?>