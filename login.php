<?php
include("connection.php");
include("users.php");

session_start();

$user = new Users();

if (isset($_POST['login'])) {
    /**
     * MELAKUKAN PENGECEKAN JIKA ID DAN PASSWORD YG DI MASUKKAN KURAN GDARI 2 CHARACTER
     * -> header() => direct ke halaman tujuan
     * -> strlen() => panjang string
     */
    if (strlen($_POST['nip']) <= 2 || strlen($_POST['password']) <= 2) {
        header("location:index.php?message=minimal 5 karakter");
    } else {
        // Pemanggilan Function set_login_data dgn argument pada validasi di html
        $user->set_login_data($_POST['nip'], $_POST['password']);

        $id = $user->get_employee_id();
        $password = $user->get_password();

        $sql = "SELECT * FROM users where employee_id = $id AND password = '$password'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            // DATA YG AKAN MASUK KE DASHBOARD
            while ($row = $result->fetch_assoc()) {
                $_SESSION['status'] = "login";
                $_SESSION['employee_id'] = $row['employee_id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['role'] = $row['role'];
            }

            if ($_SESSION['role'] == 'admin') {
                header("location:dashboard/index-admin.php");
            } else {
                header("location:dashboard/index.php");
            }
        } else {
            header("location:index.php?message=Data tidak valid");
        }
    }
}
