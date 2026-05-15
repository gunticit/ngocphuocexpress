<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="block-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary submit" onClick="$('#form-block').submit();"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a> </div>
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
        <h3 class="panel-title"></h3>
      </div>
      <form id="form-block" action="<?php echo $action; ?>" method="post" class="form-horizontal">
        <div class="panel-body">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="form-group">
                <label class="col-sm-12" for="input-html"><?php echo $entry_html; ?></label>
                <div class="col-sm-12">
                  <textarea type="text" name="html" placeholder="<?php echo $entry_html; ?>" id="input-html" class="form-control"><?php echo $html; ?></textarea>
                  <div id="html" style="height: 700px;"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-12" for="input-css"><?php echo $entry_css; ?></label>
                <div class="col-sm-12">
                  <textarea type="text" name="css" placeholder="<?php echo $entry_css; ?>" id="input-css" class="form-control"><?php echo $css; ?></textarea>
                  <div id="css" style="height: 700px;"></div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-data">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_avatar; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-avatar" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="avatar" value="<?php echo $avatar; ?>" id="input-avatar" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-key"><?php echo $entry_key; ?></label>
                <div class="col-sm-2">
                  <select name="key" id="input-key" class="form-control">
                    <option value="custom" <?php echo ($key == 'custom') ? 'selected' : ''; ?>><?php echo $text_custom; ?></option>
                    <option value="extra-intro" <?php echo ($key == 'extra-intro') ? 'selected' : ''; ?>><?php echo $text_extra_intro; ?></option>
                    <option value="extra-content" <?php echo ($key == 'extra-content') ? 'selected' : ''; ?>><?php echo $text_extra_content; ?></option>
                    <option value="extra-step-by-step" <?php echo ($key == 'extra-step-by-step') ? 'selected' : ''; ?>><?php echo $text_extra_step_by_step; ?></option>
                    <option value="extra-text-grid" <?php echo ($key == 'extra-text-grid') ? 'selected' : ''; ?>><?php echo $text_extra_text_grid; ?></option>
                    <option value="extra-video" <?php echo ($key == 'extra-video') ? 'selected' : ''; ?>><?php echo $text_extra_video; ?></option>
                    <option value="extra-team" <?php echo ($key == 'extra-team') ? 'selected' : ''; ?>><?php echo $text_extra_team; ?></option>
                    <option value="extra-price-table" <?php echo ($key == 'extra-price-table') ? 'selected' : ''; ?>><?php echo $text_extra_price_table; ?></option>
                    <option value="extra-portfolio" <?php echo ($key == 'extra-portfolio') ? 'selected' : ''; ?>><?php echo $text_extra_portfolio; ?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-css-lib"><?php echo $entry_css_lib; ?></label>
                <div class="col-sm-10">
                  <div id="css-lib" class="well well-sm" style="height: 350px; overflow: auto;">
                    <?php foreach ($stylesheets as $stylesheet) { ?>
                      <p>
                        <label><input type="checkbox" name="css_lib[]" value="<?php echo $stylesheet; ?>" <?php echo (in_array($stylesheet, $css_lib)) ? 'checked' : ''; ?> /> <?php echo $stylesheet; ?></label>
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
                        <label><input type="checkbox" name="script_lib[]" value="<?php echo $javascript; ?>" <?php echo (in_array($javascript, $script_lib)) ? 'checked' : ''; ?> /> <?php echo $javascript; ?></label>
                      </p>
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
<?php if (isset($ajax)) { ?>
<div style="position: fixed; top: 50%; right: 0px; z-index: 999;">
  <button id="ajax-submit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $button_ajax; ?>
  <div class="loading" style="display: inline-block;"></div>
  </button>
</div>
<script type="text/javascript">
$(document).delegate('#ajax-submit', 'click', function(e) {
	var _this = $(this);
	
	$.ajax({
		url: '<?php echo $ajax; ?>',
		dataType: 'json',
		type: 'post',
		data: $("#form-block").serialize(),
		beforeSend: function() {
			_this.children('.loading').html('<img src="view/image/loading-3.gif" style="height: 16px; padding-left: 5px;" >');
		},
		success: function(html) {
			_this.children('.loading').html('');
		}
	});
});
</script>
<?php } ?>
<script type="text/javascript">
var html_editor = ace.edit("html");
var html = $('textarea[name="html"]').hide();
html_editor.setTheme("ace/theme/twilight");
html_editor.getSession().setMode("ace/mode/php");
html_editor.getSession().setUseWrapMode(true);
html_editor.getSession().setValue(html.val());
html_editor.getSession().on('change', function(){
	html.val(html_editor.getSession().getValue());
});

var css_editor = ace.edit("css");
var css = $('textarea[name="css"]').hide();
css_editor.setTheme("ace/theme/twilight");
css_editor.getSession().setMode("ace/mode/css");
css_editor.getSession().setUseWrapMode(true);
css_editor.getSession().setValue(css.val());
css_editor.getSession().on('change', function(){
	css.val(css_editor.getSession().getValue());
});
</script> 
<?php echo $footer; ?>