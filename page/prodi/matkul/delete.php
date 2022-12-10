<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM maktul WHERE kode_matkul=?");
    $statement->bind_param('s', $_POST['kode_matkul']);
    $statement->execute();
    $statement->close();
    redirect("matkul");
    exit;
}
?>