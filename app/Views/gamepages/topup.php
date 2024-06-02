<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row">
      <!-- Text Column -->
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Elevate Your Gaming Experience with Effortless In-Game Purchases</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">Explore a world of seamless top-up solutions for enhancing your gaming adventures</h2>
        <div data-aos="fade-up" data-aos-delay="600">
        </div>
      </div>

      <!-- Carousel Column -->
      <div class="col-lg-6">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" data-aos="fade-up" data-aos-delay="400">
            <div class="carousel-item active">
              <img src="<?= base_url() ?>assets-game/img/wallpaper.jpg" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>assets-game/img/valorant2.jpg" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>assets-game/img/mltrans.jpg" class="d-block w-100" alt="Slide 3">
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>assets-game/img/pubgwall.jpg" class="d-block w-100" alt="Slide 4">
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero -->


<!-- ***** Other End ***** -->

<section id="values" class="values">

  <div class="container" data-aos="fade-up">

    <header class="section-header">
      <h2>TOP UP</h2>
      <p>Top Up Your Games Here!</p>
    </header>

    <div class="row">
      <?php foreach ($getData as $row) : ?>
        <?php if ($row->status === 'Active') : ?>
          <div class="col-lg-3 col-sm-6">
            <a href="<?= base_url('Transaksi/topupadd/' . $row->id_game) ?>" class="item-link">
              <div class="row mb-4">
                <div class="item-body">
                  <img src="<?= base_url('/assets/uploads/img/' . $row->file) ?>" alt="Game Image" width="250" height="250">
                  <h3 class="item-title pt-3"><?= $row->name_game ?></h3>
                  <p><?= $row->status ?></p>
                </div>
              </div>
            </a>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>



  </div>


</section><!-- End Values Section -->