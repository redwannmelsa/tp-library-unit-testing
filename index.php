<?php
session_start();

require 'vendor/autoload.php';

use App\Controller\AccueilController;
use App\Controller\BookController;
use App\Controller\AdherentController;
use App\Controller\EmpruntController;

define('host', 'http://localhost/week13/tp-library-v2-mvc-composer/');
define('ROOT', dirname(__DIR__).DIRECTORY_SEPARATOR.'tp-library-v2-mvc'.DIRECTORY_SEPARATOR);

function debug($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

$class = $_GET['class'];
$method = $_GET['method'].'Action';

switch($class){
    case "AccueilController": 
        $c = new AccueilController();
        break;
    case "BookController": 
        $c = new BookController();
        break;
    case "AdherentController": 
        $c = new AdherentController();
        break;
    case "EmpruntController": 
        $c = new EmpruntController();
        break;
    default: 
        $c = new AccueilController();
        break;
}

$c->$method();
die;