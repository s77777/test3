<?php

if ($_SERVER['SERVER_NAME']=='forge.local')
{
    error_reporting(E_ALL);ini_set('display_errors', TRUE);ini_set('display_startup_errors', TRUE);
}
else
{
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_PARSE);ini_set('display_errors', FALSE);ini_set('display_startup_errors', FALSE);
}
try
{
    session_start();
    $params = session_get_cookie_params();
    setcookie("PHPSESSID", session_id(), 0, $params["path"], $params["domain"], false, true );
    define('APP_PATH', realpath('..') . '/');
    define('APP_PATH_CONF', APP_PATH . 'app/Config/');
    define('APP_PATH_CLASSES', APP_PATH . 'app/Classes/');
    define('APP_PATH_VIEWS', APP_PATH . 'app/Views/');
    define('APP_PATH_LOCALE', APP_PATH . 'app/Locale/');
    define('APP_PATH_UPLOAD', APP_PATH . 'app/Upload/');
    define('SERVER_NAME', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);
    require APP_PATH_CONF . 'autoloader.php';
    $config=require APP_PATH_CONF . 'config.php';
    $db=new Db($config);
    $p = new Page($db);
    if ($p->getLangArg()=='') {
        header('Location:'.SERVER_NAME.'/'.getLang());
    }
    define('LANG', $p->getLangArg());
    $p->getContent();
}
catch (\Exception $e)
{
    echo 'Error - '.$e->getMessage()."\n".'Line: '.$e->getLine()."\n".'File: '.$e->getFile();
}
