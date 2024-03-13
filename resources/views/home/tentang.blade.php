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


        <div class="row">

          <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
            
            <img src="{{ asset('assets/upload/image/'.$site->gambar) }}" class="img img-thumbnail">

          </div>

          <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">

            <?php echo $site->tentang; ?>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

</main>