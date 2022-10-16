<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $mysqli->query("SELECT * FROM jadwal_dtl WHERE no_jadwal_detail=".$_POST['no_jadwal_detail']);
    $row = $result->fetch_assoc();
    if (!$row) {
        include "page/not-found.php";
        exit;
    }
    $statement = $mysqli->prepare("DELETE FROM jadwal_dtl WHERE no_jadwal_detail=?");
    $statement->bind_param('i', $_POST['no_jadwal_detail']);
    $statement->execute();
    $statement->close();
    $no_jadwal_hdr = $row['no_jadwal_hdr'];
    redirect("prodi/jadwal_hdr/detail?no_jadwal_hdr=$no_jadwal_hdr");
    exit;
}
?>