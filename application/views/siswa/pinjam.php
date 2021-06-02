<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Icons font CSS-->
    <link href="<?= base_url(); ?>assets3/vendor1/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets3/vendor1/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="<?= base_url(); ?>assets3/vendor1/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets3/vendor1/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?= base_url(); ?>assets3/css1/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="<?= base_url(); ?>assets3/css2/style.css">
</head>

<body>
    <div class="page-wrapper p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Pinjam Alat</h2>
                    <form action=" " method="post" name="form1" enctype="multipart/form-data">
                        <input type="hidden" name="id_alat" value="<?= $alat['id_alat']; ?>">
                        <div class="col-10">
                            <div class="form-group">
                                <label id="nama-alat">Nama Alat</label>
                                <input type="text" class="form-control" id="namlat" name="namlat" value="<?= $alat['namlat']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="nomor-seri">Nomor Seri Alat</label>
                                <input type="text" class="form-control" id="noser" name="noser" value="<?= $alat['noser']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="nomor-seri">Jenis Alat</label>
                                <input type="text" class="form-control" id="jenlat" name="jenlat" value="<?= $alat['jenlat']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="jumlah-alat">Jumlah Alat</label>
                                <input type="text" class="form-control" id="jumlat" name="jumlat" value="<?= $alat['jumlat']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="keterangan-alat">Keterangan Alat</label>
                                <input type="text" class="form-control" id="ketlat" name="ketlat" value="<?= $alat['ketlat']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="keterangan-alat">Kondisi Alat</label>
                                <input type="text" class="form-control" id="konlat" name="konlat" value="<?= $alat['konlat']; ?>" readonly>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label id="lokasi-alat">Lokasi Alat</label>
                                <input type="text" class="form-control" id="loklat" name="loklat" value="<?= $alat['loklat']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label id="Gambar Alat">Gambar Alat</label>
                                <img src="<?= base_url('images/') . $alat['image']; ?>" class="img-thumbnail">
                            </div>
                            </did>
                            <div class="col-10">
                                <div class="form-group">
                                    <label id="jumlah-pinjam">Jumlah Alat Yang Ingin Di Pinjam</label>
                                    <input type="text" class="form-control" id="jumlah_pinjam" name="jumlah_pinjam" placeholder="Masukkan Jumlah Yang Ingin Dipinjam......">
                                </div>
                            </div>
                            <button type="submit" name="pinjam" id="pinjam" class="btn btn-success float-right">Pinjam</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Jquery JS-->
            <script src="<?= base_url(); ?>assets3/vendor1/jquery/jquery.min.js"></script>
            <!-- Vendor JS-->
            <script src="<?= base_url(); ?>assets3/vendor1/select2/select2.min.js"></script>
            <script src="<?= base_url(); ?>assets3/vendor1/datepicker/moment.min.js"></script>
            <script src="<?= base_url(); ?>assets3/vendor1/datepicker/daterangepicker.js"></script>

            <!-- Main JS-->
            <script src="<?= base_url(); ?>assets3/js1/global.js"></script>
            <script>
                $(document).ready(function() {
                    $("#jenlat").change(function() {
                        $("#jenlat").each(function() {
                            if ($(this).attr("value") == "Tidak Sekali Pakai") {
                                $("#jumlah-alat").hide();
                                $("#jumlat").hide();
                                $("#keterangan-alat").hide();
                                $("#ketlat").hide();
                                $("#kondisi-alat").show();
                                $("#konlat").show();
                                $("#jumlah-pinjam").hide();
                                $("#jumlah_pinjam").hide();
                                $("#jumlah_pinjam").removeAttr("required|numeric");
                                console.log("Tidak Sekali Pakai");
                            }
                            if ($(this).attr("value") == "Sekali Pakai") {
                                $("#jumlah-alat").show();
                                $("#jumlat").show();
                                $("#keterangan-alat").show();
                                $("#ketlat").show();
                                $("#kondisi-alat").hide();
                                $("#konlat").hide();
                                $("#jumlah-pinjam").show();
                                $("#jumlah_pinjam").show();
                                $("#jumlah_pinjam").prop('required|numeric', true);
                                console.log("Sekali Pakai");
                            }
                        });
                    }).change();
                });
                $("#error").fadeTo(5000, 500).fadeOut(1000, function() {
                    $("#error").remove(500);
                });
                $("#error1").fadeTo(5000, 500).fadeOut(1000, function() {
                    $("#error1").remove(500);
                });
            </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->