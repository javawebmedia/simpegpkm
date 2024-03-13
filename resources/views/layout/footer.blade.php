<?php 
use Illuminate\Support\Facades\DB;
$site_config = DB::table('konfigurasi')->first();
?>
<!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
       
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>{{ $site_config->namaweb }}</span></strong>. All Rights Reserved
      </div>
      <div class="credits" style="display: none;">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/template') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{ asset('assets/template') }}/assets/vendor/aos/aos.js"></script>
  <script src="{{ asset('assets/template') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/template') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('assets/template') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('assets/template') }}/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/template') }}/assets/js/main.js"></script>

</body>

</html>