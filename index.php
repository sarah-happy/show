<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="/show/node_modules/bootstrap/dist/css/bootstrap.css">
<?php
require './logic.php';

$path_parts = split_request_uri();
$path = '/' . implode('/', $path_parts);
echo "<title>Index of ", htmlentities($path), "</title>\n";
?>
    <style type="text/css">
        .highlight:hover {
            background: lightblue;
        }
    </style>
</head>
<body>
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">(root)</a></li>
<?php
$path = '';
$path_url = '/';
foreach($path_parts as $part) {
    $path .= '/' . $part;
    $path_url .= rawurlencode($part) . '/';
    $part_html = htmlentities($part);
    echo "<li class=\"breadcrumb-item\"><a href=\"$path_url\">$part_html</a></li>";
}
?>
    </ol>
    </nav>
    </div>

<?php
$files_path = real_request_dir();
$files = list_request_dir();
if($files) {
    foreach($files as $file) {
        echo '<div class="container highlight">';
        $file_url = rawurlencode($file);
        $file_html = htmlentities($file);
        echo "<a href=\"$file_url\">$file_html</a>";
        echo "<div class=\"text-right\">";

        $file_path = $files_path . '/' . $file;
        if(is_dir($file_path)) {
            echo "(dir)";
        }
        if(is_file($file_path)) {
            echo filesize($file_path);
        }

        echo "</div></div>\n";
    }
} else {
    echo "Can not read folder.<br>\n";
}
?>

<script src="/show/node_modules/jquery/dist/jquery.js"></script>
<script src="/show/node_modules/popper.js/dist/umd/popper.js"></script>
<script src="/show/node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>