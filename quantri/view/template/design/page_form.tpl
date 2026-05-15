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
        <li><a href="#tab-design" data-toggle="tab"><?php echo $tab_design; ?></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab-general">
          <form id="form-page-builder" action="<?php echo $action; ?>" method="post" class="form-horizontal">
            <ul class="nav nav-tabs" id="language">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="page_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_name[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="page_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                  <div class="col-sm-10">
                    <textarea name="page_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                  <div class="col-sm-10">
                    <textarea name="page_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <div class="panel-body">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-home"><?php echo $entry_home; ?></label>
                <div class="col-sm-10">
                  <select name="home" id="input-home" class="form-control">
                    <option value="0" <?php echo $home == 0 ? 'selected="selected"' : ''; ?>><?php echo $text_no; ?></option>
                    <option value="1" <?php echo $home == 1 ? 'selected="selected"' : ''; ?>><?php echo $text_yes; ?></option>
                  </select>
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
              <textarea name="content" style="display: none;"></textarea>
              <textarea name="raw" style="display: none;"></textarea>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="tab-design">
          <div class="panel panel-default">
            <div class="panel-body">
              <div id="page-builder" class="col-sm-12">
                <div class="row children frame">
                  <div class="pre-div"></div>
                  <?php echo $raw; ?> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="block-popup" class="stick-popup">
  <div class="popup-content">
    <div class="popup-button"><i class="fa fa-object-group fa-lg"></i></div>
    <div class="panel-default">
      <ul class="nav nav-tabs nav-vertical">
        <li><a data-toggle="tab" href="#page-module"><?php echo $text_module; ?></a></li>
        <li><a data-toggle="tab" href="#page-extra-info"><?php echo $text_extra_info; ?></a></li>
      </ul>
      <div class="tab-content">
        <div id="page-module" class="tab-pane fade block">
          <?php foreach($extensions as $extension){ ?>
          <?php if ($extension['module']){ ?>
          <?php foreach($extension['module'] as $module) { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode"><?php echo $module['shortcode']; ?></div>
                <div class="tool">
                  <div class="element-edit"><a href="<?php echo $module['edit']; ?>" target="_blank" data-toggle="page" data-id="<?php echo $module['module_id']; ?>" data-type="module"><i class="fa fa-pencil"></i></a></div>
                  <div class="element-remove"><i class="fa fa-minus-circle"></i></div>
                </div>
                <?php echo $module['name']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php }else{ ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode"><?php echo $extension['shortcode']; ?></div>
                <div class="tool">
                  <div class="element-edit"><a href="<?php echo $extension['edit']; ?>" target="_blank" data-toggle="page" data-id="<?php echo $extension['extension_id']; ?>" data-type="extension"><i class="fa fa-pencil"></i></a></a></div>
                  <div class="element-remove"><i class="fa fa-minus-circle"></i></div>
                </div>
                <?php echo $extension['name']; ?> </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div id="page-extra-info" class="tab-pane fade block">
          <?php foreach($extra_infos as $extra_info) { ?>
          <div class="col-sm-12">
            <div class="row">
              <div class="well well-sm">
                <div class="shortcode">[extrainfo id=<?php echo $extra_info['extra_info_id']; ?> /]</div>
                <div class="tool">
                  <div class="element-edit"><a href="index.php?route=catalog/extra_info/edit&token=<?php echo $token; ?>&extra_info_id=<?php echo $extra_info['extra_info_id']; ?>" target="_blank" data-toggle="page" data-id="<?php echo $extra_info['extra_info_id']; ?>" data-type="extrainfo"><i class="fa fa-pencil"></i></a></a></div>
                  <div class="element-remove"><i class="fa fa-minus-circle"></i></div>
                </div>
                <?php echo $extra_info['name']; ?> </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <div class="row">
            <label class="col-sm-2 control-label" for="input-num-cols"><?php echo $entry_num_cols; ?></label>
            <div class="col-sm-10">
              <div id="num-cols"></div>
              <select name="num_cols" id="input-num-cols" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="12">12</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <label class="col-sm-2 control-label" for="input-col-sm"><?php echo $entry_col_sm; ?></label>
            <div class="col-sm-10">
              <div id="col-sm"></div>
              <input type="text" name="col_sm" id="input-col-sm" value="12" style="width: 20px;" disabled>
              <div id="sm-preview" class="frame-preview"></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <label class="col-sm-2 control-label" for="input-col-xs"><?php echo $entry_col_xs; ?></label>
            <div class="col-sm-10">
              <div id="col-xs"></div>
              <input type="text" name="col_xs" id="input-col-xs" value="12" style="width: 20px;" disabled>
              <div id="xs-preview" class="frame-preview"></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <label class="col-sm-2 control-label" for="input-class"><?php echo $entry_class; ?></label>
            <div class="col-sm-10">
              <input type="text" name="class" placeholder="<?php echo $entry_class; ?>" id="input-class" class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <label class="col-sm-2 control-label" for="input-full-width"><?php echo $entry_width; ?></label>
            <div class="col-sm-10">
              <input type="checkbox" name="full_width" checked>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <label class="col-sm-2 control-label" ></label>
            <div class="col-sm-10">
              <button class="btn btn-primary add-frame" onclick="addFrames();"><?php echo $button_add; ?></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="block-setting-modal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div id="loader" class="text-center"> </div>
        <iframe src="" class="hidden" frameborder="0" width="100%" id="modalFrame" onload="iframeLoaded('modalFrame')"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $text_close; ?></button>
      </div>
    </div>
  </div>
</div>
<div id="alert">
  <div class="content"> <img src="view/image/loading.gif" />
    <p></p>
  </div>
</div>
<script type="text/javascript">
$('#language a:first').tab('show');
<?php foreach ($languages as $language) { ?>
$('#insert-html-1-<?php echo $language["language_id"]; ?>').summernote({
	height: 300
});
<?php } ?>

$('#col-sm').slider({
	min: 0,
	max: 12,
	range: "min",
	animate: "slow",
	value: 12,
	slide: function( event, ui ) {
		$('#block-popup input[name="col_sm"]').val(ui.value);
	},
	change: function( event, ui ) {
		$('#block-popup input[name="col_sm"]').val(ui.value).trigger('change');
	}
});

$('#col-xs').slider({
	min: 0,
	max: 12,
	range: "min",
	animate: "slow",
	value: 12,
	step: 6,
	slide: function( event, ui ) {
		$('#block-popup input[name="col_xs"]').val(ui.value);
	},
	change: function( event, ui ) {
		$('#block-popup input[name="col_xs"]').val(ui.value).trigger('change');
		if(ui.value < 6) $('#col-xs').slider('value', 6);
	}
});

$('#block-popup input[name="full_width"]').bootstrapSwitch({
	onText: '<?php echo $text_full_width; ?>',
	offText: '<?php echo $text_1170_px; ?>',
	handleWidth: '150',
	labelWidth: '10',
	onColor: 'primary',
	offColor: 'primary',
	indeterminate: true,
	onSwitchChange: function(event, state) {
		if(state){
			$('#block-popup input[name="full_width"]').val('100%');
		}else{
			$('#block-popup input[name="full_width"]').val('1170px');
		}
	}
});

$(document).delegate('#block-popup select[name="num_cols"]', 'change click',function (event) {
	var num_cols = parseInt($(this).val());
	$('#col-sm').slider('value', (12/num_cols));
	
	slipCols();
});

$(document).delegate('#block-popup input[name="col_sm"], input[name="col_xs"]', 'change click',function (event) {
	slipCols();
});

setTimeout(function(){if($('#column-left').hasClass('active')) $('#button-menu').trigger('click');}, 500);

function slipCols(){
	var num_cols = parseInt($('#block-popup select[name="num_cols"]').val());
	var col_sm = parseInt($('#block-popup input[name="col_sm"]').val());
	var col_xs = parseInt($('#block-popup input[name="col_xs"]').val());
	
	if(col_sm < 1) col_sm = 1;
	if(col_sm > 12) col_sm = 12;
	
	if(col_xs < 6) col_xs = 6;
	if(col_xs > 12) col_xs = 12;
	
	var html = '';
	
	for( var i = 0; i < num_cols; i++) {
		html += '<div class="col-sm-'+col_sm+'"></div>';
	}
	
	$('#sm-preview').html(html);
	
	var html = '';
	
	for( var i = 0; i < num_cols; i++) {
		html += '<div class="col-sm-'+col_xs+'"></div>';
	}
	
	$('#xs-preview').html(html);
}

</script> 
<script type="text/javascript">
var drag_row = 0;
var _this;
var timer = setTimeout(function(object) {}, 0);
var last_position = null;

$(function(){
	$('.page-frame').each(function (){
		$(this).attr('id','page-frame-'+drag_row);
		drag_row++;
	});
	
	setSortable();
	setResizable();
	setResizable();
	
	$('#page-builder .shortcode').each(function(index, element) {
        reloadElement($(this));
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
	
	$(document).delegate('#page-builder a:not([data-toggle="page"])', 'click',function (event) {
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
	
	$(document).delegate('.element-remove', 'click',function () {
		$(this).parent().parent().parent().remove();
	});
	
	$(document).delegate('button.submit', 'click', function () {
		$('#page-builder').css('display', 'none');
		$('#page-builder .frame').sortable('destroy');
		$('#page-builder .children').children().removeAttr('style');
		$('#page-builder > .frame > .pre-div').remove();
		$('#page-builder .element-mark').html('');
		$('textarea[name="raw"]').val($('#page-builder > .children').html());
		
		$('#page-builder .page-frame').removeClass('col-sm-12').removeAttr('id');
		$('#page-builder .frame-header, #page-builder .element-mark, #page-builder .element-tool, #page-builder .pre-div').remove();
		$('.shortcode').removeClass('shortcode').addClass('block');
		$('#page-builder .page-frame > .row').each(function(index, element) {
            if(!$(this).html()){
				$(this).remove();
			}
        });
		$('#page-builder .page-resize').resizable('destroy');
		$('textarea[name="content"]').val($('#page-builder > .row').html());
		
		$('#form-page-builder').submit();
	});
	
	$( window ).resize(function() {
		$('#page-builder iframe').each(function(index, element) {
			resizeIframe(this);
        });
	});
	
	setTimeout(function(){$('iframe').trigger('load');}, 5000);
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

function addFrames(){
	var num_cols = parseInt($('#block-popup select[name="num_cols"]').val());
	var col_sm = parseInt($('#block-popup input[name="col_sm"]').val());
	var col_xs = parseInt($('#block-popup input[name="col_xs"]').val());
	var width = $('#block-popup input[name="full_width"]').val();
	var _class = $('#block-popup input[name="class"]').val();
	
	if(col_sm < 1) col_sm = 1;
	if(col_sm > 12) col_sm = 12;
	
	if(col_xs < 6) col_xs = 6;
	if(col_xs > 12) col_xs = 12;
	
	if(width == '1170px'){
		var page_container = 'w-1170';
	}else{
		var page_container = 'w-full';
	}
	
	var html = '';
	
	html += '<div id="page-frame-'+drag_row+'" class="col-sm-12 page-frame '+_class+'">';
		html += '<div class="frame-header">';
			html += '<div class="frame-down"><i class="fa fa-long-arrow-down"></i></div>';
			html += '<div class="frame-up"><i class="fa fa-long-arrow-up"></i></div>';
			html += '<div class="frame-remove"><i class="fa fa-trash"></i></div>';
		html += '</div>';
		html += '<div class="row">';
			html += '<div class="page-container ' + page_container + ' ">';
				html += '<div class="row">';
					for(var i = 0; i < num_cols; i++){
						html += '<div class="col-sm-'+col_sm+' col-xs-'+col_xs+' page-resize"><div class="frame"><div class="pre-div"></div></div></div>';
					}
				html += '</div>';
			html += '</div>';
		html += '</div>';
	html += '</div>';
	
	$('#page-builder .children').append(html);
	
	drag_row++;
	
	setSortable();
	setResizable();
}

function setSortable(){
	$('.children, .frame').sortable({
		connectWith: '.frame',
		cursor: 'move',
		placeholder: 'placeholder',
		forcePlaceholderSize: true,
		opacity: 0.4,
		stop: function(event, ui){
			
		}
	})
	
	$('.block').sortable({
		helper: 'clone',
		connectWith: '.frame',
		cursor: 'move',
		placeholder: 'placeholder',
		forcePlaceholderSize: true,
		opacity: 0.4,
		star: function(event, ui){
			
		},
		stop: function(event, ui){
			var idx = $('.frame').children().index($(ui.item[0]));
			var elm = $(ui.item[0]).clone(true);
			elm.addClass('page-frame').attr('id', 'page-frame-'+drag_row).prepend('<div class="frame-header"><div class="frame-down"><i class="fa fa-long-arrow-down"></i></div><div class="frame-up"><i class="fa fa-long-arrow-up"></i></div><div class="frame-remove"><i class="fa fa-trash"></i></div></div>');
			$('.frame').children(':eq('+idx+')').after(elm);
			
			addShortCodes(elm.children('.row'), elm.children('.row'));
			$(this).sortable('cancel');
			drag_row++;
		}
	})
	.disableSelection();
}

function setResizable(){
	
    var sib_total_width;
	var old_sm_col;
	var next_cell_old_sm_col;
	
    $('.page-resize').resizable({
        handles: 'e',
		autoHide: true,
        start: function(event, ui){
			var container = ui.originalElement.parent();
            sib_total_width = ui.originalSize.width + ui.originalElement.next().outerWidth();
			old_sm_col = 'col-sm-'+(12*ui.originalElement.outerWidth() / container.innerWidth()).toFixed(0);
			next_cell_old_sm_col = 'col-sm-'+(12*ui.originalElement.next().outerWidth() / container.innerWidth()).toFixed(0);
			ui.originalElement.resizable('option', 'maxWidth', (sib_total_width-80));
        },
        stop: function(event, ui){
			var container = ui.originalElement.parent(); 
            var cell_percent_width = (100 * ui.originalElement.outerWidth()/ container.innerWidth()).toFixed(2);
			var cell_percent_width_round = round(cell_percent_width);
			var balance = cell_percent_width_round-cell_percent_width;
			
			ui.originalElement.css('width', cell_percent_width_round + '%');
			
			var col_sm = 'col-sm-'+(12*ui.originalElement.outerWidth() / container.innerWidth()).toFixed(0);
			
			ui.originalElement.removeClass(old_sm_col).addClass(col_sm).removeAttr('style'); 
			
            var next_cell = ui.originalElement.next();
			var next_percent_width= round((100 * next_cell.outerWidth()/container.innerWidth()).toFixed(2)-balance);
			
            next_cell.css('width', next_percent_width + '%');
			
			var next_cell_sm_col = 'col-sm-'+(12*next_cell.outerWidth() / container.innerWidth()).toFixed(0);
			
			next_cell.removeClass(next_cell_old_sm_col).addClass(next_cell_sm_col).removeAttr('style'); 
        },
        resize: function(event, ui){ 
			ui.originalElement.next().width(sib_total_width - ui.size.width); 
        }
    });
	
	$(".page-resize:last-child").resizable('disable');
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
			$('#alert').css('display', 'block').find('p').html('<?php echo $text_download; ?>');
		},
		success: function(json) {
			$('#alert').css('display', '');
			return json;
		},
		error: function(xhr, ajaxOptions, thrownError) {
			$('#alert').css('display', '');
			return {result:'error', message:'<?php echo $error_load; ?>'};
		}
	});
}

function create(code) {
	return $.ajax({
		url: '<?php echo $create; ?>',
		type: 'post',
		dataType: 'json',
		data:{
			code: code,
		},
		beforeSend: function(){
			$('#alert').css('display', 'block').find('p').html('<?php echo $text_create; ?>');
		},
		success: function(json) {
			$('#alert').css('display', '');
			return json;
		},
		error: function(xhr, ajaxOptions, thrownError) {
			$('#alert').css('display', '');
			return {result:'error', message:'<?php echo $error_load; ?>'};
		}
	});
}

function addShortCodes(_this, index){
	function _do(_this, index){
		var html = '';
		html += '<div class="shortcode">'+shortcode+'</div>';
		html += '<div class="element-mark"><iframe src="<?php echo $shortcode_api; ?>&page_preview=true&shortcode='+encodeURI(shortcode)+'" frameborder="0" scrolling="no" width="100%" onload="resizeIframe(this);"></iframe><div class="overlay"></div></div>';
		html += '<div class="element-tool">'+tool+'</div>';
		
		_this.html(html);
	}
	
	var shortcode = index.parent().find('.shortcode').html();
	var tool = index.parent().find('.tool').html();
	
	_this.html('<div class="loading"><img src="view/image/loading.gif" ></div>');
	
	preAction(shortcode).done(function(pre_data) {
		if(pre_data.result == 'success'){
			switch(pre_data.action) {
				case 'download':
					download(pre_data.code).done(function(download) {
						if(download.result == 'error'){
							alert(download.message);
							return false;
						}
						_do(_this, index);
					});
					break;
				case 'create':
					create(pre_data.code).done(function(create) {
						
					});
					break;
				case 'nothing':
					_do(_this, index);
					break;
				default:
					break;
			}
		}else{
			alert(pre_data.message);
		}
	})
}

function resizeIframe(_this){
	$(function(){
		$(_this).height(0);
		
		$(_this).contents().find('body').css({
			width: 'auto'
		});
		
		setTimeout(function(){$(_this).height( _this.contentWindow.document.body.scrollHeight );}, 1000);
	});
}

function reloadElement(_this){
	var shortcode = _this.html();
	var mark = _this.parent().children('.element-mark');
	var html = '<iframe src="<?php echo $shortcode_api; ?>&page_preview=true&shortcode='+encodeURI(shortcode)+'" frameborder="0" scrolling="no" width="100%" onload="resizeIframe(this);"></iframe><div class="overlay"></div>';
	
	mark.html (html);
}

</script>

<script type="text/javascript">
$(document).ready(function() {
	$(document).delegate('.element-edit a', 'click', function (e) {
        e.preventDefault();
   
          var target = $(this).attr("href");

        $('#block-setting-modal').on('hide.bs.modal', function() {
            $('#modalFrame').attr("src", "");
        });

        $('#block-setting-modal').on('show.bs.modal', function() {
        	 $("#loader").show();
            var elem = $('#modalFrame').addClass('hidden');

            elem.attr("src", target);
            elem.load(function() {
                elem.contents().find("#header").remove();
                elem.contents().find("#footer").remove();
                elem.contents().find(".breadcrumb").remove();
                elem.contents().find("#column-left").remove();
                elem.contents().find("#content").css({"background":"none","padding-top":"40px"});
                elem.find('.page-header').find('button').on('click', function(){
                		alert('foo');
                });
				
				var route = GetURLParameter(this.contentWindow.location, 'route');
				
                if (route == 'extension/module' || route == 'catalog/extra_info') {
                    $('#block-setting-modal').modal('hide');
                    $('#module-ajax-success').removeClass('hidden');

                }
                $("#loader").hide();
            });
			
			
           elem.removeClass('hidden');
        });

        $('#block-setting-modal').modal('show');
    });
});

function iframeLoaded(id) {
    var iFrameID = document.getElementById(id);
    if (iFrameID) {
        iFrameID.height = "";
        iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
    }
}

function GetURLParameter(url, sParam) {
    var sPageURL = url.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}
</script>
<?php echo $footer; ?>