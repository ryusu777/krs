<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM ruang WHERE kode_ruang=?");
    $statement->bind_param('s', $_POST['kode_ruang']);
    $statement->execute();
    $statement->close();
    redirect("ruang");
    exit;
}
?>