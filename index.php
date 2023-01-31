<?php

// SESSION LOGIN 
session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("location:dashboard/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>LOGIN SISTEM</title>
</head>

<body>
    <div class="container">
        <section class="wrapper">
            <h3 class="title">LOGIN SISTEM</h3>
            <!-- Notifikasi -->
            <?php
            if (isset($_GET['message'])) {
                $msg = $_GET['message'];
                echo "<div class='notif-login'>$msg</div>";
            }
            ?>
            <!-- /Notifikasi -->
            <div>
                <form action="login.php" method="POST" class="form-login">
                    <label>Masukkan Nomor Induk Karyawan</label>
                    <input placeholder="nip" name="nip" type="number" class="input-login" required />
                    <label>Masukkan Password</label>
                    <input placeholder="******" name="password" type="password" class="input-login" required />
                    <button type="submit" class="button-login" name="login">Login</button>
                </form>
            </div>
        </section>
    </div>
</body>

</html>