<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"> <a onclick="javascript : megamenuSubmit();" class="btn btn-primary"><?php echo $button_save; ?></a> <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a> </div>
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
    <div class="alert alert-danger"><i class="fa fa-check-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if (isset($success) and $success) { ?>
    <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $text_edit; ?></h3>
      </div>
      <!-- start menu -->
      <div id="menu-erea" class="panel panel-body">
        <div class="left">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#block-page"><?php echo $text_page; ?></a></h4>
              </div>
              <div id="block-page" class="panel-collapse collapse in">
                <div class="panel panel-body">
                  <div class="data-block">
                    <ul>
                      <?php foreach( $pages as $page) { ?>
                      <li class="">
                        <label>
                          <input class="page" type="checkbox" value="<?php echo $page['page_id'];?>" data="<?php echo $page['name'];?>" />
                          <?php echo $page['name'];?></label>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="pull-right"><a class="add-to-menu btn btn-primary" href="javascript:void(0);"><?php echo $button_add_menu; ?></a></div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="panel-heading">
                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#block-category" class="collapsed"><?php echo $text_category; ?></a></h4>
              </div>
              <div id="block-category" class="panel-collapse collapse">
                <div class="panel panel-body">
                  <div class="data-block">
                    <ul>
                      <?php foreach( $categories as $category) { ?>
                      <li class="">
                        <label>
                          <input class="category" type="checkbox" value="<?php echo $category['category_id'];?>" data="<?php echo $category['name'];?>" />
                          <?php echo $category['name'];?></label>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="pull-right"><a class="add-to-menu btn btn-primary" href="javascript:void(0);"><?php echo $button_add_menu; ?></a></div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="panel-heading">
                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#block-thread" class="collapsed"><?php echo $text_thread; ?></a></h4>
              </div>
              <div id="block-thread" class="panel-collapse collapse">
                <div class="panel panel-body">
                  <div class="data-block">
                    <ul>
                      <?php foreach( $threads as $thread) { ?>
                      <li class="">
                        <label>
                          <input class="thread" type="checkbox" value="<?php echo $thread['thread_id'];?>" data="<?php echo $thread['name'];?>" />
                          <?php echo $thread['name'];?></label>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="pull-right"><a class="add-to-menu btn btn-primary" href="javascript:void(0);"><?php echo $button_add_menu; ?></a></div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="panel-heading">
                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#block-infomation" class="collapsed"><?php echo $text_information; ?></a></h4>
              </div>
              <div id="block-infomation" class="panel-collapse collapse">
                <div class="panel panel-body">
                  <div class="data-block">
                    <ul>
                      <?php foreach( $informations as $information) { ?>
                      <li class="">
                        <label>
                          <input class="infomation"  type="checkbox" value="<?php echo $information['information_id'];?>" data="<?php echo $information['title'];?>" />
                          <?php echo $information['title'];?></label>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="pull-right"><a class="add-to-menu btn btn-primary" href="javascript:void(0);"><?php echo $button_add_menu; ?></a></div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="panel-heading">
                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#block-manufacturer" class="collapsed"><?php echo $text_manufacturer; ?></a></h4>
              </div>
              <div id="block-manufacturer" class="panel-collapse collapse">
                <div class="panel panel-body">
                  <div class="data-block">
                    <ul>
                      <?php foreach( $manufacturers as $manufacturer) { ?>
                      <li class="">
                        <label>
                          <input class="manufacturer"  type="checkbox" value="<?php echo $manufacturer['manufacturer_id'];?>" data="<?php echo $manufacturer['name'];?>" />
                          <?php echo $manufacturer['name'];?></label>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="pull-right"><a class="add-to-menu btn btn-primary" href="javascript:void(0);"><?php echo $button_add_menu; ?></a></div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="panel-heading">
                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#block-custom" class="collapsed"><?php echo $text_custom; ?></a></h4>
              </div>
              <div id="block-custom" class="panel-collapse collapse">
                <div class="panel panel-body">
                  <div class="data-block">
                    <ul>
                      <p>
                        <label><?php echo $entry_title; ?> </label>
                        <input class="form-control title" type="text" placeholder="<?php echo $entry_title; ?>" />
                      </p>
                      <p>
                        <label><?php echo $entry_url; ?></label>
                        <input class="form-control url" type="text" placeholder="<?php echo $entry_url; ?>" />
                      </p>
                    </ul>
                  </div>
                  <div class="pull-right"><a class="add-to-menu_custom btn btn-primary" href="javascript:void(0);"><?php echo $button_add_menu; ?></a></div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="right">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
            <div class="dd" id="menu_area">
              <ol class='dd-list'>
                <?php $model->getMenuHtml(0); ?>
              </ol>
            </div>
            <input id="custom_data" type="hidden" name="custom_data" value="" />
          </form>
        </div>
      </div>
      <!-- end menu --> 
    </div>
  </div>
</div>
<script>
function get_content_obj(obj){
	var url='';
	var type_id = jQuery(obj).attr('value');
	var result="<li class='dd-item'><div class='dd-handle'>"+
	"<div class='bar'>"+
		"<span class='title'>" + jQuery(obj).attr('data') + "</span>"+		
	"</div>" + 
	"</div><div class='info hide'>"+
				"<p class='input-item'><span class='type'><?php echo $entry_type; ?> " +jQuery(obj).attr('class')+ "</span></p>"+				
				"<p class='input-item'><label><?php echo $entry_title; ?></label></p>"+
				<?php foreach($languages as $language) { ?>
				"<div class='input-group'>"+
				"<input class='form-control' type='text' name='title[][<?php echo $language['language_id']; ?>]' value='" + jQuery(obj).attr('data') + "'  />" +
				"<div class='input-group-addon'><img src='view/image/flags/<?php echo $language['image']; ?>'/></div>"+
				"</div>"+
				<?php } ?>
				"<p class='input-item'><a  href='javascript:void(0);' class='remove' onclick='remove_item(this);'><i class='fa fa-trash'></i> <?php echo $text_remove; ?></a></p>"+
				"<p class='input-item'><a  href='javascript:void(0);' class='activemega active' onclick='activemega(this);'><?php echo $text_active_mega; ?></a></p>"+
				"<div class='hidden-data'>" +
					"<input type='hidden' class='type' name='type[]' value='" + jQuery(obj).attr('class') + "'/>"+
					"<input type='hidden' class='parent_id' name='parent_id[]' value=''/>"+
					"<input type='hidden' class='type_id' name='type_id[]' value='" + type_id + "'/>"+
					"<input type='hidden' class='url' name='url[]' value=''/>"+
					"<input type='hidden' class='activemega' name='activemega[]' value='0'/>"+
				"</div>"+
				"<div class='sub-menu-content' style='display:none'><div><p class='input-item'><label><?php echo $entry_column; ?> </label><select class='form-control' name='columns[]'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></p><p class='input-item'><label><?php echo $entry_width; ?> </label><div class='input-group'><input class='form-control' name='widths[]' type='number' value=''/><div class='input-group-addon'>Px</div></div></p></div>"+
				"<p><strong><?php echo $entry_content; ?> </strong></p>"+
				<?php foreach($languages as $language) { ?>
				"<p><img src='view/image/flags/<?php echo $language['image']; ?>' title='<?php echo $language['name']; ?>' /> <?php echo $language['name']; ?></p>"+
				"<textarea class='mega-content-editor' name='content_submenu[][<?php echo $language['language_id']; ?>]' style='width: 695px; height: 213px;'></textarea>"+
				<?php } ?>
				"</div>"+
			"</div><a href='javascript:void(0);' class='explane' onclick='explane(this)'><?php echo $text_explane; ?></a></li>";
	return result;
}
function get_content_obj_custom(obj){
	var url=jQuery(obj).parent().parent().find('input.url').val();
	var title=jQuery(obj).parent().parent().find('input.title').val();
	var urlhtml="<p class='input-item'><label>Url : </label><input class='form-control' type='text' name='url[]' value='" + url + "'/></p>";
	var result="<li class='dd-item'><div class='dd-handle'>"+
	"<div class='bar'>"+
		"<span class='title'>" + title + "</span>"+		
	"</div>" + 
	"</div><div class='info hide'>"+
				"<p class='input-item'><span class='type'><?php echo $entry_type; ?> Custom</span></p>"+				
				"<p class='input-item'><label><?php echo $entry_title; ?> </label></p>"+
				<?php foreach($languages as $language) { ?>
				"<div class='input-group'>"+
				"<input class='form-control' type='text' name='title[][<?php echo $language['language_id']; ?>]' value='" + title + "'  />" +
				"<div class='input-group-addon'><img src='view/image/flags/<?php echo $language['image']; ?>'/></div>"+
				"</div>"+
				<?php } ?>
				urlhtml +
				"<p class='input-item'><a  href='javascript:void(0);' class='remove' onclick='remove_item(this);'><i class='fa fa-trash'></i> <?php echo $text_remove; ?></a></p>"+
				"<p class='input-item'><a  href='javascript:void(0);' class='activemega active' onclick='activemega(this);'><?php echo $text_active_mega; ?></a></p>"+
				"<div class='hidden-data'>" +
					"<input type='hidden' class='type' name='type[]' value='custom'/>"+
					"<input type='hidden' class='parent_id' name='parent_id[]' value=''/>"+
					"<input type='hidden' class='type_id' name='type_id[]' value=''/>"+
					"<input type='hidden' class='activemega' name='activemega[]' value='0'/>"+
				"</div>"+
				"<div class='sub-menu-content' style='display:none'><div><p class='input-item'><label><?php echo $entry_column; ?> </label><select class='form-control' name='columns[]'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></p><p class='input-item'><label><?php echo $entry_width; ?> </label><input class='form-control' name='widths[]' type='text' value=''/></p></div>"+
				"<p><strong><?php echo $entry_content; ?> </strong></p>"+
				<?php foreach($languages as $language) { ?>
				"<p><img src='view/image/flags/<?php echo $language['image']; ?>' title='<?php echo $language['name']; ?>' /> <?php echo $language['name']; ?></p>"+
				"<textarea class='mega-content-editor' name='content_submenu[][<?php echo $language['language_id']; ?>]' style='width: 695px; height: 213px;'></textarea>"+
				<?php } ?>
				"</div>"+
			"</div><a href='javascript:void(0);' class='explane' onclick='explane(this)'><?php echo $text_explane; ?></a></li>";
	return result;
}
function check_megamenu(){
	jQuery('li.dd-item').each(function(){
		var parent = jQuery(this).parents('.dd-list')
		if(parent.length > 1){
			jQuery(this).find('a.activemega').hide();
			jQuery(this).find('.sub-menu-content').hide();
		}
		else{
			jQuery(this).find('a.activemega').show();
		}
	})
}
var updatedata = function(e)
{
	check_megamenu();
}
function megamenuSubmit(){
	jQuery('#menu_area li.dd-item').each(function(index, e){
		if(jQuery(this).children('.dd-list').length > 0){
			var parent_id = index + 1;
			jQuery(this).children('.dd-list').children('li.dd-item').each(function(){
				jQuery(this).find('input.parent_id').val(parent_id);
			})
		}
		$(e).children('.info').find('input, select, textarea').each(function(){
			var name = $(this).attr('name');
			if (typeof name != 'undefined') {
				name = name.replace("[]", "["+index+"]");
				$(this).attr('name', name)
			}
		})
	})
	//return false;
	jQuery('#menu_area').children('.dd-list').children('li').children('.info').children('.hidden-data').children('.parent_id').val(0);
	jQuery('#form').submit();
}
function remove_item(obj){
	var parent=jQuery(obj).parent().parent().parent();
	jQuery(parent).remove();
}
function activemega(obj){
	if(jQuery(obj).hasClass('active')==true){
		jQuery(obj).parent().parent().parent().children(".info").children('.sub-menu-content').show();
		jQuery(obj).parent().parent().children('.hidden-data').children('.activemega').attr('value', 1);
		jQuery(obj).html("<?php echo $text_deactivate_mega; ?>");
		jQuery(obj).removeClass('active');
	}else{
		jQuery(obj).addClass('active');
		jQuery(obj).parent().parent().parent().children(".info").children('.sub-menu-content').hide();
		jQuery(obj).parent().parent().children('.hidden-data').children('.activemega').attr('value', 0);
		jQuery(obj).html("<?php echo $text_active_mega; ?>");
	}
}
function add_menu(obj){
	jQuery('.right #menu_area > ol').append(obj);
	jQuery('.mega-content-editor').summernote({height: 300});
	// Override summernotes image manager
	$('button[data-event=\'showImageDialog\']').attr('data-toggle', 'image').removeAttr('data-event');
	
	$(document).delegate('button[data-toggle=\'image\']', 'click', function() {
		$('#modal-image').remove();
		
		$(this).parents('.note-editor').find('.note-editable').focus();
				
		$.ajax({
			url: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
			dataType: 'html',
			beforeSend: function() {
				$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-image').prop('disabled', true);
			}
		});	
	});
}
function explane(obj){
	if(jQuery(obj).parent().children('.info').hasClass('hide')==true)
		{	
			jQuery(obj).parent().children('.info').show();
			jQuery(obj).parent().children('.info').removeClass('hide');
			jQuery(obj).html('<?php echo $text_explane; ?>');
		}
	else{
			jQuery(obj).parent().children('.info').hide();
			jQuery(obj).parent().children('.info').addClass('hide');
			jQuery(obj).html('<?php echo $text_collapse; ?>');
		}
 }
function treodenSetColorPicker(obj){
	$(obj).ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		},
		onChange: function(hsb, hex, rgb, el) {
			$(obj).val(hex);
			$(obj).css('background','#' + hex);
		}
	})
}
jQuery(document).ready(function(){
	var id = jQuery('#menu_area').attr('auto-id');
	jQuery('a.add-to-menu').click(function(){
		var parent = jQuery(this).parent().parent().find('ul');
		console.log(parent);
		jQuery(parent).find('input').each(function(){
			if(jQuery(this).is(':checked')){
				var obj=get_content_obj(this, id);
				add_menu(obj);
				jQuery(this).attr('checked', false)
			}
		});
	});
	jQuery('a.add-to-menu_custom').click(function(){
		var obj=get_content_obj_custom(this);		
		add_menu(obj);
	});
	jQuery('#menu_area').nestable({
        group: 1
    }).on('change', updatedata);
	check_megamenu();
	jQuery('.mega-content-editor').summernote({height: 300});
	// Override summernotes image manager
	$('button[data-event=\'showImageDialog\']').attr('data-toggle', 'image').removeAttr('data-event');
	
	$(document).delegate('button[data-toggle=\'image\']', 'click', function() {
		$('#modal-image').remove();
		
		$(this).parents('.note-editor').find('.note-editable').focus();
				
		$.ajax({
			url: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
			dataType: 'html',
			beforeSend: function() {
				$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-image').prop('disabled', true);
			}
		});	
	});
})
</script> 
<?php echo $footer; ?>