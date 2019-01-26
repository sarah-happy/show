<?php
require './logic.php';
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" 
      content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<link rel="stylesheet" href="/show/style.css" />
<title>Index of <?= html_request_uri() ?></title>
</head>
<body>
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">(root)</a></li>
<?php foreach(split_request_uri() as $p) { ?>
    <li class="breadcrumb-item"><a href="<?= $p['url'] ?>"><?= $p['html'] ?></a></li>
<?php } ?>
    </ol>
    </nav>
    </div>

<?php
$files = list_request_dir();
if($files === false) {
?>
    <div class="container">
    Can not read folder.<br>
    </div>
<?php 
}
else {
    foreach($files as $f) {
?>
    <div class="container">
        <a class="fileitem" href="<?= $f['url'] ?>">
            <div class="filename"><?= $f['html'] ?></div>
            <div><?= $f['mtime'] ?> &mdash; <?= $f['size'] ?></div>
        </a>
    </div>
<?php
    }
}
?>
<script src="/show/node_modules/jquery/dist/jquery.js"></script>
<script src="/show/node_modules/popper.js/dist/umd/popper.js"></script>
<script src="/show/node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>