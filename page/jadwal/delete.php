<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $mysqli->query("SELECT * FROM jadwal_hdr WHERE no_jadwal_hdr='".$_POST['no_jadwal_hdr']."'");
    $row = $result->fetch_assoc();
    if (!$row) {
        include "page/not-found.php";
        exit;
    }
    $statement = $mysqli->prepare("DELETE FROM jadwal_hdr WHERE no_jadwal_hdr=?");
    $statement->bind_param('s', $_POST['no_jadwal_hdr']);
    $statement->execute();
    $statement->close();
    $no_prodi = $row['no_prodi'];
    redirect("jadwal?no_prodi=$no_prodi");
    exit;
}
?>