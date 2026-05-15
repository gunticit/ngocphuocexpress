<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-settingpost" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body" >
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-settingpost" class="form-horizontal">
          <div class="tab-content">
            <div class="tab-pane active" id="tab-option">
              <fieldset>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="item_module_post"><span data-toggle="tooltip" title="<?php echo $explain_item_module_post; ?>"><?php echo $text_item_module_post; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="item_module_post" value="<?php echo $item_module_post; ?>" placeholder="<?php echo $item_module_post; ?>" id="item_module_post" class="form-control" />
                    <?php if ($error_item_module_post) { ?>
                    <div class="text-danger"><?php echo $error_item_module_post; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="item_perpage_admin"><span data-toggle="tooltip" title="<?php echo $explain_item_perpage_admin; ?>"><?php echo $text_item_perpage_admin; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="item_perpage_admin" value="<?php echo $item_perpage_admin; ?>" placeholder="<?php echo $item_perpage_admin; ?>" id="item_perpage_admin" class="form-control" />
                    <?php if ($error_item_perpage_admin) { ?>
                    <div class="text-danger"><?php echo $item_perpage_admin; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="description_limit"><span data-toggle="tooltip" title="<?php echo $explain_description_limit; ?>"><?php echo $text_description_limit; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="description_limit" value="<?php echo $description_limit; ?>" placeholder="<?php echo $description_limit; ?>" id="description_limit" class="form-control" />
                    <?php if ($error_description_limit) { ?>
                    <div class="text-danger"><?php echo $error_description_limit; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-image-thumb-width"><?php echo $text_image_thumb; ?></label>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-sm-6">
                        <input type="text" name="image_thumb_width" value="<?php echo $image_thumb_width; ?>" placeholder="<?php echo $image_thumb_width; ?>" id="image_thum-width" class="form-control" />
                      </div>
                      <div class="col-sm-6">
                        <input type="text" name="image_thumb_height" value="<?php echo $image_thumb_height; ?>" placeholder="<?php echo $image_thumb_height; ?>" class="form-control" />
                      </div>
                    </div>
                    <?php if ($error_image_thumb) { ?>
                    <div class="text-danger"><?php echo $error_image_thumb; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-image-thread-width"><?php echo $text_image_thread; ?></label>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-sm-6">
                        <input type="text" name="image_thread_width" value="<?php echo $image_thread_width; ?>" placeholder="<?php echo $image_thread_width; ?>" id="image_thum-width" class="form-control" />
                      </div>
                      <div class="col-sm-6">
                        <input type="text" name="image_thread_height" value="<?php echo $image_thread_height; ?>" placeholder="<?php echo $image_thread_height; ?>" class="form-control" />
                      </div>
                    </div>
                    <?php if ($error_image_thread) { ?>
                    <div class="text-danger"><?php echo $error_image_thread; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-image-banner-width"><?php echo $text_image_banner; ?></label>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-sm-6">
                        <input type="text" name="image_banner_width" value="<?php echo $image_banner_width; ?>" placeholder="<?php echo $image_banner_width; ?>" id="image_thum-width" class="form-control" />
                      </div>
                      <div class="col-sm-6">
                        <input type="text" name="image_banner_height" value="<?php echo $image_banner_height; ?>" placeholder="<?php echo $image_banner_height; ?>" class="form-control" />
                      </div>
                    </div>
                    <?php if ($error_image_banner) { ?>
                    <div class="text-danger"><?php echo $error_image_banner; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-image-gallery-width"><?php echo $text_image_gallery; ?></label>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-sm-6">
                        <input type="text" name="image_gallery_width" value="<?php echo $image_gallery_width; ?>" placeholder="<?php echo $image_gallery_width; ?>" id="image_thum-width" class="form-control" />
                      </div>
                      <div class="col-sm-6">
                        <input type="text" name="image_gallery_height" value="<?php echo $image_gallery_height; ?>" placeholder="<?php echo $image_gallery_height; ?>" class="form-control" />
                      </div>
                    </div>
                    <?php if ($error_image_gallery) { ?>
                    <div class="text-danger"><?php echo $error_image_gallery; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-image-popup-width"><?php echo $text_image_popup; ?></label>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-sm-6">
                        <input type="text" name="image_popup_width" value="<?php echo $image_popup_width; ?>" placeholder="<?php echo $image_popup_width; ?>" id="image_thum-width" class="form-control" />
                      </div>
                      <div class="col-sm-6">
                        <input type="text" name="image_popup_height" value="<?php echo $image_popup_height; ?>" placeholder="<?php echo $image_popup_height; ?>" class="form-control" />
                      </div>
                    </div>
                    <?php if ($error_image_popup) { ?>
                    <div class="text-danger"><?php echo $error_image_popup; ?></div>
                    <?php } ?>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend><?php echo $text_review; ?></legend>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $explain_allow_reviews; ?>"><?php echo $explain_allow_reviews; ?></span></label>
                  <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($allow_reviews) { ?>
                      <input type="radio" name="allow_reviews" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="allow_reviews" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$allow_reviews) { ?>
                      <input type="radio" name="allow_reviews" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="allow_reviews" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $explain_allow_guest_reviews; ?>"><?php echo $text_allow_guest_reviews; ?></span></label>
                  <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($allow_guest_reviews) { ?>
                      <input type="radio" name="allow_guest_reviews" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="allow_guest_reviews" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$allow_guest_reviews) { ?>
                      <input type="radio" name="allow_guest_reviews" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="allow_guest_reviews" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $explain_view_instantly; ?>"><?php echo $text_view_instantly; ?></span></label>
                  <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($view_instantly) { ?>
                      <input type="radio" name="view_instantly" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="view_instantly" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$view_instantly) { ?>
                      <input type="radio" name="view_instantly" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="view_instantly" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend><?php echo $text_post_relate; ?></legend>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="item_view_relate"><span data-toggle="tooltip" title="<?php echo $explain_item_view_relate; ?>"><?php echo $text_item_view_relate; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="item_view_relate" value="<?php echo $item_view_relate; ?>" placeholder="<?php echo $item_view_relate; ?>" id="item_view_relate" class="form-control" />
                    <?php if ($error_item_view_relate) { ?>
                    <div class="text-danger"><?php echo $error_item_view_relate; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $explain_view_relate; ?>"><?php echo $text_view_relate; ?></span></label>
                  <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($view_relate) { ?>
                      <input type="radio" name="view_relate" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="view_relate" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$view_relate) { ?>
                      <input type="radio" name="view_relate" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="view_relate" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend><?php echo $text_thread; ?></legend>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="item_perpage_thread"><span data-toggle="tooltip" title="<?php echo $explain_item_perpage_thread; ?>"><?php echo $text_item_perpage_thread; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="item_perpage_thread" value="<?php echo $item_perpage_thread; ?>" placeholder="<?php echo $item_perpage_thread; ?>" id="item_perpage_thread" class="form-control" />
                    <?php if ($error_item_perpage_thread) { ?>
                    <div class="text-danger"><?php echo $error_item_perpage_thread; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $explain_thread_post_count; ?>"><?php echo $text_thread_post_count; ?></span></label>
                  <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($thread_post_count) { ?>
                      <input type="radio" name="thread_post_count" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="thread_post_count" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$thread_post_count) { ?>
                      <input type="radio" name="thread_post_count" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="thread_post_count" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend><?php echo $text_explain_post; ?></legend>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="item_perpage_thread"><span data-toggle="tooltip" title="<?php echo $text_explain_post; ?>"><?php echo $text_explain_post; ?></span></label>
                  <div class="col-sm-10"> <?php echo $explain_post; ?> </div>
                </div>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 