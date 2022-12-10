<?php
error_reporting();
ob_start();

include_once 'lib/config.php';
include_once 'lib/main.php';

$content = isset($_GET['content']) ? $_GET['content'] : 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'layouts/links.php'; ?>
    <?php include 'layouts/scripts.php'; ?>
</head>
<body>
<?php
include 'layouts/start.php';

if (file_exists("page/$content.php")) {
    include "page/$content.php";
} else if (file_exists("page/$content/index.php")) {
    include "page/$content/index.php";
} else {
    include 'page/not-found.php';
}

include 'layouts/end.php';
?>
</body>
</html>