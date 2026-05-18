<!DOCTYPE html>

<!--[if IE]><![endif]-->

<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->

<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->

<!--[if (gt IE 9)|!(IE)]><!-->

<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">

<!--<![endif]-->

<head>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T59RG9V');</script>
<!-- End Google Tag Manager -->
  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo $title; ?></title>

  <base href="<?php echo $base; ?>" />

  <?php if ($description) { ?>

  <meta name="description" content="<?php echo $description; ?>" />

  <?php } ?>

  <?php if ($keywords) { ?>

  <meta name="keywords" content= "<?php echo $keywords; ?>" />

  <?php } ?>

  <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>

  <link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />

  <script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  <link href="catalog/view/javascript/mmenu/jquery.mmenu.all.css" rel="stylesheet" type="text/css" />

  <script src="catalog/view/javascript/mmenu/jquery.mmenu.all.min.js" type="text/javascript"></script>

  <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <link href="catalog/view/font/fonts.css" rel="stylesheet" type="text/css" />
  <link href="catalog/view/font/stm-icon.css" rel="stylesheet" type="text/css" />

  <link href="catalog/view/theme/default/stylesheet/animate.css" rel="stylesheet">
  <link rel="stylesheet" id="twentyfifteen-fonts-css" href="https://fonts.googleapis.com/css?family=Noto+Sans%3A400italic%2C700italic%2C400%2C700%7CNoto+Serif%3A400italic%2C700italic%2C400%2C700%7CInconsolata%3A400%2C700&amp;subset=latin%2Clatin-ext" type="text/css" media="all">
  <link rel="stylesheet" id="twentyfifteen-fonts-css" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=vietnamese" type="text/css" media="all">
  <link rel="stylesheet" id="twentyfifteen-fonts-css" href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" media="all">
  <!-- <link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet"> -->
  <link href="catalog/view/theme/default/stylesheet/materialize.min.css" rel="stylesheet">
  <link href="catalog/view/theme/default/stylesheet/magnific-popup.css" rel="stylesheet">
  <link href="catalog/view/theme/default/stylesheet/style.css" rel="stylesheet">
  <!-- Modern UI Fonts & Override -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@500;600;700;800&display=swap" rel="stylesheet">
  <link href="catalog/view/theme/default/stylesheet/modern-override.css" rel="stylesheet">
  <style>
    .{
      background: #fff;
    }
  </style>

  <?php foreach ($styles as $style) { ?>

  <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />

  <?php } ?>

  <script src="catalog/view/javascript/jquery.magnific-popup.min.js" type="text/javascript"></script>
  <script src="catalog/view/javascript/common.js" type="text/javascript"></script>

  <?php foreach ($links as $link) { ?>

  <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />

  <?php } ?>

  <?php foreach ($scripts as $script) { ?>

  <script src="<?php echo $script; ?>" type="text/javascript"></script>

  <?php } ?>

  <?php foreach ($analytics as $analytic) { ?>

  <?php echo $analytic; ?>

  <?php } ?>

  <script src="catalog/view/javascript/wow.min.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $( "#menu-item-110" ).hover(function(){
        $('#product-show').show();
      }, function(){
        $('#product-show').hover(function(){
          $('#product-show').show();
        },function(){
          $('#product-show').hide();
        })
        $('#product-show').hide();  

      });
    });
    
  </script>
  <script>

    wow = new WOW(

    {

      animateClass: 'animated',

      offset:       100,

      callback:     function(box) {

        console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")

      }

    }

    );

    wow.init();

  </script>

  <script type='text/javascript'>

    $(document).ready(function() {

      $('.btn-swmb1'). on('click', function() {

        $('meta[name=viewport]'). remove();

        $('head'). append( '<meta name="viewport" content="width=1200">' );

      });

      $('.btn-swmb2'). on('click', function() {

        $('meta[name=viewport]'). remove();

        $('head'). append( '<meta name="viewport" content="width=device-width, initial-scale=1">' );

      });

    });

  </script>

  <script>
    $(document).ready(function() {
      $('.btn-menu-mobile').click(function(){
        $(this).toggleClass('clickactive');
        $('.megamenu-mobile').toggleClass('showmnmb');
      })
      $('.btn-close-mnmb').click(function(){
        $('.megamenu-mobile').removeClass('showmnmb');
        $('.btn-menu-mobile').removeClass('clickactive');
      });
    });
  </script>
</head>

<body class="<?php echo $class; ?>">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T59RG9V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <div>

    <?php echo $header_top; ?>
    <div class="nav-head-top">
      <div class="container">
        <div class="row" style="display: flex; flex-wrap: wrap; position: relative;">
          <div class="col-sm-3 logo">
            <a id="logo" href="" rel="home">
              <img src="<?= $logo; ?>" alt="">
            </a>
          </div>
          <div class="col-sm-9 text-right" style="position: unset;">
            <div class="language">
              <div class="hotline">
                <i class="fa fa-phone"></i>
                <div class="text-hotline">
                  <span>Hotline</span>
                  <span>
                +84.979.82.9998
                  </span>
                </div>
              </div>
              <div class="search-header">
                <?= $search; ?>
              </div>
              <?= $language; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <header style="position: relative;">
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <?= $megamenu; ?>
          </div>
          <div class="col-sm-3">
            <div class="form-register" data-toggle="modal" data-target="#myModal">
              <img src="image/catalog/formwp.png" alt="">
              <span>Nhận tư vấn Online</span>
            </div>
          </div>
        </div>
      </div>
    </header>





    <div class="content-header">

     <?php echo $header_bottom; ?>

   </div>

