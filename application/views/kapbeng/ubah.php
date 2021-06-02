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
                    <h2 class="title">Ubah Alat</h2>
                    <form action=" " method="post" name="form1" enctype="multipart/form-data">
                        <input type="hidden" name="id_alat" value="<?= $alat['id_alat']; ?>">
                        <div class="col-10">
                            <div class="form-group">
                                <label id="nama-alat">Nama Alat</label>
                                <input type="text" class="form-control" id="namlat" placeholder="Masukkan Nama Alat Disini" name="namlat" value="<?= $alat['namlat']; ?>">
                                <small class="form-text text-danger"><?= form_error('namlat') ?></small>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="nomor-seri">Nomor Seri Alat</label>
                                <input type="text" class="form-control" id="noser" placeholder="Masukkan Nomor Seri Alat Disini" name="noser" value="<?= $alat['noser']; ?>">
                                <small class="form-text text-danger"><?= form_error('noser') ?></small>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="jenis-alat">Jenis Alat</label>
                                <select class="form-control" id="jenlat" name="jenlat">
                                    <?php foreach ($jenlat as $j) : ?>
                                        <?php if ($j == $alat['jenlat']) : ?>
                                            <option value="<?= $j ?>" selected><?= $j ?></option>
                                        <?php else : ?>
                                            <option value="<?= $j ?>"><?= $j ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="jumlah-alat">Jumlah Alat</label>
                                <input type="text" class="form-control" id="jumlat" placeholder="Masukkan Jumlah alat Disini" name="jumlat" value="<?= $alat['jumlat']; ?>">
                                <small class="form-text text-danger"><?= form_error('jumlat') ?></small>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="keterangan-alat">Keterangan Alat</label>
                                <input type="text" class="form-control" id="ketlat" placeholder="Masukkan Keterangan alat Disini" name="ketlat" value="<?= $alat['ketlat']; ?>">
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="kondisi-alat">Kondisi Alat</label>
                                <select class="form-control" id="konlat" name="konlat">
                                    <?php foreach ($konlat as $k) : ?>
                                        <?php if ($k == $alat['konlat']) : ?>
                                            <option value="<?= $k ?>" selected><?= $k ?></option>
                                        <?php else : ?>
                                            <option value="<?= $k ?>"><?= $k ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="lokasi-alat">Lokasi Alat</label>
                                <input type="text" class="form-control" id="loklat" placeholder="Masukkan Lokasi Alat Disini" name="loklat" value="<?= $alat['loklat']; ?>">
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label id="gambar-alat">Gambar Alat</label>
                                <input type="file" class="form-control" id="image" name="input_gambar">
                            </div>
                        </div>
                        <button type="submit" name="ubah" id="ubah" class="btn btn-success float-right">Ubah</button>
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
                    $("#jenlat option:selected").each(function() {
                        if ($(this).attr("value") == "Tidak Sekali Pakai") {
                            $("#jumlah-alat").hide();
                            $("#jumlat").hide();
                            $("#keterangan-alat").hide();
                            $("#ketlat").hide();
                            $("#kondisi-alat").show();
                            $("#konlat").show();
                            $("#jmlh").removeAttr("required|numeric");
                            console.log("Tidak Sekali Pakai");
                        }
                        if ($(this).attr("value") == "Sekali Pakai") {
                            $("#jumlah-alat").show();
                            $("#jumlat").show();
                            $("#keterangan-alat").show();
                            $("#ketlat").show();
                            $("#kondisi-alat").hide();
                            $("#konlat").hide();
                            $("#jumlat").prop('required|numeric', true);
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