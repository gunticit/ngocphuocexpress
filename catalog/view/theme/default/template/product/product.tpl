<?php echo $header; ?>
<div class="container product-info" id="product-page">
  <div class="row"><?php echo $column_left; ?>
  <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-12'; ?>
  <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-12'; ?>
  <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
  <?php } ?>
  <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
  <?php if(isset($description)){ ?>
    <div itemscope itemtype="http://schema.org/Product">
      <ul class="nav nav-tabs tabs-des" style="display: none;">
        <li class="active"><a href="#tab-description" data-toggle="tab"><?php echo $tab_description; ?></a></li>
        <?php if ($attribute_groups) { ?>
          <li><a href="#tab-specification" data-toggle="tab"><?php echo $tab_attribute; ?></a></li>
        <?php } ?>
        <?php if ($review_status) { ?>
          <li><a href="#tab-review" data-toggle="tab"><?php echo $tab_review; ?></a></li>
        <?php } ?>
      </ul>
      <style>
        .call-pro{
          text-align: center
        }
        .call-pro a{
          padding: 10px 20px;
          background: #e91515;
          color: #fff;
          transition: all ease .4s;
          border-radius: 10px;
        }
        .call-pro a:hover{
          background: #ff3939;
        }
        #button-cart{
          width: 150px;
          border-radius: 5px;
        }
        .call-pro .callme{
          display: inline-block;
        }
      </style>
      <div class="tab-content" id="des-pro">
        <div class="tab-pane active" id="tab-description" itemprop="description">
          <h3 class="model-pro">
            <?= $model; ?>
          </h3>
          <h1><?= $heading_title; ?></h1>
          <ul class="call-pro">
 <?php if($mpn) { ?> 


            <li class="callme"><a href="tel:<?= $mpn; ?>"><i class="fa fa-phone"></i> <b><?= $mpn; ?></b></a></li>
               <?php } ?>
               
            <?php if($location){ ?> 
            <li class="callme"><a href="tel:<?= $location; ?>"><i class="fa fa-phone"></i> <b><?= $location; ?></b></a></li>
            <?php } ?>
            <!-- <li id="product">
              <div class="qty">
                <label class="control-label" for="input-quantity"><?php echo $entry_qty; ?> vé</label>
                <input type="number" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                <div class="clear"></div>
              </div>
              <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg"><?php echo $button_cart; ?></button>
            </li> -->
          </ul>
          <?php echo $description; ?>
        </div>
        <?php if ($attribute_groups) { ?>
          <div class="tab-pane" id="tab-specification">
            <table class="table table-bordered">
              <?php foreach ($attribute_groups as $attribute_group) { ?>
                <thead>
                  <tr>
                    <td colspan="2"><strong><?php echo $attribute_group['name']; ?></strong></td>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                    <tr>
                      <td><?php echo $attribute['name']; ?></td>
                      <td><?php echo $attribute['text']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              <?php } ?>
            </table>
          </div>
        <?php } ?>
        <?php if ($review_status) { ?>
          <div class="tab-pane" id="tab-review">
            <form class="form-horizontal" id="form-review">
              <div id="review"></div>
              <h2><?php echo $text_write; ?></h2>
              <?php if ($review_guest) { ?>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                    <input type="text" name="name" value="" id="input-name" class="form-control" />
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label"><?php echo $entry_rating; ?></label>

                    <div class="rating set-rating">
                      <i class="fa fa-star-o" data-value="1"></i>
                      <i class="fa fa-star-o" data-value="2"></i>
                      <i class="fa fa-star-o" data-value="3"></i>
                      <i class="fa fa-star-o" data-value="4"></i>
                      <i class="fa fa-star-o" data-value="5"></i>
                    </div>
                    <script type="text/javascript">
                      $(document).ready(function() {
                        $('.set-rating i').hover(function() {
                          var rate = $(this).data('value');
                          var i = 0;
                          $('.set-rating i').each(function() {
                            i++;
                            if (i <= rate) {
                              $(this).attr("class","");
                              $(this).addClass('fa fa-star');
                            } else {
                              $(this).attr("class","");
                              $(this).addClass('fa fa-star-o');
                            }
                          })
                        })

                        $('.set-rating i').mouseleave(function() {
                          var rate = $('input[name="rating"]:checked').val();
                          rate = parseInt(rate);
                          i = 0;
                          $('.set-rating i').each(function() {
                            i++;
                            if (i <= rate) {
                              $(this).attr("class","");
                              $(this).addClass('fa fa-star');
                            } else {
                              $(this).attr("class","");
                              $(this).addClass('fa fa-star-o');
                            }
                          })
                        })

                        $('.set-rating i').click(function() {
                          $('input[name="rating"]:nth(' + ($(this).data('value') - 1) + ')').prop('checked', true);
                        });
                      });
                    </script>
                    <div class="hidden">
                      &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp;
                      <input type="radio" name="rating" value="1" />
                      &nbsp;
                      <input type="radio" name="rating" value="2" />
                      &nbsp;
                      <input type="radio" name="rating" value="3" />
                      &nbsp;
                      <input type="radio" name="rating" value="4" />
                      &nbsp;
                      <input type="radio" name="rating" value="5" />
                      &nbsp;<?php echo $entry_good; ?>
                    </div>
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                    <div class="help-block"><?php echo $text_note; ?></div>
                  </div>
                </div>

                <?php echo $captcha; ?>
                <div class="buttons">
                  <div class="pull-right">
                    <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_continue; ?></button>
                  </div>
                </div>
              <?php } else { ?>
                <?php echo $text_login; ?>
              <?php } ?>
            </form>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
  <?php if(isset($images)){ ?> 
    <div id="gallery-pro">
      <!-- <h5>Ảnh Thực Tế</h5> -->
      <?php foreach($images as $img){ ?>
        <div class="col m3 img">
          <a href="<?= $img['image']; ?>">
            <img src="<?= $img['image']; ?>" alt="" />
          </a>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
  <div class="table-lichtrinh hidden-xs">
    <table>
      <caption>LỊCH TRÌNH XE CHẠY</caption>
      <thead>
        <tr>
          <th>Xuất bến</th>
          <th>Điểm đi</th>
          <th>Điểm đến</th>
          <th>Loại xe</th>
          <th>Quảng đường</th>
          <th>Hành trình</th>
          <th>Giá vé</th>
          <th>Tổng đài đặt vé</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($ean as $key => $ea){ ?> 
          <tr>
            <td><?= $ea['datehour']; ?></td>
            <td><?= !empty($sku['name'])?$sku['name']:''; ?></td>
            <td><?= !empty($upc['name'])?$upc['name']:''; ?></td>
            <td><?= $jan; ?></td>
            <td><?= $isbn; ?></td>
            <td><?= $qdg; ?> km</td>
            <td><?= $ea['price']; ?> VNĐ</td>
            <td><a href="tel:<?= ($key % 2 != 0)?$mpn:$location; ?>"><?= ($key % 2 != 0)?$mpn:$location; ?></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="table-lichtrinh-xs visible-xs">
    <?php foreach($ean as $key => $ea){ ?> 
      <ul>
        <li>Xuất bến: <?= $ea['datehour']; ?></li>
        <li>Điểm đi: <?= !empty($sku['name'])?$sku['name']:''; ?></li>
        <li>Điểm đến: <?= !empty($upc['name'])?$upc['name']:''; ?></li>
        <li>Loại xe: <?= $jan; ?></li>
        <li>Quảng đường: <?= $isbn; ?></li>
        <li>Hành trình: <?= $qdg; ?> km</li>
        <li>Giá vé: <?= $ea['price']; ?> VNĐ</li>
        <li>Tổng đài đặt vé: <a href="tel:<?= ($key % 2 != 0)?$mpn:$location; ?>"><?= ($key % 2 != 0)?$mpn:$location; ?></a></li>
      </ul>
    <?php } ?>
  </div>
  <div class="pro-relate">
    <h3>Bài viết khác</h3>
    <ul>
      <?php foreach($products as $product){ ?> 
        <li>
          <?php include($product_item); ?>
        </li>
      <?php } ?>
    </ul>
  </div>
  <?php echo $content_bottom; ?></div>
  <?php echo $column_right; ?></div>
</div>
<script type="text/javascript">
  $("#product-zomm").elevateZoom({
   gallery:'product-gallery',
   cursor: 'pointer',
   galleryActiveClass: 'active',
   imageCrossfade: true,
   zoomWindowFadeIn: 500,
   zoomWindowFadeOut: 500,
   lensFadeIn: 500,
   lensFadeOut: 500,
   loadingIcon: 'catalog/view/theme/default/image/progress.gif'
 }); 

  $("#product-zomm").bind("click", function(e) {
   var ez =   $('#product-zomm').data('elevateZoom');
   $.swipebox(ez.getGalleryList());
   return false;
 });

  $(document).ready(function() {
   $(".image-additional").owlCarousel({
    items: 5,
    navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    navigation : true,
    pagination: false
  });
 });

</script> 
<style>
  .pro-relate{
    position: relative;
    margin-top: 30px;
  }
  .pro-relate .slick-arrow{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
  }
  .pro-relate .slick-arrow.slick-prev{
   left: -30px;
 }
 .pro-relate .slick-arrow.slick-next{
  right: -30px;
}
.pro-relate .product-thumb{
  padding: 10px;
}
.pro-relate .product-thumb h4 a{
  font-size: 15px;
  font-weight: 500;
  padding-left: 12px;
  margin-top: 15px;
  display: block;
  color: #ff0000;
  text-align: center;
}
.table-lichtrinh{
  display: inline-block;
  padding: 30px;
  background: #f8f8f8;
}
.table-lichtrinh table{
  margin-bottom: 0;
}
.table-lichtrinh caption{
  color: #000;
  position: relative;
  text-transform: uppercase;
  font-size: 28px;
  font-weight: 500;
  text-align: center;
  margin-bottom: 20px;
  font-family: "Roboto", sans-serif;
}
.table-lichtrinh caption:after{
  content: '';
  left: 50%;
  bottom: -3px;
  z-index: 1;
  transform: translateX(-50%);
  width: 50%;
  height: 3px;
  background: #ccc;
  display: inline-block;
  position: absolute;
  transition: all ease .4s;
}
.table-lichtrinh caption:hover:after{
  width: calc(100% - 60px);
}
.table-lichtrinh thead{
  background: #a3ebeb;
}
.table-lichtrinh tbody{
  background: #fff;
}
.table-lichtrinh th, .table-lichtrinh td{
  padding: 8px;
}
.pro-relate .product-thumb .descr-pro,.pro-relate .view-pro{
  display: none;
}
.pro-relate h3{
  font-size: 18px;
  color: #000;
}
</style>
<script>
  jQuery(document).ready(function($) {
    $('.pro-relate ul').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 1,
      prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
      responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      ]
    });
  });
</script>
<script type="text/javascript"><!--
  $('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
   $.ajax({
    url: 'index.php?route=product/product/getRecurringDescription',
    type: 'post',
    data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
    dataType: 'json',
    beforeSend: function() {
     $('#recurring-description').html('');
   },
   success: function(json) {
     $('.alert, .text-danger').remove();

     if (json['success']) {
      $('#recurring-description').html(json['success']);
    }
  }
});
 });
 //--></script> 
 <script type="text/javascript"><!--
  $('#button-cart').on('click', function() {
   $.ajax({
    url: 'index.php?route=checkout/cart/add',
    type: 'post',
    data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
    dataType: 'json',
    beforeSend: function() {
     $('#button-cart').button('loading');
   },
   complete: function() {
     $('#button-cart').button('reset');
   },
   success: function(json) {
     $('.alert, .text-danger').remove();
     $('.form-group').removeClass('has-error');

     if (json['error']) {
      if (json['error']['option']) {
       for (i in json['error']['option']) {
        var element = $('#input-option' + i.replace('_', '-'));

        if (element.parent().hasClass('input-group')) {
         element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
       } else {
         element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
       }
     }
   }

   if (json['error']['recurring']) {
     $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
   }

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}

			if (json['success']) {
				$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				$('#cart > button').html('<div class="pull-left flip"><h4></h4></div><span id="cart-total"> ' + json['total'] + '</span> <i class="fa fa-caret-down"></i>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');

				$('#cart > ul').load('index.php?route=common/cart/info ul li');
			}
      location.href="thanh-toan";
		}
	});
 });
 //--></script> 
 <script type="text/javascript"><!--
  $('.date').datetimepicker({
   pickTime: false
 });

  $('.datetime').datetimepicker({
   pickDate: true,
   pickTime: true
 });

  $('.time').datetimepicker({
   pickDate: false
 });

  $('button[id^=\'button-upload\']').on('click', function() {
   var node = this;

   $('#form-upload').remove();

   $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

   $('#form-upload input[name=\'file\']').trigger('click');

   if (typeof timer != 'undefined') {
     clearInterval(timer);
   }

   timer = setInterval(function() {
    if ($('#form-upload input[name=\'file\']').val() != '') {
     clearInterval(timer);

     $.ajax({
      url: 'index.php?route=tool/upload',
      type: 'post',
      dataType: 'json',
      data: new FormData($('#form-upload')[0]),
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
       $(node).button('loading');
     },
     complete: function() {
       $(node).button('reset');
     },
     success: function(json) {
       $('.text-danger').remove();

       if (json['error']) {
        $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
      }

      if (json['success']) {
        alert(json['success']);

        $(node).parent().find('input').attr('value', json['code']);
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
     alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
   }
 });
   }
 }, 500);
 });
 //--></script> 
 <script>
  $(function () {
   $(window).scroll(function () {
     if ($(this).scrollTop() > 100) {
      $('.tophead').removeClass('pin-top');
      $('.tophead').addClass('pinned');
    } else {
      $('.tophead').addClass('pin-top');
      $('.tophead').removeClass('pinned');
    }
  });
 });
  $('#gallery-pro a').magnificPopup({
    type: 'image',
    gallery:{
      enabled:true
    }
  });
</script>
<script type="text/javascript"><!--
  $('#review').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
  });

  $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

  $('#button-review').on('click', function() {
   $.ajax({
    url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
    type: 'post',
    dataType: 'json',
    data: $("#form-review").serialize(),
    beforeSend: function() {
     $('#button-review').button('loading');
   },
   complete: function() {
     $('#button-review').button('reset');
   },
   success: function(json) {
     $('.alert-success, .alert-danger').remove();

     if (json['error']) {
      $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
    }

    if (json['success']) {
      $('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

      $('input[name=\'name\']').val('');
      $('textarea[name=\'text\']').val('');
      $('input[name=\'rating\']:checked').prop('checked', false);
    }
  }
});
 });

  $('.review_href').click(function () {
   $('body,html').stop(false, false).animate({
     scrollTop: $('.tabs-des').offset().top
   }, 800);
   return false;
 });
  $('#thong-so').click(function () {
   $('body,html').stop(false, false).animate({
     scrollTop: $('.thongso').offset().top
   }, 800);
   return false;
 });
 //--></script> 
 <script>
  $(document).ready(function() {
    $("#about-des").click(function(e) {
      $("html, body").animate({ scrollTop: $('#des-pro').offset().top }, "slow");
      return false;
    });
  });
</script>
<?php echo $footer; ?>