<div class="news-latest-module">
  <img src="image/index-1.png" width="100%" class="img-border" alt="">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="box-title">
          <h3>TIN TỨC</h3>
        </div>
        <div class="news_carousel row">
          <div class="col-sm-4">
            <?php if (count($notify_posts) > 0) { ?>
              <?php foreach ($notify_posts as $key => $post) { ?>
                <div class="border-box-new">
                  <?php if ($key == 0) { ?>
                    <div class="image">
                      <a href="<?php echo $post['href']; ?>">
                        <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>"
                          title="<?php echo $post['title']; ?>" class="img-responsive" />
                      </a>
                    </div>
                  <?php } ?>
                  <div class="caption">
                    <h2 class="<?= $key == 0 ? 'weight-bold' : ''; ?>"><a
                        href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
          <div class="col-sm-4">
            <?php if (count($inter_posts) > 0) { ?>
              <?php foreach ($inter_posts as $key => $post) { ?>
                <div class="border-box-new">
                  <?php if ($key == 0) { ?>
                    <div class="image">
                      <a href="<?php echo $post['href']; ?>">
                        <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>"
                          title="<?php echo $post['title']; ?>" class="img-responsive" />
                      </a>
                    </div>
                  <?php } ?>
                  <div class="caption">
                    <h2 class="<?= $key == 0 ? 'weight-bold' : ''; ?>"><a
                        href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
          <div class="col-sm-4">
            <?php if (count($logistics_posts) > 0) { ?>
              <?php foreach ($logistics_posts as $key => $post) { ?>
                <div class="border-box-new">
                  <?php if ($key == 0) { ?>
                    <div class="image">
                      <a href="<?php echo $post['href']; ?>">
                        <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>"
                          title="<?php echo $post['title']; ?>" class="img-responsive" />
                      </a>
                    </div>
                  <?php } ?>
                  <div class="caption">
                    <h2 class="<?= $key == 0 ? 'weight-bold' : ''; ?>"><a
                        href="<?php echo $post['href']; ?>"><?php echo $post['title']; ?></a></h2>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>