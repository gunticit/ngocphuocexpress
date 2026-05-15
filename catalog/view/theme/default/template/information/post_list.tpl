<?php echo $header; ?>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="information-title"><span><?php echo $heading_title; ?></span></div>
      <div class="row">
        <?php foreach ($posts as $post) { ?>
         <div class="news-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">
          
            <div class="image"><a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" />
            <div class="news-date"><?php echo $post['date_added']; ?></div>
            </a></div>
            <div class="caption">
              <h4><a class="box-title-1" href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?><?php echo $post['post_id']; ?></a></h4>
              <h3 class="box-title-1"><?php echo $post['short_description']; ?></h3>
              <h2><a class="box-title-1"href="<?php echo $post['href']; ?>"><?php echo $text_see_more; ?></a></h2>
            </div>
          </div>
       
        <?php } ?>
        
       
        
      </div>
      <div class="col-sm-6 text-left" style="text-align: center;"><?php echo $pagination; ?></div>
      <div class="row"> </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 