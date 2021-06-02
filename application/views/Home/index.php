<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1">
        <h1>HAYU BERJELAJAH!</h1>
        <h2>Menyediakan Kebutuhan Siswa SIJA</h2>
        <?= $this->session->flashdata('message'); ?>
        <a href="<?= base_url('Auth/index'); ?>" class="btn-get-started scrollto">Login</a>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img">
        <img src="<?= base_url() ?>assets/img/hero-img.svg" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>

</section><!-- End Hero -->

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row justify-content-between">
        <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
          <img src="<?= base_url() ?>assets/img/about-img.svg" class="img-fluid" alt="" data-aos="zoom-in">
        </div>
        <div class="col-lg-6 pt-5 pt-lg-0">
          <h3 data-aos="fade-up">Bengkel Online </h3>
          <div class="row">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-receipt"></i>
              <h4>Penjelasan</h4>
              <p>Merupakan web yang berguna untuk meminjam alat yang dibutuhkan siswa-siswi SIJA secara online</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End About Section -->


  <!-- ======= Clients Section ======= -->
  <section id="sponsor" class="clients section-bg">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Sponsor</h2>
        <p>Mereka Penting!</p>
      </div>

      <div class="owl-carousel clients-carousel" data-aos="fade-up" data-aos-delay="100">
        <img src="<?= base_url() ?>assets/img/clients/client-1.png" alt="">
        <img src="<?= base_url() ?>assets/img/clients/client-2.png" alt="">
        <img src="<?= base_url() ?>assets/img/clients/client-3.png" alt="">
        <img src="<?= base_url() ?>assets/img/clients/client-4.png" alt="">
        <img src="<?= base_url() ?>assets/img/clients/client-5.png" alt="">
        <img src="<?= base_url() ?>assets/img/clients/client-6.png" alt="">
      </div>

    </div>
  </section><!-- End Clients Section -->



</main><!-- End #main -->