<?php

function config($section, $type) {

    $dir = dirname(__DIR__, 1) .'/config/globals.ini';

        if(file_exists($dir)) {

            $fini = parse_ini_file($dir, true);
            
            if(!empty($fini[$section][$type]) or isset($fini[$section][$type])) {

                $ans = ((is_array($fini[$section][$type])) ? $fini[$section][$type] : $fini[$section][$type]);

                return $ans;

            }

        }
        
    }

    if((strpos($_SERVER['HTTP_HOST'], 'localhost') !== false)) {

        $db_root = 'localhost';
        $db_user = 'root';
        $db_pword = '%700ansgttv';
        $db_name = config('config', 'db_table');

    } else {

        $db_root = config('config', 'db_name');
        $db_user = config('config', 'db_user');
        $db_pword = config('config', 'db_password');
        $db_name = config('config', 'db_table');
    }
    
    $db = new mysqli ($db_root, $db_user, $db_pword, $db_name);

?>