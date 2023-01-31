<?php

include("../connection.php");

session_start();

$employee_id = $_SESSION['employee_id'];
$tgl = date('d-m-Y');
$clock_in = date('H:i:s');

if (isset($_POST['absen'])) {

    //  JIKA SUDAH ABSEN
    $cek_absensi = "SELECT tgl FROM attendances WHERE employee_id=$employee_id 
    AND tgl='$tgl'";
    $cek = $db->query($cek_absensi);
    // JIKA SUDAH ABSEN END
    if ($cek->num_rows > 0) {
        header("location:index.php?message=ANDA SUDAH ABSEN");
    } else {
        $sql = "INSERT INTO attendances (id, employee_id, tgl, clock_in, clock_out) 
            VALUES (NULL, '$employee_id', '$tgl', '$clock_in', NULL)";

        $result = $db->query($sql);
        if ($result === TRUE) {
            header("location:index.php?message=ABSENSI BERHASIL");
        } else {
            header("location:index.php?message=ABSEN GAGAL");
        }
    }
}
