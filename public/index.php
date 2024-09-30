<?php

// Incluir el autoloader de Composer
require '../vendor/autoload.php';

// Reportar todos los errores
error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('Europe/London');

// Configurar la base de datos
$config = new Zend_Config_Ini('../application/config.ini', 'general');
$registry = Zend_Registry::getInstance();
$registry->set('config', $config);

$db = Zend_Db::factory($config->db->adapter, $config->db->config->toArray());
Zend_Db_Table::setDefaultAdapter($db);

// Configurar include_path para cargar las clases de la aplicación
set_include_path(implode(PATH_SEPARATOR, array(
    realpath('../application/models'),
    get_include_path(),
)));

// Configurar el Front Controller
$frontController = Zend_Controller_Front::getInstance();
$frontController->setBaseUrl('/lifefile-zend');
$frontController->setControllerDirectory('../application/controllers');
$frontController->throwExceptions(true); // Muestra las excepciones (para debugging)

// Ejecutar la aplicación
$frontController->dispatch();
