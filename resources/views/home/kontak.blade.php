<!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row text-center">
        <div class="col-lg-12 pt-5 pt-lg-0 order-2 order-lg-1 text-center">
          <div data-aos="zoom-out">
            <h1 style="font-size: 28px;">{{ $title }}</h1>
           
          </div>
        </div>
        
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

<main id="main">

<!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Kontak</h2>
          <p>Menghubungi Kami</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Alamat:</h4>
                <p><?php echo nl2br($site->alamat) ?></p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p><?php echo $site->email ?></p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telepon:</h4>
                <p><?php echo $site->telepon ?></p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">

            <style type="text/css" media="screen">
              .peta {
                border: solid thin #EEE;
                background-color: #f5f5f5;
                padding: 10px;
                border-radius: 5px;
              }
              .peta iframe {
                min-height: 300px;
                height: auto;
                width: 100%;
              }
            </style>

            <div class="peta">
              <?php echo $site->google_map; ?>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

</main>