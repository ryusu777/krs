<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM jadwal_hdr WHERE no_jadwal_hdr=?");
    $statement->bind_param('s', $_POST['no_jadwal_hdr']);
    $statement->execute();
    $statement->close();
    redirect("prodi/jadwal_hdr/");
    exit;
}
?>