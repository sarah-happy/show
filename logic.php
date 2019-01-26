<?php
// list the directory contents

function split_request_uri() {
    $request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $request_path = explode('/', $request_path);
    $out = array();
    foreach($request_path as $part) {
        if($part == '') {
            continue;
        }
        $out[] = urldecode($part);
    }
    return $out;
}

function list_request_dir() {
    $files = array();
    if ($handle = opendir(real_request_dir())) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry[0] == ".") {
                continue;
            }
            if ($entry[0] == '$') {
                continue;
            }
            $files[] = $entry;
        }
        closedir($handle);
    } else {
        return false;
    }
    sort($files);
    return $files;
}

function real_request_dir() {
    $path = '/' . implode('/', split_request_uri()) . '/';
    $files_path = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . $path;
    return $files_path;
}

?>
