<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM takd WHERE kode_takd=?");
    $statement->bind_param('s', $_POST['kode_takd']);
    $statement->execute();
    $statement->close();
    redirect("tkad");
    exit;
}
?>