<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <?php if($recovery){ ?>
        <a href="<?php echo $recovery; ?>" data-toggle="tooltip" title="<?php echo $button_recovery; ?>" class="btn btn-default"><i class="fa fa-history"></i></a>
        <?php  } ?>
        <button data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary submit"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><?php echo $text_edit; ?></h3>
      </div>
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
        <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
      </ul>
      <form id="form-extra-info-builder" action="<?php echo $action; ?>" method="post" class="form-horizontal">
        <div class="tab-content">
          <div class="tab-pane active" id="tab-general">
            <ul class="nav nav-tabs" id="language">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <div class="col-sm-2"> </div>
              <div class="col-sm-10">
                <div class="switch-block">
                  <label class="switch">
                  <input type="checkbox" name="preview" checked>
                  <div class="slider round"></div>
                  </label>
                  <i class="fa fa-eye"></i> </div>
                <div id="preview-css">
                  <link href="../catalog/view/stylesheet/extra-info.css" rel="stylesheet" type="text/css" />
                  <link href="../catalog/view/stylesheet/hover.css" rel="stylesheet" type="text/css" />
                </div>
              </div>
              <?php $flag = false; ?>
              <?php $flag_button = false; ?>
              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane <?php if(!$flag) echo 'active'; $flag=true; ?>" id="language<?php echo $language['language_id']; ?>">
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="extra_info_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($extra_info_description[$language['language_id']]) ? $extra_info_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_name[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-content<?php echo $language['language_id']; ?>"><?php echo $entry_content; ?></label>
                  <div class="col-sm-10">
                    <?php if($flag_button) { ?>
                    <a class="btn btn btn-primary copy-first-language"><?php echo $button_copy_first_language; ?></a>
                    <?php } ?>
                    <textarea name="extra_info_description[<?php echo $language['language_id']; ?>][raw]" style="display: none;" class="raw"><?php echo isset($extra_info_description[$language['language_id']]) ? $extra_info_description[$language['language_id']]['raw'] : ''; ?></textarea>
                    <div class="extra-info-builder col-sm-12">
                      <div class="row children frame">
                        <div class="pre-div"></div>
                        <?php echo isset($extra_info_description[$language['language_id']]) ? preg_replace('/token=\w{32}/', 'token=' . $token, html_entity_decode($extra_info_description[$language['language_id']]['raw'])) : ''; ?> </div>
                    </div>
                    <textarea name="extra_info_description[<?php echo $language['language_id']; ?>][content]" style="display: none;" class="content"><?php echo isset($extra_info_description[$language['language_id']]) ? $extra_info_description[$language['language_id']]['content'] : ''; ?></textarea>
                  </div>
                </div>
              </div>
              <?php $flag_button = true; ?>
              <?php } ?>
            </div>
          </div>
          <div class="tab-pane" id="tab-data">
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-css-lib"><?php echo $entry_css_lib; ?></label>
              <div class="col-sm-10">
                <div id="css-lib" class="well well-sm" style="height: 350px; overflow: auto;">
                  <?php foreach ($stylesheets as $stylesheet) { ?>
                  <p>
                    <label>
                      <input type="checkbox" name="css_lib[]" value="<?php echo $stylesheet; ?>" <?php echo (in_array($stylesheet, $css_lib)) ? 'checked' : ''; ?> />
                      <?php echo $stylesheet; ?></label>
                  </p>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-script-lib"><?php echo $entry_script_lib; ?></label>
              <div class="col-sm-10">
                <div id="script-lib" class="well well-sm" style="height: 350px; overflow: auto;">
                  <?php foreach ($javascripts as $javascript) { ?>
                  <p>
                    <label>
                      <input type="checkbox" name="script_lib[]" value="<?php echo $javascript; ?>" <?php echo (in_array($javascript, $script_lib)) ? 'checked' : ''; ?> />
                      <?php echo $javascript; ?></label>
                  </p>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
              <div class="col-sm-10">
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
        </div>
      </form>
    </div>
  </div>
</div>
<div id="block-popup" class="stick-popup">
  <div class="popup-content">
    <div class="popup-button"><i class="fa fa-object-group fa-lg"></i></div>
    <div class="panel-default">
      <ul class="nav nav-tabs nav-vertical">
        <li><a data-toggle="tab" href="#extra-info-intro"><?php echo $text_intro; ?></a></li>
        <li><a data-toggle="tab" href="#extra-info-content"><?php echo $text_content; ?></a></li>
        <li><a data-toggle="tab" href="#extra-info-step-by-step"><?php echo $text_step_by_step; ?></a></li>
        <li><a data-toggle="tab" href="#extra-info-text-grid"><?php echo $text_text_grid; ?></a></li>
        <li><a data-toggle="tab" href="#extra-info-video"><?php echo $text_video; ?></a></li>
        <li><a data-toggle="tab" href="#extra-info-team"><?php echo $text_team; ?></a></li>
        <li><a data-toggle="tab" href="#extra-info-price-table"><?php echo $text_price_table; ?></a></li>
        <li><a data-toggle="tab" href="#extra-info-portfolio"><?php echo $text_portfolio; ?></a></li>
      </ul>
      <div class="tab-content">
        <div id="extra-info-intro" class="tab-pane fade block">
          <?php foreach($blocks as $block){ ?>
          <?php if($block['key'] == 'extra-intro') { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode">[block code=<?php echo $block['code']; ?> <?php echo ($block['css_lib']) ? 'css_lib=' . implode('|', $block['css_lib']) : ''; ?> <?php echo ($block['script_lib']) ? 'script_lib=' . implode('|', $block['script_lib']) : ''; ?> /]</div>
                <div class="tool">
                  <div class="element-block-edit"><a href="index.php?route=design/block/editByCode&token=<?php echo $token; ?>&code=<?php echo $block['code']; ?>" target="_blank" data-toggle="extra-info" data-id="" data-type="intro"><i class="fa fa-code"></i></a></div>
                </div>
                <div class="image"> <img src="<?php echo $block['thumb']; ?>" class="img-responsive" /> </div>
                <?php echo $block['code']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div id="extra-info-content" class="tab-pane fade block">
          <?php foreach($blocks as $block){ ?>
          <?php if($block['key'] == 'extra-content') { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode">[block code=<?php echo $block['code']; ?> <?php echo ($block['css_lib']) ? 'css_lib=' . implode('|', $block['css_lib']) : ''; ?> <?php echo ($block['script_lib']) ? 'script_lib=' . implode('|', $block['script_lib']) : ''; ?> /]</div>
                <div class="tool">
                  <div class="element-block-edit"><a href="index.php?route=design/block/editByCode&token=<?php echo $token; ?>&code=<?php echo $block['code']; ?>" target="_blank" data-toggle="extra-info" data-id="" data-type="content"><i class="fa fa-code"></i></a></div>
                </div>
                <div class="image"> <img src="<?php echo $block['thumb']; ?>" class="img-responsive" /> </div>
                <?php echo $block['code']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div id="extra-info-step-by-step" class="tab-pane fade block">
          <?php foreach($blocks as $block){ ?>
          <?php if($block['key'] == 'extra-step-by-step') { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode">[block code=<?php echo $block['code']; ?> <?php echo ($block['css_lib']) ? 'css_lib=' . implode('|', $block['css_lib']) : ''; ?> <?php echo ($block['script_lib']) ? 'script_lib=' . implode('|', $block['script_lib']) : ''; ?> /]</div>
                <div class="tool">
                  <div class="element-block-edit"><a href="index.php?route=design/block/editByCode&token=<?php echo $token; ?>&code=<?php echo $block['code']; ?>" target="_blank" data-toggle="extra-info" data-id="" data-type="step-by-step"><i class="fa fa-code"></i></a></div>
                </div>
                <div class="image"> <img src="<?php echo $block['thumb']; ?>" class="img-responsive" /> </div>
                <?php echo $block['code']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div id="extra-info-text-grid" class="tab-pane fade block">
          <?php foreach($blocks as $block){ ?>
          <?php if($block['key'] == 'extra-text-grid') { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode">[block code=<?php echo $block['code']; ?> <?php echo ($block['css_lib']) ? 'css_lib=' . implode('|', $block['css_lib']) : ''; ?> <?php echo ($block['script_lib']) ? 'script_lib=' . implode('|', $block['script_lib']) : ''; ?> /]</div>
                <div class="tool">
                  <div class="element-block-edit"><a href="index.php?route=design/block/editByCode&token=<?php echo $token; ?>&code=<?php echo $block['code']; ?>" target="_blank" data-toggle="extra-info" data-id="" data-type="text-grid"><i class="fa fa-code"></i></a></div>
                </div>
                <div class="image"> <img src="<?php echo $block['thumb']; ?>" class="img-responsive" /> </div>
                <?php echo $block['code']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div id="extra-info-video" class="tab-pane fade block">
          <?php foreach($blocks as $block){ ?>
          <?php if($block['key'] == 'extra-video') { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode">[block code=<?php echo $block['code']; ?> <?php echo ($block['css_lib']) ? 'css_lib=' . implode('|', $block['css_lib']) : ''; ?> <?php echo ($block['script_lib']) ? 'script_lib=' . implode('|', $block['script_lib']) : ''; ?> /]</div>
                <div class="tool">
                  <div class="element-block-edit"><a href="index.php?route=design/block/editByCode&token=<?php echo $token; ?>&code=<?php echo $block['code']; ?>" target="_blank" data-toggle="extra-info" data-id="" data-type="video"><i class="fa fa-code"></i></a></div>
                </div>
                <div class="image"> <img src="<?php echo $block['thumb']; ?>" class="img-responsive" /> </div>
                <?php echo $block['code']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div id="extra-info-team" class="tab-pane fade block">
          <?php foreach($blocks as $block){ ?>
          <?php if($block['key'] == 'extra-team') { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode">[block code=<?php echo $block['code']; ?> <?php echo ($block['css_lib']) ? 'css_lib=' . implode('|', $block['css_lib']) : ''; ?> <?php echo ($block['script_lib']) ? 'script_lib=' . implode('|', $block['script_lib']) : ''; ?> /]</div>
                <div class="tool">
                  <div class="element-block-edit"><a href="index.php?route=design/block/editByCode&token=<?php echo $token; ?>&code=<?php echo $block['code']; ?>" target="_blank" data-toggle="extra-info" data-id="" data-type="team"><i class="fa fa-code"></i></a></div>
                </div>
                <div class="image"> <img src="<?php echo $block['thumb']; ?>" class="img-responsive" /> </div>
                <?php echo $block['code']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div id="extra-price-table" class="tab-pane fade block">
          <?php foreach($blocks as $block){ ?>
          <?php if($block['key'] == 'extra-price-table') { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode">[block code=<?php echo $block['code']; ?> <?php echo ($block['css_lib']) ? 'css_lib=' . implode('|', $block['css_lib']) : ''; ?> <?php echo ($block['script_lib']) ? 'script_lib=' . implode('|', $block['script_lib']) : ''; ?> /]</div>
                <div class="tool">
                  <div class="element-block-edit"><a href="index.php?route=design/block/editByCode&token=<?php echo $token; ?>&code=<?php echo $block['code']; ?>" target="_blank" data-toggle="extra-info" data-id="" data-type="price-table"><i class="fa fa-code"></i></a></div>
                </div>
                <div class="image"> <img src="<?php echo $block['thumb']; ?>" class="img-responsive" /> </div>
                <?php echo $block['code']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div id="extra-info-portfolio" class="tab-pane fade block">
          <?php foreach($blocks as $block){ ?>
          <?php if($block['key'] == 'extra-portfolio') { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode">[block code=<?php echo $block['code']; ?> <?php echo ($block['css_lib']) ? 'css_lib=' . implode('|', $block['css_lib']) : ''; ?> <?php echo ($block['script_lib']) ? 'script_lib=' . implode('|', $block['script_lib']) : ''; ?> /]</div>
                <div class="tool">
                  <div class="element-block-edit"><a href="index.php?route=design/block/editByCode&token=<?php echo $token; ?>&code=<?php echo $block['code']; ?>" target="_blank" data-toggle="extra-info" data-id="" data-type="portfolio"><i class="fa fa-code"></i></a></div>
                </div>
                <div class="image"> <img src="<?php echo $block['thumb']; ?>" class="img-responsive" /> </div>
                <?php echo $block['code']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="download">
  <div class="content"> <img src="view/image/loading.gif" />
    <p><?php echo $text_download; ?></p>
  </div>
</div>
<form id="update-element" action="<?php echo $action_update_element; ?>" method="post">
</form>
<script type="text/javascript">
$('#language a:first').tab('show');

setTimeout(function(){if($('#column-left').hasClass('active')) $('#button-menu').trigger('click');}, 500);

</script> 
<script type="text/javascript">

(function($){
	$.fn.bgpicker=function(){
		this.css('position', 'relative');
		this.children('.element-background').remove();;
		this.append('<div class="element-background"><i class="fa fa-image"></i></div>');
		this.children('.element-background').on( "click", function() {
			console.log(this);
			var element = this;
			var _this = $(this).parent();
			
			$(element).parent().css('opacity', 1);
			
			$('.popover').popover('destroy', function() {
				$('.popover').remove();
			});
			
			$(element).popover({
				html: true,
				placement: 'top',
				trigger: 'manual',
				content: function() {
					return '<div style="width: 250px;"><p><?php echo $entry_background_color; ?><input type="text" name="background-color" value="' + _this.css('background-color') + '" class="form-control color-picker" style="width: 100%;" /></p><p><?php echo $entry_background_image; ?><input type="text" name="background-image" value="' + _this.css('background-image').replace(/"/g, "'") + '" class="form-control background-picker" /></p></div><div class="pull-left"><button class="btn btn-primary background-change"><?php echo $button_change; ?></button><button class="btn btn-default cancel"><?php echo $button_cancel; ?></button></div><div class="pull-right"><button class="btn btn-warning background-remove"><?php echo $button_remove; ?></button></div></div>';
				}
			});

			$(element).popover('show');
			
			$('.color-picker').colorPicker({
				customBG: '#222',
				readOnly: false,
				init: function(elm, colors) { // colors is a different instance (not connected to colorPicker)
					elm.style.backgroundColor = elm.value;
					elm.style.color = colors.rgbaMixCustom.luminance > 0.22 ? '#222' : '#ddd';
				},
			});
			
			$('.color-picker').on( 'keyup', function() {
				var color = $(this).val();
				
				$(this).colorPicker({
					init: function(elm, colors) {
						elm.style.backgroundColor = elm.value;
						elm.style.color = colors.rgbaMixCustom.luminance > 0.22 ? '#222' : '#ddd';
					}
				});
			});
			
			$('.background-picker').on( 'click', function(e) {
				var index = this;
			
				$.ajax({
					url: 'index.php?route=common/filemanager&token=' + getURLVar('token') + '&target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
					dataType: 'html',
					success: function(html) {
						$('body').append('<div id="modal-image" class="modal">' + html + '</div>');
			
						$('#modal-image').modal('show');
					}
				});
				
				$(document).delegate('#modal-image .thumbnail', 'click', function(e) {
					e.preventDefault();
					
					var image = $(this).attr('href').replace(/https:/,'').replace(/http:/,'');
					
					$(index).val("url('" + image + "')");
				});
			});
			
			$('.background-remove').on( 'click', function(e) {
				e.preventDefault();
				
				$(this).parent().parent().find('input[name="background-image"]').val('none');
				$(this).parent().parent().find('input[name="background-color"]').val('rgb(255, 255, 255)').keyup();
			});
			
			$('.background-change').on( 'click', function(e) {
				e.preventDefault();
				
				_this.css({
					'background-image' : $(this).parent().parent().find('input[name="background-image"]').val(),
					'background-color' : $(this).parent().parent().find('input[name="background-color"]').val()
					
				});
				
				$(element).popover('hide', function() {
					$('.popover').remove();
				});
				
				$(element).parent().css('opacity', '');
			});
			
			$('.cancel').on( 'click', function(e) {
				e.preventDefault();
				
				$(element).popover('hide', function() {
					$('.popover').remove();
				});
				
				$(element).parent().css('opacity', '');
			});
		}
	)}
})(jQuery)
</script> 
<script type="text/javascript">
var drag_row = 0;
var _this;
var timer = setTimeout(function(object) {}, 0);
var last_position = null;

$(function(){
	$('.extra-info-frame').each(function (){
		$(this).attr('id','extra-info-frame-'+drag_row);
		drag_row++;
	});
	
	$('*[data-background="true"]').bgpicker();
	
	setSortable();
	setEditable();
	
	$(document).delegate('input[name="preview"]', 'click',function (event) {
		if ($(this).is(":checked")) {
			var css='';
			css += '<link href="../catalog/view/stylesheet/extra-info.css" rel="stylesheet" type="text/css" />';
			css += '<link href="../catalog/view/stylesheet/hover.css" rel="stylesheet" type="text/css" />';
			$('#preview-css').html(css);
		} else {
			$('#preview-css').html('');
		}
	});
	
	$(document).delegate('#block-popup a[data-toggle="tab"]', 'click',function (event) {
		$('#block-popup .tab-content').show("slow");
	});
	
	$(document).delegate('#block-popup', 'mouseleave',function (event) {
		$('#block-popup .tab-content').hide("slow");
		$('#block-popup li.active').removeClass('active');
	});
	
	$(document).delegate('.add-shortcode', 'click',function (event) {
		
	});
	
	$(document).delegate('.extra-info-builder a:not([data-toggle="extra-info"])', 'click',function (event) {
		event.preventDefault();
	});
	
	$(document).delegate('.frame-down', 'click',function () {
		parent = $(this).parent().parent();
		swap = parent.next();
		parent.before(swap.detach());
	});
	
	$(document).delegate('.frame-up', 'click',function () {
		parent = $(this).parent().parent();
		swap = parent.prev();
		parent.after(swap.detach());
	});
	
	$(document).delegate('.frame-remove', 'click',function () {
		$(this).parent().parent().remove();
	});
	
	$(document).delegate('.copy-first-language', 'click', function () {
		var index = $(this).parent().children('.extra-info-builder').children('.frame');
		
		tinymce.remove();
		$('.frame').sortable('destroy');
		
		$('.popover').popover('destroy', function() {
			$('.popover').remove();
		});
		
		index.html($('.extra-info-builder:eq(0)').children('.frame').html());
		
		setSortable();
		setEditable();
	});
	
	$(document).delegate('.mce-image-src input', 'click', function () {
		var index = this;
	
		$.ajax({
			url: 'index.php?route=common/filemanager&token=' + getURLVar('token') + '&target=' + $(index).parent().find('input').attr('id') + '&thumb=' + $(index).attr('id'),
			dataType: 'html',
			success: function(html) {
				$('body').append('<div id="modal-image" class="modal">' + html + '</div>');
	
				$('#modal-image').modal('show');
			}
		});
		
		$(document).delegate('#modal-image .thumbnail', 'click', function(e) {
			e.preventDefault();
			
			var image = $(this).attr('href').replace(/https:/,'').replace(/http:/,'');
			
			$(index).val(image);
		});
	});
	
	$(document).delegate('button.submit', 'click', function () {
		tinymce.remove();
		
		$('.frame').sortable('destroy');
		
		$('.popover').popover('destroy', function() {
			$('.popover').remove();
		});
		
		$('.extra-info-builder').each(function(index, element) {
			$(this).find('.pre-div').remove();
			
			$(this).find('input[type="hidden"]').each(function(index, element) {
                var parent = $(this).parent();
				$(this).remove();
				if (parent.html() == '') parent.remove();
            });
			
			var raw = $(this).prev('textarea');
			raw.val($(this).children('.children').html());
			
			$(this).find('.frame-header, .element-tool').remove();
			
			$(this).find('.page-frame > .row').each(function(index, element) {
                $(this).html($(this).children('.element-mark'));
            });
			
			$(this).find('*[data-editable="true"]').removeAttr('id style spellcheck data-editable');
			
			$('.extra-info-frame').removeClass('col-sm-12').removeAttr('id');
			
			$('.ui-sortable-handle').removeClass('ui-sortable-handle');
			
			$('.element-background').remove();
			
            var content = $(this).next('textarea');
			content.val($(this).children('.children').html());
        });
		
		$('#form-extra-info-builder').submit();
	});
});

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

function round(number) {
	Array.prototype.min = function() {
		return Math.min.apply(null, this);
	};
	
	var step = [8.33, 16.66, 25, 33.33, 41.66, 50, 58.33, 66.66, 75, 83.33, 91.66, 100];
	var ref = [];
	
	for(i in step) ref[i] = Math.abs(step[i]-number);
	var min = Math.min.apply(null, ref);
	for(i in ref) if(ref[i] == min) return step[i];
}

function setSortable(){
	$('.children').sortable({
		cursor: 'move',
		placeholder: 'placeholder',
		forcePlaceholderSize: true,
		opacity: 0.4,
		stop: function(event, ui){
			
		}
	});
	
	$('.children').bind('click.sortable mousedown.sortable ',function(ev){
		ev.target.focus();
	});
	
	$('.block').sortable({
		helper: 'clone',
		connectWith: '.children',
		cursor: 'move',
		placeholder: 'placeholder',
		forcePlaceholderSize: true,
		opacity: 0.4,
		star: function(event, ui){
			$('.children').sortable("enable");
		},
		stop: function(event, ui){
			var idx = $('.frame').children().index($(ui.item[0]));
			var elm = $(ui.item[0]).clone(true);
			elm.addClass('extra-info-frame').attr('id', 'extra-info-frame-'+drag_row).prepend('<div class="frame-header"><div class="frame-down"><i class="fa fa-long-arrow-down"></i></div><div class="frame-up"><i class="fa fa-long-arrow-up"></i></div><div class="frame-remove"><i class="fa fa-trash"></i></div></div>');
			$('.frame').children(':eq('+idx+')').after(elm);
			
			addShortCodes(elm.children('.row'), elm.children('.row'));
			$(this).sortable('cancel');
			drag_row++;
		}
	});
}

function setEditable(){
	$('*[data-editable="true"]').bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(event){
		event.stopImmediatePropagation();
	});
	
	tinymce.remove();
	
	$('*[data-editable="true"]').each(function(index, element) {
		$(this).removeAttr('id');
		
		$(this).tinymce({
			inline: true,
			fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 18px 20px 22px 24px 28px 32px 36px 40px 44px",
			theme: 'modern',
			plugins: [
			  'advlist autolink lists link image charmap hr anchor pagebreak',
			  'searchreplace wordcount visualblocks visualchars code fullscreen',
			  'insertdatetime media nonbreaking contextmenu directionality',
			  'emoticons template paste textcolor colorpicker textpattern imagetools'
			],
			toolbar1: 'fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | insertfile undo redo',
			toolbar2: 'bold italic underline | forecolor backcolor | pastetext | fontselect | fontsizeselect | image media link emoticons',
			image_advtab: true,
			relative_urls: false
		});
    });
}

function preAction(shortcode){
	return $.ajax({
		url: '<?php echo $pre_action; ?>',
		type: 'post',
		dataType: 'json',
		data:{
			shortcode: shortcode,
		},
		success: function(json) {
			return json;
		},
		error: function(xhr, ajaxOptions, thrownError) {
			return {result:'error', message:'<?php echo $error_load; ?>'};
		}
	});
}


function download(code){
	return $.ajax({
		url: '<?php echo $download; ?>',
		type: 'post',
		dataType: 'json',
		data:{
			code: code,
		},
		beforeSend: function(){
			$('#download').css('display', 'block');
		},
		success: function(json) {
			$('#download').css('display', '');
			return json;
		},
		error: function(xhr, ajaxOptions, thrownError) {
			$('#download').css('display', '');
			return {result:'error', message:'<?php echo $error_load; ?>'};
		}
	});
}

function addShortCodes(_this, index){
	function _do(_this, index){
		$.ajax({
			url: '<?php echo $shortcode_api; ?>',
			type: 'post',
			dataType: 'html',
			data:{
				shortcode: shortcode,
			},
			success: function(data) {
				data = data.replace(/data-toggle="tooltip"/gi, '');
				
				var html = '';
					html += '<div class="element-mark">'+data+'</div>';
					html += '<div class="element-tool">'+tool+'</div>';
				_this.html(html);
				setEditable();
				$('*[data-background="true"]').bgpicker();
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				_this.find('.loading').remove();
			}
		});
	}
	
	var shortcode = index.parent().find('.shortcode').html();
	var tool = index.parent().find('.tool').html();
	
	_this.html('<div class="loading"><img src="view/image/loading.gif" ></div>');
	
	preAction(shortcode).done(function(pre_data) {
		if(pre_data.result == 'success'){
			for (i in pre_data.action) {
				switch(pre_data.action[i].action) {
					case 'download':
						download(pre_data.action[i].code).done(function(download) {
							if(download.result == 'error'){
								alert(download.message);
								return false;
							}
							_do(_this, index);
						});
						break;
					case 'add-css-library':
						var library = pre_data.action[i].library;
						
						for (j in library) {
							$('input[name="css_lib[]"][value="' + library[j] + '"]').prop('checked', true);
						}
						
						break;
					case 'add-script-library':
						var library = pre_data.action[i].library;
						
						for (j in library) {
							$('input[name="script_lib[]"][value="' + library[j] + '"]').prop('checked', true);
						}
						break;
					case 'nothing':
	
						_do(_this, index);
						break;
					default:
						break;
				}
			}
		}else{
			alert(pre_data.message);
		}
	})
}
</script> 
<?php echo $footer; ?>