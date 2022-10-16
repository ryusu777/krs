<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statement = $mysqli->prepare("DELETE FROM jadwal_dtl WHERE no_jadwal_detail=?");
    $statement->bind_param('i', $_POST['no_jadwal_detail']);
    $statement->execute();
    $statement->close();
    redirect("prodi/jadwal_hdr");
    exit;
}
?>