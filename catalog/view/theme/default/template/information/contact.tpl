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
<div class="bg-contacts">
  <div class="container">
  <!-- <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul> -->
  <div class="row"><?php echo $column_left; ?>
  <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
  <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-12'; ?>
  <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
  <?php } ?>
  <div id="content" class="<?php echo $class; ?>">
    <div class="bg-contact">
      <?php echo $content_top; ?>
      <div class="row">

        <div class="col-sm-5">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <?php if ($image_h) { ?>
                  <div class="col-sm-12 logo-contact"><img src="<?php echo $image_h; ?>" alt="<?php echo $store; ?>" title="<?php echo $store; ?>" class="img-thumbnail" /></div>
                <?php } ?>
                <div class="col-sm-12">
                  <p><?php echo $name_contact; ?></p>
                  <address>
                    <?= $text_address; ?> <?php echo $address; ?>
                  </address>
                  <?php if ($geocode) { ?>
                    <a href="https://maps.google.com/maps?q=<?php echo urlencode($geocode); ?>&hl=<?php echo $geocode_hl; ?>&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a>
                  <?php } ?>
                </div>
                <div class="col-sm-12"><?php echo $text_telephone; ?>
                  <?php echo $telephone; ?>
                </div>
                <div class="col-sm-12">
                  Email
                  <?php echo $emails; ?><br />
                  <br />
                </div>
                  <!-- <div class="col-sm-12">
                    <?php foreach($languages as $lansg){ ?> 
                    <?php if($lansg['code'] == $lang){ ?> 
                    <?php if ($open) { ?>
                    <strong><?php echo $text_open; ?></strong><br />
                    <?php echo $open[$lansg['language_id']]; ?><br />
                    <br />
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($comment) { ?>
                    <strong><?php echo $text_comment; ?></strong><br />
                    <?php echo $comment; ?>
                    <?php } ?>
                  </div> -->
                </div>
              </div>
            </div>
            <?php if ($locations) { ?>
              <h3><?php echo $text_store; ?></h3>
              <div class="panel-group" id="accordion">
                <?php foreach ($locations as $location) { ?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><a href="#collapse-location<?php echo $location['location_id']; ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $location['name']; ?> <i class="fa fa-caret-down"></i></a></h4>
                    </div>
                    <div class="panel-collapse collapse" id="collapse-location<?php echo $location['location_id']; ?>">
                      <div class="panel-body">
                        <div class="row">
                          <?php if ($location['image']) { ?>
                            <div class="col-sm-12"><img src="<?php echo $location['image']; ?>" alt="<?php echo $location['name']; ?>" title="<?php echo $location['name']; ?>" class="img-thumbnail" /></div>
                          <?php } ?>
                          <div class="col-sm-12"><strong><?php echo $location['name']; ?></strong><br />
                            <address>
                              <?php echo $location['address']; ?>
                            </address>
                            <?php if ($location['geocode']) { ?>
                              <a href="https://maps.google.com/maps?q=<?php echo urlencode($location['geocode']); ?>&hl=<?php echo $geocode_hl; ?>&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a>
                            <?php } ?>
                          </div>
                          <div class="col-sm-12"> <strong><?php echo $text_telephone; ?></strong><br>
                            <?php echo $location['telephone']; ?><br />
                            <br />
                            <?php if ($location['fax']) { ?>
                              <strong><?php echo $text_fax; ?></strong><br>
                              <?php echo $location['fax']; ?>
                            <?php } ?>
                          </div>
                          <div class="col-sm-12"> <strong>Email</strong><br>
                            <?php echo $location['email']; ?><br />
                            <br />
                          </div>

                          <div class="col-sm-12">
                            <?php if ($location['open']) { ?>
                              <strong><?php echo $text_open; ?></strong><br />
                              <?php echo $location['open']; ?><br />
                              <br />
                            <?php } ?>
                            <?php if ($location['comment']) { ?>
                              <strong><?php echo $text_comment; ?></strong><br />
                              <?php echo $location['comment']; ?>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>
          </div>
          <div class="col-sm-7">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <fieldset>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <input type="text" name="name" placeholder="<?php echo $entry_name; ?>" value="<?php echo $name; ?>" id="input-name" class="form-control" />
                    <?php if ($error_name) { ?>
                      <div class="text-danger"><?php echo $error_name; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <input type="text" name="email" placeholder="<?php echo $entry_email; ?>" value="<?php echo $email; ?>" id="input-email" class="form-control" />
                    <?php if ($error_email) { ?>
                      <div class="text-danger"><?php echo $error_email; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <textarea name="enquiry" rows="10" placeholder="<?php echo $entry_enquiry; ?>" id="input-enquiry" class="form-control"><?php echo $enquiry; ?></textarea>
                    <?php if ($error_enquiry) { ?>
                      <div class="text-danger"><?php echo $error_enquiry; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <?php echo $captcha; ?>
              </fieldset>
              <div class="buttons">
                <div class="pull-right">
                  <input class="btn btn-primary" type="submit" value="<?php echo $button_submit; ?>" />
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php echo $content_bottom; ?>
      </div>
    </div>
    <?php echo $column_right; ?>
  </div>
<!-- </div>
<div class="maps">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1003454.1751597244!2d106.13469934178981!3d10.754289345533627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529292e8d3dd1%3A0xf15f5aad773c112b!2zSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1552631727902" style='width: 100%;' height="550" frameborder="0" style="border:0" allowfullscreen></iframe>
</div> -->
</div>
<?php echo $footer; ?>
