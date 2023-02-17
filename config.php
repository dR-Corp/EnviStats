<?php
/*** configuration *****/
ini_set('display_errors','on');
error_reporting(E_ALL);

class MyAutoload {
    
    public static function start() {

        spl_autoload_register(array(__CLASS__, 'autoload'));

        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];

        define('HOST', 'http://'.$host.'/Envistats/');
        define('ROOT', $root.'/Envistats/');

        define('CONTROLLERS', ROOT.'Controllers/');
        define('VIEWS', ROOT.'Views/');
        define('COMPONENTS', ROOT.'Views/Components/');
        define('DATA', ROOT.'Data/');

        define('ASSETS', HOST.'Assets/');
    }

    public static function autoload($class) {

        if(file_exists(CONTROLLERS.$class.'.php')) {
            include_once(CONTROLLERS.$class.'.php');
        }
        else if(file_exists(VIEWS.$class.'.php')) {
            include_once(VIEWS.$class.'.php');
        }

        // require_once 'vendor/autoload.php';
    }
    
}