<section>
    <div>
        <table border="1">
            <tr>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Perfroma</th>
            </tr>
            <?php

            include("../connection.php");

            $tgl = date('d-m-Y');
            $time = date('H:i:s');
            $employee_id = $_SESSION['employee_id'];

            // looping
            $sql = "SELECT * FROM attendances WHERE employee_id=$employee_id";
            $result = $db->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td> " . $row['tgl'] . " </td>";
                echo "<td> " . $row['clock_in'] . " </td>";
                // VALIDASI TOMBOL KELUAR
                if (empty($row['clock_out']) && !empty($row['clock_in']) && $tgl == $row['tgl']) {
                    echo "<td>
                    <form action='' method='POST' onsubmit='return alert(`terimakasih`)'>
                    <button type='submit' name='keluar'>KELUAR</button>
                    </form>
                    </td>";
                } else {
                    echo "<td> " . $row['clock_out'] . " </td>";
                }

                echo "<td> </td>";
                echo "<tr/>";
            }
            ?>
        </table>
    </div>
    <br />
    <form action="action.php" method="POST">
        <button type="submit" name="absen">
            ABSEN SEKARANG
        </button>
    </form>

    <?php
    if (isset($_POST['keluar'])) {
        $update = "UPDATE attendances SET clock_out='$time' WHERE
            employee_id=$employee_id AND tgl='$tgl'";
        $clock_out = $db->query($update);
        if ($clock_out === TRUE) {
            session_start();
            session_destroy();
            header("location:../index.php");
        }
    }
    ?>
</section>