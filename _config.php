<?php

/********** CONFIGURATION ***********/


// On génère une constante contenant le chemin vers la racine publique du projet
// define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));


/*CLASS QUI VA PERMETTRE DE DEFINIR LES DIFFÉRENTS CHEMIN D'ACCÈS AUX FICHIERS SIMPLEMENT 
ET DE CHARGER TOUTES LES CLASSES SANS AVOIR BESOIN D'UTILISER LES INCLUDE ET INCLUDES_ONCE À CHAQUE FOIS*/

class Autoloader
{
    public static function start()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));

        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];


        define('HOST', 'http://' .$host.'/universite/');
        define('ROOT', $root.'/universite/');

        define('CONTROLLERS', ROOT.'controllers/');
        define('VIEWS', ROOT.'views/');
        define('MODELS', ROOT.'models/');
        define('DB', ROOT.'db/');
        define('CLASSES', ROOT.'classes/');
    }

    public static function autoload($class)
    {
        if(file_exists(MODELS.$class.'.php'))
        {
            include_once (MODELS.$class.'.php');
        }
          else if (file_exists(CLASSES.$class.'.php'))
        {
            include_once (CLASSES.$class.'.php');
        }
           else if (file_exists(CONTROLLERS.$class.'.php'))
        {
            include_once (CONTROLLERS.$class.'.php');
        };

    }
}
