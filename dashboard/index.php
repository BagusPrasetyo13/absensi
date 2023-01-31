<?php

session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:../index.php?message=silahkan login telebih dahulu");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("location:../index.php?message=keluar dari sistem");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <section>
            <h3>HALOO <?php echo $_SESSION['fullname']; ?></h3>
            <p>Status: <?php echo $_SESSION['role']; ?></p>
            <br />
            <?php
            if (isset($_GET['message'])) {
                echo $_GET['message'];
            }
            ?>
            <!-- TABLE ABSEN -->
            <?php
            include("absensi.php");
            ?>
            <!-- / TABLE ABSEN -->
            <br />
            <form action="" method="post">
                <button name="logout" type="submit">Logout</button>
            </form>
        </section>
    </div>
</body>

</html>