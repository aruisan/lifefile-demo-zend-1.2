<?php
class TestConnectionController extends Zend_Controller_Action {
    public function indexAction() {
        // Configuración de conexión
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'zftest';

        // Crear conexión
        $conn = new mysqli($host, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            $this->view->message = "Error de conexión: " . $conn->connect_error;
        } else {
            $this->view->message = "Conexión exitosa a la base de datos";
        }
        $conn->close();
    }
}
