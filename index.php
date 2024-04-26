<?php

// POUR VÉRIFIER LES ERREURS SUR PHP
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

session_start();

// ON RÉCUPÈRE LA BASE DE DONNÉES ET LES FICHIERS
// Config
require('db/database.php');
include_once('_config.php');
include_once("classes/router.php");
// Controllers
require('controllers/Home.php');
require('controllers/Register.php');
require('controllers/Login.php');
require('controllers/Enregistrer.php');
require('controllers/Note.php');
// require('controllers/Class.php');
// require('controllers/Contact.php');
require('controllers/Profil.php');
require('controllers/Logout.php');
require('controllers/Admin.php');

// require('controllers/ClassController.php');
// CHARGEMENT DE LA CONFIGURATION ET L'AUTOLOAD
Autoloader::start();

$request = isset($_GET['url']) ? $_GET['url'] : 'home';

// Ici on se retrouve avec l'url de base index.php?r=...
//$request = $_GET['url']; //fait référence à index.php?url=...
// var_dump($request);

// var_dump($_SESSION);

$router = new Router($request);
$router->renderControllers();
