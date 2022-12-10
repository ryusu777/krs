<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM prodi WHERE no_prodi=?");
    $statement->bind_param('i', $_POST['no_prodi']);
    $statement->execute();
    $statement->close();
    redirect("prodi");
    exit;
}
?>