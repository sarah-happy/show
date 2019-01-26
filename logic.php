<?php
// list the directory contents

function split_request_uri() {
    $out = array();

    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    $path = '';
    $path_url = '/';
    foreach(explode('/', $uri_path) as $name_url) {
        if($name_url == '') {
            continue;
        }
        $path_url .= $name_url . '/';
        $name = urldecode($name_url);
        
        $path .= '/' . $name;
        $out[] = array(
            'name' => $name,
            'path' => $path,
            'url' => $path_url,
            'html' => htmlentities($name),
        );
    }
    
    return $out;
}

function html_request_uri() {
    $request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return htmlentities(urldecode($request_path));
}

function real_request_dir() {
    $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = urldecode($request_uri);
    $real_path = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . $path;
    return $real_path;
}

function listdir($path) {
    $out = array();
    $dh = opendir($path);
    if ( ! $dh ) {
        return false;
    }
    while (false !== ($name = readdir($dh))) {
        $out[] = $name;
    }
    closedir($dh);
    return $out;
}

function list_request_dir() {
    $path = real_request_dir();
    
    $files = listdir($path);
    if($files === false) {
        return false;
    }
    
    sort($files);

    $out = array();
    foreach($files as $name) {
        if ($name[0] == "." or $name[0] == '$') {
            continue;
        }
        
        $file_path = $path . '/' . $name;
        
        $mtime = date("Y M d H:i:s", filemtime($file_path));
        
        if(is_dir($file_path)) {
            $size = '(dir)';
        } elseif(is_file($file_path)) {
            $size = number_format(filesize($file_path)) . " bytes";
        } else {
            $size = "(???)";
        }

        $out[] = array(
            'name' => $name,
            'path' => $file_path,
            'url' => rawurlencode($name),
            'html' => htmlentities($name),
            'mtime' => $mtime,
            'size' => $size,
        );
    }
    return $out;
}

?>
