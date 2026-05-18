<div class="clearfix"></div>

<div class="carousel-trinhdien">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">

        <div class="box-title">
          <h3><?php echo $heading_title; ?></h3>
        </div>

        <div id="carousel<?php echo $module; ?>" class="owl-carousel nxt">

          <?php foreach ($banners as $banner) { ?>
            <div class="col-xs-12">

              <div class="border-box-new">
                <?php if ($banner['link']) { ?>
                  <div class="image"> <a href="<?php echo $banner['link']; ?>"> <img src="<?php echo $banner['image']; ?>"
                        alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>"
                        class="img-responsive"> </a></div>
                <?php } else { ?>
                  <div class="image"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>"
                      title="<?php echo $banner['title']; ?>" class="img-responsive"></div>
                <?php } ?>
                <div class="caption">
                  <?php if ($banner['link']) { ?>
                    <h2><a href="<?php echo $banner['link']; ?>"><?php echo $banner['title']; ?></a></h2>
                  <?php } else { ?>
                    <h2><?php echo $banner['title']; ?></h2>
                  <?php } ?>

                  <div class="is-divider"></div>

                  <h4><?php echo $banner['description']; ?></h4>

                  <div class="post-meta">

                  </div>

                </div>

              </div>

            </div>

          <?php } ?>

        </div>

      </div>
    </div>
  </div>
</div>
<script>
  (function () {
    // Helper to load JS or CSS dynamically
    function loadScript(src, cb) {
      var s = document.createElement('script');
      s.src = src;
      s.async = true;
      s.onload = cb;
      s.onerror = cb;
      document.head.appendChild(s);
    }
    function loadCSS(href) {
      var l = document.createElement('link');
      l.rel = 'stylesheet';
      l.href = href;
      document.head.appendChild(l);
    }

    // Ensure code runs after DOM ready
    function onReady(fn) {
      if (document.readyState === 'complete' || document.readyState === 'interactive') {
        setTimeout(fn, 0);
      } else {
        document.addEventListener('DOMContentLoaded', fn);
      }
    }

    onReady(function () {
      // Quick diagnostics - prints to console to help debugging
      try {
        console.log('jQuery typeof:', typeof window.jQuery, ' $.fn.owlCarousel:', window.jQuery && window.jQuery.fn ? typeof window.jQuery.fn.owlCarousel : 'no-jq-fn');
      } catch (e) {
        console.warn('diagnostics failed', e);
      }

      function initCarousel() {
        var id = '#carousel<?php echo $module; ?>';
        if (!window.jQuery) {
          console.error('jQuery is not available. Owl Carousel requires jQuery.');
          return;
        }
        var $ = window.jQuery;
        if (typeof $.fn.owlCarousel !== 'function') {
          console.warn('owlCarousel plugin not found yet.');
          return false;
        }

        // Try initializing as Owl Carousel v2 first; if it throws or doesn't enable nav,
        // fallback to v1-style init.
        var v2Options = {
          items: 8,
          autoplay: true,
          autoplayTimeout: 3000,
          nav: true,
          navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
          dots: true,
          loop: true,
          responsive: {
            0: { items: 1 },
            480: { items: 2 },
            768: { items: 3 },
            992: { items: 5 },
            1200: { items: 8 }
          }
        };

        var v1Options = {
          items: 8,
          autoPlay: 3000,
          navigation: true,
          navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
          pagination: true,
          singleItem: false,
          loop: true
        };

        // Attempt v2 init
        try {
          $(id).owlCarousel(v2Options);

          // Check nav presence after init; if nav buttons are present but disabled, enable nav via loop or show controls
          setTimeout(function () {
            var $owl = $(id).find('.owl-nav');
            if ($owl.length && $owl.find('.owl-prev, .owl-next').length) {
              // if nav buttons exist but have 'disabled' class, remove it when loop is true
              $owl.find('.owl-prev.disabled, .owl-next.disabled').removeClass('disabled');
            }
          }, 100);

          console.log('Owl Carousel initialized with v2 options.');
          return true;
        } catch (e) {
          console.warn('v2 init failed, trying v1 options:', e && e.message);
        }

        // Fallback: try v1-style init
        try {
          $(id).owlCarousel(v1Options);
          // If v1 created nav but it is disabled because items <= visible, force show nav
          setTimeout(function () {
            var $owl = $(id).find('.owl-nav');
            if ($owl.length) {
              $owl.find('.owl-prev, .owl-next').removeClass('disabled').css('opacity', 1).css('pointer-events', 'auto');
            }
          }, 100);
          console.log('Owl Carousel initialized with v1 options.');
          return true;
        } catch (err) {
          console.error('Both v2 and v1 initialization attempts failed:', err && err.message);
          return false;
        }
      }

      // If plugin already present, init immediately
      if (window.jQuery && window.jQuery.fn && typeof window.jQuery.fn.owlCarousel === 'function') {
        initCarousel();
        return;
      }

      // Otherwise attempt to load Owl Carousel (CSS + JS) from CDN and then init.
      // NOTE: If your project already includes Owl assets elsewhere, skip loading to avoid duplicates.
      var owlCss = 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css';
      var owlTheme = 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css';
      var owlJs = 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js';

      // Only load CSS once
      loadCSS(owlCss);
      loadCSS(owlTheme);

      // Load JS, then poll until plugin available
      loadScript(owlJs, function () {
        var attempts = 0;
        var maxAttempts = 20;
        var timer = setInterval(function () {
          attempts++;
          if (window.jQuery && window.jQuery.fn && typeof window.jQuery.fn.owlCarousel === 'function') {
            clearInterval(timer);
            initCarousel();
            return;
          }
          if (attempts >= maxAttempts) {
            clearInterval(timer);
            console.error('Failed to load/init owlCarousel after loading script. Check for jQuery conflicts or duplicate jQuery instances.');
          }
        }, 200);
      });
    });
  })();
</script>