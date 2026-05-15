<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-slideshow" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-slideshow" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-general"><?php echo $tab_general; ?></a></li>
            <li><a data-toggle="tab" href="#tab-banner"><?php echo $tab_banner; ?></a></li>
          </ul>
          <div class="tab-content">
            <div id="tab-general" class="tab-pane fade in active">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                  <?php if ($error_name) { ?>
                  <div class="text-danger"><?php echo $error_name; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
                <div class="col-sm-2">
                  <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control"/>
                </div>
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                      <?php if ($error_width) { ?>
                      <div class="text-danger"><?php echo $error_width; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
                <div class="col-sm-2">
                  <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
                  <?php if ($error_height) { ?>
                  <div class="text-danger"><?php echo $error_height; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-mode"><?php echo $entry_mode; ?></label>
                <div class="col-sm-2">
                  <select name="mode" id="mode" class="form-control">
                    <option value="fixed" <?php echo ($mode == 'fixed') ? 'selected' : ''; ?>><?php echo $text_fixed; ?></option>
                    <option value="cover" <?php echo ($mode == 'cover') ? 'selected' : ''; ?>><?php echo $text_cover; ?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-effect"><?php echo $entry_effect; ?></label>
                <div class="col-sm-2">
                  <select name="effect" id="input-effect" class="form-control">
                    <option value="random" <?php echo ($effect == 'random') ? 'selected' : ''; ?>>random</option>
                    <option value="simpleFade" <?php echo ($effect == 'simpleFade') ? 'selected' : ''; ?>>simpleFade</option>
                    <option value="curtainTopLeft" <?php echo ($effect == 'curtainTopLeft') ? 'selected' : ''; ?>>curtainTopLeft</option>
                    <option value="curtainTopRight" <?php echo ($effect == 'curtainTopRight') ? 'selected' : ''; ?>>curtainTopRight</option>
                    <option value="curtainBottomLeft" <?php echo ($effect == 'curtainBottomLeft') ? 'selected' : ''; ?>>curtainBottomLeft</option>
                    <option value="curtainBottomRight" <?php echo ($effect == 'curtainBottomRight') ? 'selected' : ''; ?>>curtainBottomRight</option>
                    <option value="curtainSliceLeft" <?php echo ($effect == 'curtainSliceLeft') ? 'selected' : ''; ?>>curtainSliceLeft</option>
                    <option value="curtainSliceRight" <?php echo ($effect == 'curtainSliceRight') ? 'selected' : ''; ?>>curtainSliceRight</option>
                    <option value="blindCurtainTopLeft" <?php echo ($effect == 'blindCurtainTopLeft') ? 'selected' : ''; ?>>blindCurtainTopLeft</option>
                    <option value="blindCurtainTopRight" <?php echo ($effect == 'blindCurtainTopRight') ? 'selected' : ''; ?>>blindCurtainTopRight</option>
                    <option value="blindCurtainBottomLeft" <?php echo ($effect == 'blindCurtainBottomLeft') ? 'selected' : ''; ?>>blindCurtainBottomLeft</option>
                    <option value="blindCurtainBottomRight" <?php echo ($effect == 'blindCurtainBottomRight') ? 'selected' : ''; ?>>blindCurtainBottomRight</option>
                    <option value="blindCurtainSliceBottom" <?php echo ($effect == 'blindCurtainSliceBottom') ? 'selected' : ''; ?>>blindCurtainSliceBottom</option>
                    <option value="blindCurtainSliceTop" <?php echo ($effect == 'blindCurtainSliceTop') ? 'selected' : ''; ?>>blindCurtainSliceTop</option>
                    <option value="stampede" <?php echo ($effect == 'stampede') ? 'selected' : ''; ?>>stampede</option>
                    <option value="mosaic" <?php echo ($effect == 'mosaic') ? 'selected' : ''; ?>>mosaic</option>
                    <option value="mosaicReverse" <?php echo ($effect == 'mosaicReverse') ? 'selected' : ''; ?>>mosaicReverse</option>
                    <option value="mosaicRandom" <?php echo ($effect == 'mosaicRandom') ? 'selected' : ''; ?>>mosaicRandom</option>
                    <option value="mosaicSpiral" <?php echo ($effect == 'mosaicSpiral') ? 'selected' : ''; ?>>mosaicSpiral</option>
                    <option value="mosaicSpiralReverse" <?php echo ($effect == 'mosaicSpiralReverse') ? 'selected' : ''; ?>>mosaicSpiralReverse</option>
                    <option value="topLeftBottomRight" <?php echo ($effect == 'topLeftBottomRight') ? 'selected' : ''; ?>>topLeftBottomRight</option>
                    <option value="bottomRightTopLeft" <?php echo ($effect == 'bottomRightTopLeft') ? 'selected' : ''; ?>>bottomRightTopLeft</option>
                    <option value="bottomLeftTopRight" <?php echo ($effect == 'bottomLeftTopRight') ? 'selected' : ''; ?>>bottomLeftTopRight</option>
                    <option value="bottomLeftTopRight" <?php echo ($effect == 'bottomLeftTopRight') ? 'selected' : ''; ?>>bottomLeftTopRight</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-thumbnail"><?php echo $entry_thumbnail; ?></label>
                <div class="col-sm-2">
                  <select name="thumbnail" id="input-thumbnail" class="form-control">
                    <option value="false" <?php echo ($thumbnail == 'false') ? 'selected' : ''; ?>>false</option>
                    <option value="true" <?php echo ($thumbnail == 'true') ? 'selected' : ''; ?>>true</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-loader"><?php echo $entry_loader; ?></label>
                <div class="col-sm-2">
                  <select name="loader" id="input-loader" class="form-control">
                    <option value="pie" <?php echo ($loader == 'pie') ? 'selected' : ''; ?>>pie</option>
                    <option value="bar" <?php echo ($loader == 'bar') ? 'selected' : ''; ?>>bar</option>
                    <option value="none" <?php echo ($loader == 'none') ? 'selected' : ''; ?>>none</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-bar-position"><?php echo $entry_bar_position; ?></label>
                <div class="col-sm-2">
                  <select name="bar_position" id="input-bar_position" class="form-control">
                    <option value="bottom" <?php echo ($bar_position == 'bottom') ? 'selected' : ''; ?>>bottom</option>
                    <option value="top" <?php echo ($bar_position == 'top') ? 'selected' : ''; ?>>top</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-hover"><?php echo $entry_hover; ?></label>
                <div class="col-sm-2">
                  <select name="hover" id="input-hover" class="form-control">
                    <option value="true" <?php echo ($hover == 'true') ? 'selected' : ''; ?>>true</option>
                    <option value="false" <?php echo ($hover == 'false') ? 'selected' : ''; ?>>false</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-navigation-hover"><?php echo $entry_navigation_hover; ?></label>
                <div class="col-sm-2">
                  <select name="navigation_hover" id="input-navigation_hover" class="form-control">
                    <option value="false" <?php echo ($navigation_hover == 'false') ? 'selected' : ''; ?>>false</option>
                    <option value="true" <?php echo ($navigation_hover == 'true') ? 'selected' : ''; ?>>true</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-pagination"><?php echo $entry_pagination; ?></label>
                <div class="col-sm-2">
                  <select name="pagination" id="input-pagination" class="form-control">
                    <option value="true" <?php echo ($pagination == 'true') ? 'selected' : ''; ?>>true</option>
                    <option value="false" <?php echo ($pagination == 'false') ? 'selected' : ''; ?>>false</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-time"><?php echo $entry_time; ?></label>
                <div class="col-sm-2">
                  <select name="time" id="input-time" class="form-control">
                    <option value="1" <?php echo ($time == '1') ? 'selected' : ''; ?>>1</option>
                    <option value="2" <?php echo ($time == '2') ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?php echo ($time == '3') ? 'selected' : ''; ?>>3</option>
                    <option value="5" <?php echo ($time == '5') ? 'selected' : ''; ?>>5</option>
                    <option value="7" <?php echo ($time == '7') ? 'selected' : ''; ?>>7</option>
                    <option value="10" <?php echo ($time == '10') ? 'selected' : ''; ?>>10</option>
                    <option value="15" <?php echo ($time == '10') ? 'selected' : ''; ?>>15</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-skin"><?php echo $entry_skin; ?></label>
                <div class="col-sm-2">
                  <select name="skin" id="input-skin" class="form-control">
                    <option value="camera_black_skin" <?php echo ($skin == 'camera_black_skin') ? 'selected' : ''; ?>>camera_black_skin</option>
                    <option value="camera_amber_skin" <?php echo ($skin == 'camera_amber_skin') ? 'selected' : ''; ?>>camera_amber_skin</option>
                    <option value="camera_ash_skin" <?php echo ($skin == 'camera_ash_skin') ? 'selected' : ''; ?>>camera_ash_skin</option>
                    <option value="camera_azure_skin" <?php echo ($skin == 'camera_azure_skin') ? 'selected' : ''; ?>>camera_azure_skin</option>
                    <option value="camera_beige_skin" <?php echo ($skin == 'camera_beige_skin') ? 'selected' : ''; ?>>camera_beige_skin</option>
                    <option value="camera_blue_skin" <?php echo ($skin == 'camera_blue_skin') ? 'selected' : ''; ?>>camera_blue_skin</option>
                    <option value="camera_brown_skin" <?php echo ($skin == 'camera_brown_skin') ? 'selected' : ''; ?>>camera_brown_skin</option>
                    <option value="camera_burgundy_skin" <?php echo ($skin == 'camera_burgundy_skin') ? 'selected' : ''; ?>>camera_burgundy_skin</option>
                    <option value="camera_charcoal_skin" <?php echo ($skin == 'camera_charcoal_skin') ? 'selected' : ''; ?>>camera_charcoal_skin</option>
                    <option value="camera_chocolate_skin" <?php echo ($skin == 'camera_chocolate_skin') ? 'selected' : ''; ?>>camera_chocolate_skin</option>
                    <option value="camera_coffee_skin" <?php echo ($skin == 'camera_coffee_skin') ? 'selected' : ''; ?>>camera_coffee_skin</option>
                    <option value="camera_cyan_skin" <?php echo ($skin == 'camera_cyan_skin') ? 'selected' : ''; ?>>camera_cyan_skin</option>
                    <option value="camera_fuchsia_skin" <?php echo ($skin == 'camera_fuchsia_skin') ? 'selected' : ''; ?>>camera_fuchsia_skin</option>
                    <option value="amera_gold_skin" <?php echo ($skin == 'amera_gold_skin') ? 'selected' : ''; ?>>amera_gold_skin</option>
                    <option value="camera_green_skin" <?php echo ($skin == 'camera_green_skin') ? 'selected' : ''; ?>>camera_green_skin</option>
                    <option value="camera_grey_skin" <?php echo ($skin == 'camera_grey_skin') ? 'selected' : ''; ?>>camera_grey_skin</option>
                    <option value="camera_indigo_skin" <?php echo ($skin == 'camera_indigo_skin') ? 'selected' : ''; ?>>camera_indigo_skin</option>
                    <option value="camera_khaki_skin" <?php echo ($skin == 'camera_khaki_skin') ? 'selected' : ''; ?>>camera_khaki_skin</option>
                    <option value="camera_lime_skin" <?php echo ($skin == 'camera_lime_skin') ? 'selected' : ''; ?>>camera_lime_skin</option>
                    <option value="camera_magenta_skin" <?php echo ($skin == 'camera_magenta_skin') ? 'selected' : ''; ?>>camera_magenta_skin</option>
                    <option value="camera_maroon_skin" <?php echo ($skin == 'camera_maroon_skin') ? 'selected' : ''; ?>>camera_maroon_skin</option>
                    <option value="camera_orange_skin" <?php echo ($skin == 'camera_orange_skin') ? 'selected' : ''; ?>>camera_orange_skin</option>
                    <option value="camera_olive_skin" <?php echo ($skin == 'camera_olive_skin') ? 'selected' : ''; ?>>camera_olive_skin</option>
                    <option value="camera_pink_skin" <?php echo ($skin == 'camera_pink_skin') ? 'selected' : ''; ?>>camera_pink_skin</option>
                    <option value="camera_pistachio_skin" <?php echo ($skin == 'camera_pistachio_skin') ? 'selected' : ''; ?>>camera_pistachio_skin</option>
                    <option value="camera_red_skin" <?php echo ($skin == 'camera_red_skin') ? 'selected' : ''; ?>>camera_red_skin</option>
                    <option value="camera_tangerine_skin" <?php echo ($skin == 'camera_tangerine_skin') ? 'selected' : ''; ?>>camera_tangerine_skin</option>
                    <option value="camera_turquoise_skin" <?php echo ($skin == 'camera_turquoise_skin') ? 'selected' : ''; ?>>camera_turquoise_skin</option>
                    <option value="camera_violet_skin" <?php echo ($skin == 'camera_violet_skin') ? 'selected' : ''; ?>>camera_violet_skin</option>
                    <option value="camera_white_skin" <?php echo ($skin == 'camera_white_skin') ? 'selected' : ''; ?>>camera_white_skin</option>
                    <option value="camera_yellow_skin" <?php echo ($skin == 'camera_yellow_skin') ? 'selected' : ''; ?>>camera_yellow_skin</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-2">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div id="tab-banner" class="tab-pane fade">
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="col-xs-3">
                    <ul id="slideshow-builder-tab" class="nav nav-tabs tabs-left">
                      <?php $banner_row = 0; ?>
                      <?php foreach($banners as $banner) { ?>
                      <li> <a data-toggle="tab" href="#banner-row-<?php echo $banner_row; ?>">
                        <button class="btn btn-danger" onclick="$(this).parent().remove(); $('#banner-row-<?php echo $banner_row; ?>').remove();" style="padding: 2px 5px;" data-toggle="tooltip" data-original-title="<?php echo $button_remove; ?>"><i class="fa fa-minus-circle"></i></button>
                        <?php echo $entry_banner.' '.$banner_row; ?></a> </li>
                      <?php $banner_row++; ?>
                      <?php } ?>
                    </ul>
                    <a onClick="addSlideshow();" data-toggle="tooltip" class="btn btn-success" style="padding: 2px 5px; margin-left: 15px;" data-original-title="<?php echo $button_add; ?>"><i class="fa fa-plus-circle"></i></a> </div>
                  <div class="col-sm-9">
                    <div id="slideshow-builder" class="tab-content">
                      <?php $banner_row = 0; ?>
                      <?php foreach($banners as $banner) { ?>
                      <div id="banner-row-<?php echo $banner_row; ?>" class="tab-pane">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
                            <div class="col-sm-10"> <a href="" id="thumb-image-<?php echo $banner_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $banner['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                              <input type="hidden" name="banners[<?php echo $banner_row; ?>][image]" value="<?php echo $banner['image']; ?>" placeholder="<?php echo $entry_image; ?>" class="form-control" id="input-image-<?php echo $banner_row; ?>"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-link"><?php echo $entry_link; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="banners[<?php echo $banner_row; ?>][link]" value="<?php echo $banner['link']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" />
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-video"><?php echo $entry_video; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="banners[<?php echo $banner_row; ?>][video]" value="<?php echo $banner['video']; ?>" placeholder="<?php echo $entry_video; ?>" class="form-control" />
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-html-effect"><?php echo $entry_html_effect; ?></label>
                            <div class="col-sm-2">
                              <select name="banners[<?php echo $banner_row; ?>][html_effect]" id="input-caption-effect" class="form-control">
                                <option value="" <?php echo ($banner['html_effect'] == '') ? 'selected' : ''; ?>>none</option>
                                <option value="moveFromLeft" <?php echo ($banner['html_effect'] == 'moveFromLeft') ? 'selected' : ''; ?>>moveFromLeft</option>
                                <option value="moveFomRight" <?php echo ($banner['html_effect'] == 'moveFomRight') ? 'selected' : ''; ?>>moveFomRight</option>
                                <option value="moveFromTop" <?php echo ($banner['html_effect'] == 'moveFromTop') ? 'selected' : ''; ?>>moveFromTop</option>
                                <option value="moveFromBottom" <?php echo ($banner['html_effect'] == 'moveFromBottom') ? 'selected' : ''; ?>>moveFromBottom</option>
                                <option value="fadeIn" <?php echo ($banner['html_effect'] == 'fadeIn') ? 'selected' : ''; ?>>fadeIn</option>
                                <option value="fadeFromLeft" <?php echo ($banner['html_effect'] == 'fadeFromLeft') ? 'selected' : ''; ?>>fadeFromLeft</option>
                                <option value="fadeFromRight" <?php echo ($banner['html_effect'] == 'fadeFromRight') ? 'selected' : ''; ?>>fadeFromRight</option>
                                <option value="fadeFromTop" <?php echo ($banner['html_effect'] == 'fadeFromTop') ? 'selected' : ''; ?>>fadeFromTop</option>
                                <option value="fadeFromBottom" <?php echo ($banner['html_effect'] == 'fadeFromBottom') ? 'selected' : ''; ?>>fadeFromBottom</option>
                              </select>
                            </div>
                          </div>
                          <ul class="nav nav-tabs language">
                            <?php foreach ($languages as $language) { ?>
                            <?php $language_id = $language['language_id']; ?>
                            <li><a href="#language-<?php echo $banner_row; ?>-<?php echo $language_id; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php } ?>
                          </ul>
                          <div class="tab-content">
                            <?php foreach ($languages as $language) { ?>
                            <?php $language_id = $language['language_id']; ?>
                            <div class="tab-pane" id="language-<?php echo $banner_row; ?>-<?php echo $language_id; ?>">
                              <textarea name="banners[<?php echo $banner_row; ?>][html][<?php echo $language_id; ?>]" class="form-control" id="input-banner-html-<?php echo $banner_row; ?>"><?php echo $banner['html'][$language_id]; ?></textarea>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <?php $banner_row++; ?>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
var banner_row = <?php echo $banner_row; ?>;

function addSlideshow(){
	var html = '';
	
	html += '<div id="banner-row-'+banner_row+'" class="tab-pane">';
	  html += '<div class="col-sm-12">';
		html += '<div class="form-group">';
		  html += '<label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>';
		  html += '<div class="col-sm-10">';
			html += '<a href="" id="thumb-image-'+banner_row+'" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>';
			html += '<input type="hidden" name="banners['+banner_row+'][image]" value="" placeholder="<?php echo $entry_image; ?>" class="form-control" id="input-image-'+banner_row+'"/>';
		  html += '</div>';
		html += '</div>';
		
		html += '<div class="form-group">';
		  html += '<label class="col-sm-2 control-label" for="input-link"><?php echo $entry_link; ?></label>';
		  html += '<div class="col-sm-10">';
			html += '<input type="text" name="banners['+banner_row+'][link]" value="" placeholder="<?php echo $entry_link; ?>" class="form-control" />';
		  html += '</div>';
		html += '</div>';
		
		html += '<div class="form-group">';
		  html += '<label class="col-sm-2 control-label" for="input-video"><?php echo $entry_video; ?></label>';
		  html += '<div class="col-sm-10">';
			html += '<input type="text" name="banners['+banner_row+'][video]" value="" placeholder="<?php echo $entry_video; ?>" class="form-control" />';
		  html += '</div>';
		html += '</div>';
		
		html += '<div class="form-group">';
		  html += '<label class="col-sm-2 control-label" for="input-caption-effect"><?php echo $entry_html_effect; ?></label>';
		  html += '<div class="col-sm-2">';
			html += '<select name="banners['+banner_row+'][html_effect]" id="input-caption-effect" class="form-control">'
			  html += '<option value="">none</option>';
			  html += '<option value="moveFromLeft">moveFromLeft</option>';
			  html += '<option value="moveFomRight">moveFomRight</option>';
			  html += '<option value="moveFromTop">moveFromTop</option>';
			  html += '<option value="moveFromBottom">moveFromBottom</option>';
			  html += '<option value="fadeIn">fadeIn</option>';
			  html += '<option value="fadeFromLeft">fadeFromLeft</option>';
			  html += '<option value="fadeFromRight">fadeFromRight</option>';
			  html += '<option value="fadeFromTop">fadeFromTop</option>';
			  html += '<option value="fadeFromBottom">fadeFromBottom</option>';
			html += '</select>';
		  html += '</div>';
		html += '</div>';
		
		html += '<ul class="nav nav-tabs language">';
		<?php foreach ($languages as $language) { ?>
		  html += '<li><a href="#language-'+banner_row+'-<?php echo $language["language_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language["image"]; ?>" title="<?php echo $language["name"]; ?>" /> <?php echo $language["name"]; ?></a></li>';
		<?php } ?>
		html += '</ul>';
		html += '<div class="tab-content">';
		  <?php foreach ($languages as $language) { ?>
		  html += '<div class="tab-pane" id="language-'+banner_row+'-<?php echo $language["language_id"]; ?>">';
		    html += '<textarea name="banners['+banner_row+'][html][<?php echo $language["language_id"]; ?>]" class="form-control" id="input-banner-html-'+banner_row+'"></textarea>';
		  html += '</div>';
		  <?php } ?>
		html += '</div>';
		
	  html += '</div>';
	html += '</div>';
	
	$('#slideshow-builder').append(html);
	$('#banner-row-' + banner_row + ' textarea').summernote({ height: 150 });
	$('.language li:first-child a').tab('show');
	
	html = '';
	html += '<li>';
		html += '<a data-toggle="tab" href="#banner-row-'+banner_row+'">';
		html += '<button class="btn btn-danger" onclick="$(this).parent().remove(); $(\'#banner-row-'+banner_row+'\').remove();" style="padding: 2px 5px;" data-toggle="tooltip" data-original-title="<?php echo $button_remove; ?>"><i class="fa fa-minus-circle"></i></button>';
		html += ' <?php echo $entry_banner; ?> '+banner_row;
		html += '</a>';
	html += '</li>';
	$('#slideshow-builder-tab').append(html);
	
	banner_row++;
}
</script> 
<script type="text/javascript">
$('.language li:first-child a').tab('show');
$('.tabs-left li:first-child a').tab('show');

$('#slideshow-builder textarea').summernote({
	height: 150
});
</script> 
<?php echo $footer; ?>