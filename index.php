<?php
require './vendor/autoload.php';



error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('Europe/London');

// Establecer el include_path para las librerías y modelos
set_include_path('.' . PATH_SEPARATOR . './library'
   . PATH_SEPARATOR . './application/models/'
   . PATH_SEPARATOR . get_include_path());


// Cargar el cargador de Zend
include "Zend/Loader.php";

// Cargar la configuración de la base de datos
$config = new Zend_Config_Ini('application/config.ini', 'general');

// Crear el adaptador de la base de datos
$dbAdapter = Zend_Db::factory($config->db->adapter, $config->db->config->toArray());

// Establecer el adaptador de la base de datos en el registro de Zend
Zend_Registry::set('db', $dbAdapter);

// Cargar el controlador frontal
Zend_Loader::loadClass('Zend_Controller_Front');

$frontController = Zend_Controller_Front::getInstance();
$frontController->throwExceptions(true);
$frontController->setControllerDirectory('./application/controllers');
$frontController->dispatch();
