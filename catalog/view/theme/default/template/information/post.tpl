<?php echo $header; ?>

<div class="page-title title-left transparent-bg" style="min-height: 50px;">

  <div class="wf-wrap">

    <div class="wf-container-title">

      <div class="wf-table container" style="height: 50px;">

        <div class="row">

          <div class="wf-td col-sm-12"><div class="assistive-text"></div>

          <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">

            <?php foreach ($breadcrumbs as $breadcrumb) { ?>

              <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="<?php echo $breadcrumb['href']; ?>" itemprop="item"><span itemprop="name"><?php echo $breadcrumb['text']; ?></span></a></li>

            <?php } ?>

          </ul> 

        </div>

      </div>

    </div>

  </div>

</div>

</div>

<div class="container news-container">

  <div class="row"><?php echo $column_left; ?>

    <?php if ($column_left && $column_right) { ?>

    <?php $class = 'col-sm-9'; ?>

    <?php } elseif ($column_left || $column_right) { ?>

    <?php $class = 'col-sm-12'; ?>

    <?php } else { ?>

    <?php $class = 'col-sm-12'; ?>

    <?php } ?>

    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>

      <?php if ($banner) { ?>

      <div class="news-banner"><a href="<?php echo $banner; ?>" class="news-gallery" title="<?php echo $heading_title; ?>"><img src="<?php echo $banner; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></a></div>

      <?php } ?>

      <?php if ($post_image) { ?>

      <div class="row img">

        <?php foreach ($post_image as $result) { ?>

        <div class="col-md-4 col-sm-3"> <a href="<?php echo $result['image']; ?>" class="news-gallery" title="<?php echo $result['title']; ?>"><img src="<?php echo $result['thumb']; ?>" class="img-responsive" title="<?php echo $result['title']; ?>" alt="<?php echo $result['title']; ?>" /></a> </div>

        <?php } ?>

      </div>

      <?php } ?>

      <div class="news-title-post">

        <h1><?php echo $heading_title; ?></h1>

      </div>



      <div class="news-description"> <?php echo $description; ?></div>

      

       

      


      <?php if ($view_relate) { ?>

      <div class="post-rel">

      <?php if($post_relateds){ ?>

      <div class="news-realate">

        <h2><?php echo $text_post_realate; ?></h2>

      </div>

      <div class="row">

        <?php foreach ($post_relateds as $relate){ ?>

        <div class="news-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">

          <div class="image"><a href="<?php echo $relate['href']; ?>"><img src="<?php echo $relate['image']; ?>" alt="<?php echo $relate['title']; ?>" title="<?php echo $relate['title']; ?>" class="img-responsive" /></a>

            <div class="news-date"><?php echo $relate['date_added']; ?></div>

          </div>

          <div class="caption">

            <h4><a href="<?php echo $relate['href']; ?>"><?php echo $relate['title']; ?><?php echo $relate['post_id']; ?></a></h4>

          </div>

        </div>

        <?php } ?>

      </div>

      <?php  } ?>

      </div>

      <?php } ?>

      <?php echo $content_bottom; ?></div>

    <?php echo $column_right; ?></div>

</div>

<script type="text/javascript">

$('.news-gallery').swipebox();

</script> 

<script type="text/javascript"><!--

$('#review').delegate('.pagination a', 'click', function(e) {

  e.preventDefault();



    $('#review').fadeOut('slow');



    $('#review').load(this.href);



    $('#review').fadeIn('slow');

});



$('#review').load('index.php?route=information/post/review&post_id=<?php echo $post_id; ?>');



$('#button-review').on('click', function() {

	$.ajax({

		url: 'index.php?route=information/post/write&post_id=<?php echo $post_id; ?>',

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

				<?php if($view_instantly) echo "document.location.reload();"; ?>

			}

		}

	});

});

//--></script> 

<?php echo $footer; ?> 