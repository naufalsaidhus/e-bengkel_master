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
                    <center>status_peminjaman</center>
                </th>
                <th>
                    <center>Aksi</center>
                </th>
            </tr>

            <?php
            foreach ($hasil as $user_data) {
                echo "<tr>";
                echo "<td>" . $user_data['noser'] . "</td>";
                echo "<td><img src='" . base_url("images/" . $user_data['image']) . "' width='100' height='100'></td>";
                echo "<td>" . $user_data['namlat'] . "</td>";
                echo "<td>" . $user_data['status_peminjaman'] . "</td>";

            ?>
                <?php if ($user_data['status_peminjaman'] == "Menunggu Persetujuan Dari Aspiran/Kapbeng") { ?>
                    <td>
                        <a href="<?= base_url(); ?>kapbeng/setuju/<?= $user_data['id_peminjaman']; ?>" class="badge badge-success" id="setuju" name="setuju">Setuju</a>
                        <a href="<?= base_url(); ?>kapbeng/tolak/<?= $user_data['id_peminjaman']; ?>" class="badge badge-danger" id="tolak" name="setuju">Tolak</a>
                    </td>
                <?php }
                if ($user_data['status_peminjaman'] == "Dipinjam") { ?>
                    <td>
                        <a href="<?= base_url(); ?>kapbeng/kembali/<?= $user_data['id_peminjaman']; ?>" class="badge badge-success" id="kembali" name="kembali">Dikembalikan</a>
                    </td>
                <?php } ?>
                <?php if ($user_data['status_peminjaman'] == "Dikembalikan") {
                    echo "<td> Tidak Ada Aksi </td>";
                } ?>
                <?php if ($user_data['status_peminjaman'] == "Ditolak Guru") {
                    echo "<td> Tidak Ada Aksi </td>";
                } ?>
                <?php if ($user_data['status_peminjaman'] == "Ditolak Kepala Bengkel") {
                    echo "<td> Tidak Ada Aksi </td>";
                } ?>
                <?php if ($user_data['status_peminjaman'] == "Ditolak Aspiran") {
                    echo "<td> Tidak Ada Aksi </td>";
                } ?>
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