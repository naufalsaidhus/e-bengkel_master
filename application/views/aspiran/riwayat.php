<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Halaman Guru</title>

<!-- Font Icon -->
<link rel="stylesheet" href="../assets3/fonts/material-icon/css/material-design-iconic-font.min.css">

<!-- Main css -->
<link rel="stylesheet" href="../assets3/css/style.css">
<link rel="stylesheet" href="../assets3/css3.css">
<link rel="stylesheet" href="../assets3/css2.css">
</head>

<body>
    <br><br><br>
    <div class="table-users">
        <div class="header">PERSETUJUAN</div>
        <table cellspacing="0">
            <tr>
                <th>
                    <center>No Seri</center>
                </th>
                <th>
                    <center>Gambar</center>
                </th>
                <th>
                    <center>Nama</center>
                </th>
                <th>
                    <center>
                        Siswa
                    </center>
                </th>
                <th>
                    <center>
                        Tanggal Peminjaman
                    </center>
                </th>
                <th>
                    <center>
                        Tanggal Pengembalian
                    </center>
                </th>
                <th>
                    <center>status_peminjaman</center>
                </th>
            </tr>

            <?php
            foreach ($hasil as $user_data) {
                echo "<tr>";
                echo "<td>" . $user_data['noser'] . "</td>";
                echo "<td><img src='" . base_url("images/" . $user_data['image']) . "' width='100' height='100'></td>";
                echo "<td>" . $user_data['namlat'] . "</td>";
                echo "<td>" . $user_data['name'] . "</td>";
                if ($user_data['tanggal_peminjaman']) {
                    echo "<td>" . date('l, d-M-Y / H:i:s a', $user_data['tanggal_peminjaman']);
                    "</td>";
                } else {
                    echo "<td>Tidak Ada</td>";
                }
                if ($user_data['tanggal_pengembalian']) {
                    echo "<td>" . date('l, d-M-Y / H:i:s a', $user_data['tanggal_pengembalian']);
                    "</td>";
                } else {
                    echo "<td>Tidak Ada</td>";
                }
                echo "<td>" . $user_data['status_peminjaman'] . "</td>";

            ?>
            <?php } ?>
            <?php
            "</tr>";

            ?>
        </table>
    </div>
</body>
<script>
</script>

</html>