<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/profile/') . $user['images'] ?>" class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $user['name']; ?></h5>
                            <p class="card-text"><?= $user['email']; ?></p>
                            <p class="card-text"><small class="text-muted">Terdaftar Sejak <?= date('d F Y', $user['date_created']); ?></small></p>
                            <a class="btn btn-primary" href="<?= base_url('Siswa/edit') ?>" role="button">Ubah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img">
                <img src="../assets/img/hero-img.svg" class="img-fluid animated" alt="">
            </div>
        </div>

</section><!-- End Hero -->

<main id="main">






</main><!-- End #main -->