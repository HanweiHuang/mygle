<?php

/**
 * @param $obj
 * @param string $label
 * @param string $file
 * @return bool
 *
 * log record
 */
function fsSysLog($obj, $label="", $file="sys-log"){
    return writeLog($obj, $label, $file);
}


/**
 * @param $obj
 * @param null $label
 * @param null $file
 * @return bool
 */

function writeLog($obj, $label=null, $file=null){
    global $log_dir, $log_uid;
    if(!isset($log_uid) || empty($log_uid)) $log_uid = generateRandomString(4);

    if(!is_dir($log_dir)){
        $oldumask = umask(0);
        mkdir($log_dir,0775,true);
        umask($oldumask);
    }
    //if file is specified, the file's path is relative to $log_dir
    if($file){
        //create nested folders if there is a path in the file name
        $path = multiExplode('/\\',$file);
        unset($path[count($path)-1]);
        $dir = implode('/', $path);
        if(!is_dir($log_dir.'/'.$dir)){
            $oldumask = umask(0);
            mkdir($log_dir.'/'.$dir,0775,true);
            umask($oldumask);
        }
        $file_name = $file.'.log';
    }
    else $file_name = 'debug.log';

    $full_path = $log_dir.'/'.$file_name;

    if(!file_exists($full_path)){
        $fp = fopen($full_path, 'w');
        fclose($fp);
        chmod($full_path, 0775);
    }

    $promp = current_time('Y-m-d H:i:s')."[$log_uid] - $label";
    file_put_contents($full_path, $promp.print_r($obj, true)."\r\n", FILE_APPEND);

    return true;
}

/**
 * @param int $length
 * @param string $characters
 * @return string
 *
 * create random serious
 */
function generateRandomString($length = 6, $characters = '0123456789abcdefghijklmnopqrstuvwxyz') {
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * @param $delimiters
 * @param $string
 * @return array
 *
 * explore a string into a array by first element of delimiters
 */
function multiExplode($delimiters, $string) {
    if(empty($string)) return [''];
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return $launch;
}



//***************************************** end of log

