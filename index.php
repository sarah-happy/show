<html>
<head>
<?php
require './logic.php';
require 'vendor/autoload.php';

$path_parts = split_request_uri();
$path = '/' . implode('/', $path_parts);
echo "<title>Index of ", htmlentities($path), "</title>\n";
?>
</head>
<body>
<?php
$path = '';
$path_url = '/';
echo "<h1>Index of <a href=\"/\">(root)</a> ";
foreach($path_parts as $part) {
    $path .= '/' . $part;
    $path_url .= rawurlencode($part) . '/';
    $part_html = htmlentities($part);
    echo "/ <a href=\"$path_url\">$part_html</a> ";
}

echo "</h1>";
?>
<?php
$files_path = real_request_dir();
$files = list_request_dir();
if($files) {
    foreach($files as $file) {
        $file_url = rawurlencode($file);
        $file_html = htmlentities($file);
        echo "<a href=\"$file_url\">$file_html</a> ";

        $file_path = $files_path . '/' . $file;
        if(is_dir($file_path)) {
            echo "(dir)";
        }
        if(is_file($file_path)) {
            echo filesize($file_path);
        }

        echo "<br>\n";
    }
} else {
    echo "Can not read folder.<br>\n";
}
?>
</body>
</html>