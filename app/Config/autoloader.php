<?php

spl_autoload_register(function($classes){
    $filename = $classes . '.php';
    $file = APP_PATH_CLASSES . $filename;
    if (false == file_exists($file)) {
        header('Location:'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/'.LANG.'/Index/error');
    }
    require ($file);
});

function getLang() {
    $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $lang = explode(',',$lang);
    $lang = explode('-',$lang[0]);
    if (file_exists(APP_PATH . 'app/Locale/'.$lang[0]))
       return $lang[0];
    else
        return 'ru';
}
