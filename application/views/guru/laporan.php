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
        <div class="header">Laporan</div>
        <table cellspacing="0">
            <tr>
                <th>No Seri</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>status_peminjaman</th>
            </tr>

            <?php
            foreach ($hasil as $user_data) {
                echo "<tr>";
                echo "<td>" . $user_data['noser'] . "</td>";
                echo "<td><img src='" . base_url("images/" . $user_data['image']) . "' width='100' height='100'></td>";
                echo "<td>" . $user_data['namlat'] . "</td>";
                echo "<td>" . $user_data['status_laporan_guru'] . "</td>";

            ?>

            <?php
                "</tr>";
            }
            ?>
        </table>
    </div>
</body>
<script>
</script>

</html>