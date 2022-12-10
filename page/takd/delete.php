<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM tkad WHERE kode_tkad=?");
    $statement->bind_param('s', $_POST['kode_tkad']);
    $statement->execute();
    $statement->close();
    redirect("tkad");
    exit;
}
?>