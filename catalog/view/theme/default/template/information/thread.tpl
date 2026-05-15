<?php echo $header; ?>
<div class="page-title title-left transparent-bg" style="min-height: 50px;">
  <div class="wf-wrap">
    <div class="wf-container-title">
      <div class="wf-table container" style="height: 50px;">
        <div class="row">
          <div class="wf-td col-sm-7"><h1 class="h3-size entry-title"><?php echo $heading_title; ?></h1></div>
          <div class="wf-td col-sm-5"><div class="assistive-text"></div>
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
<div class="bg-thread-news">
  <?php echo $content_top; ?>
  <?php if(!empty($config_comment)){ ?> 
    <div class="alert-thread">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p><?= $config_comment; ?></p>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (strip_tags($description) != '') { ?>

    <div class="box-content row">

    <div class="col-sm-12"> 

      <div class="col-sm-12">
             <?php echo $description; ?>
      </div>
 
        
      </div> </div>

  <?php }?>

  <div class="news-content container">

    <div class="row">

      <?php if($format == 'blog') { ?>

        <?php foreach ($posts as $post) { ?> 

          <div class="col-sm-12">


         

            <div class="row">

              <div class="image col-sm-4">
<h2 class="news-title"  style="margin-top: 10px;font-size: 16px;" >
    <a  href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>

                <a href="<?php echo $post['href']; ?>"><img style="margin-top: 12px;" src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" /> </a></div>

              <div class="col-sm-8">
<!-- 
                <div class="news-date">

                  <div class="date"><p class="entry-month"><?= date('m',$post['date_added']); ?></p><p class="entry-year"><?= date('Y',$post['date_added']); ?></p></div>

                </div> -->

                <div class="new-caption" style="margin-top: 10px;"> <?php echo $post['short_description']; ?> </div>

              <div class="view-more"><a  href="<?php echo $post['href']; ?>"><?php echo $text_see_more; ?></a></div>

              </div>

            </div>

          </div>

        <?php } ?>

      <?php } else if ($format == 'gallery') { ?>

        <?php foreach ($posts as $post) { ?>

          <div class="col-xs-12">

            <div class="bg-news-thread">

              <div class="image"><a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" />

              </a></div>

              <div class="caption">

                <h2><a href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>

              </div>

            </div>

          </div>

        <?php } ?>

      <?php } else { ?>

        <?php foreach ($posts as $key => $post) { ?>

          <div class="col-sm-12 col-xs-12">

            <div class="bg-news-thread row">
              <?php if($key % 2 == 0){ ?> 
                <div class="col-sm-12
                ">
                    <div class="image col-sm-3"><a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" /></a>

                </div>

                <div class="caption col-sm-9">

                  <h2><a href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>
         
                  <h4><?php echo $post['short_description']; ?></h4>

                  <!-- <div class="view-more"><a href="<?php echo $post['href']; ?>"><?php echo $text_see_more; ?></a></div> -->

                </div>

                </div>
              

              <?php } else { ?> 
                
               <div class="caption col-sm-8">

                <h2><a href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>
             
                <h4><?php echo $post['short_description']; ?></h4>

                <!-- <div class="view-more"><a href="<?php echo $post['href']; ?>"><?php echo $text_see_more; ?></a></div> -->

              </div>
              <div class="image col-sm-3"><a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" /></a>

              </div>

            <?php } ?>

          </div>

        </div>

      <?php } ?>

    <?php } ?>

  </div>

</div>

<div class="col-sm-12 text-left" style="text-align: center;"><?php echo $pagination; ?></div>

<div class="row"> </div>

<?php echo $content_bottom; ?></div>
  <!-- <div class="container">

    <div class="row"><?php echo $column_left; ?>

      <?php if ($column_left && $column_right) { ?>

      <?php $class = 'col-sm-9'; ?>

      <?php } elseif ($column_left || $column_right) { ?>

      <?php $class = 'col-sm-12'; ?>

      <?php } else { ?>

      <?php $class = 'col-sm-12'; ?>

      <?php } ?>

      <?php if ($threads) { ?>

      <div class="col-sm-3 padding-15">

        <div class="list-group module-category">

          <h3><i class="icon fa fa-bars"></i> <?php echo $heading_title; ?></h3>

          <ul class="cnt-thread">

            <?php foreach ($threads as $thread) { ?>

            <?php if (str_replace(' ', '', $thread['name']) != '') { ?>

            <?php if ($thread['thread_id'] == $thread_id) { ?>

            <li class="list-group-item active"><a href="<?php echo $thread['href']; ?>"><?php echo $thread['name']; ?></a><span class="triangle"></span></li>

            <?php } else { ?>

            <li class="list-group-item"><a href="<?php echo $thread['href']; ?>"><?php echo $thread['name']; ?></a><span class="triangle"></span></li>

            <?php } ?>

            <?php } ?>

            <?php } ?>

          </ul>

        </div>

      </div>

      <?php $class = 'col-sm-9'; ?>

      <?php } ?>

    <div id="content" class="<?php echo $class; ?>">
      <?php echo $content_top; ?>

      <?php if (strip_tags($description) != '') { ?>

      <div class="box-content row"> <?php echo $description; ?> </div>

      <?php }?>

      <div class="news-content">

        <h1><?php echo $heading_title; ?></h1>

        <div class="row">

          <?php if($format == 'blog') { ?>

          <?php foreach ($posts as $post) { ?> 

          <div class="news-layout news-blog col-sm-12">

            <h2 class="news-title"><a href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>

            <div class="row">

              <div class="image col-sm-4"><a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" /> </a></div>

              <div class="col-sm-8">

                <div class="news-date">

                  <div class="date"><p class="entry-month"><?= date('m',$post['date_added']); ?></p><p class="entry-year"><?= date('Y',$post['date_added']); ?></p></div>

                </div>

                <div class="new-caption"> <?php echo $post['short_description']; ?> </div>

                <div class="view-more"><a href="<?php echo $post['href']; ?>"><?php echo $text_see_more; ?></a></div>

              </div>

            </div>

          </div>

          <?php } ?>

          <?php } else if ($format == 'gallery') { ?>

          <?php foreach ($posts as $post) { ?>

          <div class="news-layout news-gallery col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <div class="bg-news-thread">

              <div class="image"><a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" />

              </a></div>

              <div class="caption">

                <h2><a href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>

              </div>

            </div>

          </div>

          <?php } ?>

          <?php } else { ?>

          <?php foreach ($posts as $post) { ?>

          <div class="news-layout news-standard col-lg-4 col-md-4 col-sm-4 col-xs-12">

            <div class="bg-news-thread">

              <div class="image"><a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" /></a>

                <div class="news-date">

                  <div class="date"><p class="entry-month"><?= date('m',$post['date_added']); ?></p><p class="entry-year"><?= date('Y',$post['date_added']); ?></p></div>

                </div>

              </div>

              <div class="caption">

                <h2><a href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>

                <h4><?php echo $post['short_description']; ?></h4>

                <div class="view-more"><a href="<?php echo $post['href']; ?>"><?php echo $text_see_more; ?></a></div>

              </div>

            </div>

          </div>

          <?php } ?>

          <?php } ?>

        </div>

      </div>

      <div class="col-sm-12 text-left" style="text-align: center;"><?php echo $pagination; ?></div>

      <div class="row"> </div>

      <?php echo $content_bottom; ?></div>

      <?php echo $column_right; ?></div>

    </div> -->
    <style>
      .news-content .row{
        display: flex;
        flex-wrap: wrap;
      }
    </style>

    <?php echo $footer; ?> 