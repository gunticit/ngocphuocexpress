<div class="news-latest-module">
  <div class="box-title">
    <h3><?php echo $heading_title; ?></h3>
  </div>
  <div class="panel-body">
    <div class="row">
      <?php foreach ($posts as $post) { ?>
      <div class="news-layout news-standard col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="image"> <a href="<?php echo $post['href']; ?>"> <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" class="img-responsive" /> </a>
          <div class="news-date"><?php echo $post['date_added']; ?></div>
        </div>
        <div class="caption">
          <h2><a href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>
          <h4><?php echo $post['short_description']; ?></h4>
          <div class="view-more"><a href="<?php echo $post['href']; ?>"><?php echo $text_see_more; ?></a></div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
