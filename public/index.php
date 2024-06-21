<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);

function dateToFrench($date, $format)
{
    //echo dateToFrench("yesterday" ,"l j F Y")
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}

function diff_time($t1, $t2,)
{
    //Heures au format (hh:mm:ss) la plus grande puis le plus petite

    $tab = explode(":", $t1);
    $tab2 = explode(":", $t2);

    $h = $tab[0];
    $m = $tab[1];
    $s = $tab[2];
    $h2 = $tab2[0];
    $m2 = $tab2[1];
    $s2 = $tab2[2];

    if ($h2 > $h) {
        $h = $h + 24;
    }
    if ($m2 > $m) {
        $m = $m + 60;
        $h2++;
    }
    if ($s2 > $s) {
        $s = $s + 60;
        $m2++;
    }

    $ht = $h - $h2;
    $mt = $m - $m2;
    $st = $s - $s2;
    if (strlen($ht) == 1) {
        $ht = "0" . $ht;
    }
    if (strlen($mt) == 1) {
        $mt = "0" . $mt;
    }
    if (strlen($st) == 1) {
        $st = "0" . $st;
    }
    return $ht . ":" . $mt . ":" . $st;

}
