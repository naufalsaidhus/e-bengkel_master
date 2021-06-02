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
      <div class="header">Barang</div>
      <table cellspacing="0">
         <tr>
            <th>No Seri</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kondisi</th>
            <th>Lokasi</th>
            <th>Jenis</th>
            <th>Status/Jumlah</th>
            <th>Aksi</th>
         </tr>

         <?php
         foreach ($alat as $user_data) {
            echo "<tr>";
            echo "<td>" . $user_data['noser'] . "</td>";
            echo "<td><img src='" . base_url("images/" . $user_data['image']) . "' width='100' height='100'></td>";
            echo "<td>" . $user_data['namlat'] . "</td>";
            echo "<td>" . $user_data['konlat'] . "</td>";
            echo "<td>" . $user_data['loklat'] . "</td>";
            echo "<td>" . $user_data['jenlat'] . "</td>";
            if ($user_data['jenlat'] == "Tidak Sekali Pakai") {
               echo "<td>" . $user_data['status'] . "</td>";
            } else {
               echo "<td>" . $user_data['jumlat'] . "</td>";
            }

         ?>
            <td> <a href="<?= base_url(); ?>Aspiran/ubah/<?= $user_data['id_alat']; ?>" class="badge badge-success">ubah</a>
               <a href="<?= base_url(); ?>Aspiran/hapus/<?= $user_data['id_alat']; ?>" class="badge badge-danger" onclick="return confirm('yakin hapus?');">hapus</a>
            </td>
         <?php
            "</tr>";
         }
         ?>
      </table>
   </div>
</body>

</html>