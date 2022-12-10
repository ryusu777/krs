<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM dosen WHERE nid_dosen=?");
    $statement->bind_param('s', $_POST['nid_dosen']);
    $statement->execute();
    $statement->close();
    redirect("dosen");
    exit;
}
?>