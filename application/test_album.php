<?php
// Establecer el include_path
set_include_path('.' . PATH_SEPARATOR . './library'
    . PATH_SEPARATOR . './application/models/'
    . PATH_SEPARATOR . get_include_path());

// Probar cargar la clase Album
try {
    require_once 'Album.php'; // Asegúrate de que el nombre sea correcto
    $albumModel = new Album();
    echo "Clase Album cargada correctamente.";
} catch (Exception $e) {
    die("Error al cargar la clase Album: " . $e->getMessage());
}
