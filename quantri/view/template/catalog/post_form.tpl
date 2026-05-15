<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1><?php echo $heading_title; ?></h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
</div>
<div class="container-fluid">
  <?php if ($error) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-post" class="form-horizontal">
      <div class="col-md-9 col-sm-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
          </div>
          <div class="panel-body">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
              <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
              <li><a href="#tab-image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
              <li><a href="#tab-attribute" data-toggle="tab"><?php echo $tab_attribute; ?></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab-general">
                <ul class="nav nav-tabs" id="language">
                  <?php foreach ($languages as $language) { ?>
                  <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                  <?php } ?>
                </ul>
                <div class="tab-content">
                  <?php foreach ($languages as $language) { ?>
                  <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $text_title; ?></label>
                      <div class="col-sm-10">
                        <input type="text" name="post[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($post[$language['language_id']]) ? $post[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $text_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-short<?php echo $language['language_id']; ?>"><?php echo $text_short_description; ?></label>
                      <div class="col-sm-10">
                        <textarea name="post[<?php echo $language['language_id']; ?>][short_description]" rows="5" placeholder="<?php echo $text_short_description; ?>" id="input-short<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($post[$language['language_id']]) ? $post[$language['language_id']]['short_description'] : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $text_description; ?></label>
                      <div class="col-sm-10">
                        <textarea name="post[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $text_description; ?>" id="input-description<?php echo $language['language_id']; ?>"><?php echo isset($post[$language['language_id']]) ? $post[$language['language_id']]['description'] : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-meta_keyword<?php echo $language['language_id']; ?>"><?php echo $text_meta_keyword; ?></label>
                      <div class="col-sm-10">
                        <input type="text" name="post[<?php echo $language['language_id']; ?>][meta_keyword]" value="<?php echo isset($post[$language['language_id']]) ? $post[$language['language_id']]['meta_keyword'] : ''; ?>" placeholder="<?php echo $text_meta_keyword; ?>" id="input-meta_keyword<?php echo $language['language_id']; ?>" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="tab-pane" id="tab-data">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-thread"><span data-toggle="tooltip" title="<?php echo $help_thread; ?>"><?php echo $entry_thread; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="thread" value="" placeholder="<?php echo $entry_thread; ?>" id="input-thread" class="form-control" />
                    <div id="post-thread" class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($post_categoriespost as $post_thread) { ?>
                      <div id="post-thread<?php echo $post_thread['thread_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $post_thread['name']; ?>
                        <input type="hidden" name="post_thread[]" value="<?php echo $post_thread['thread_id']; ?>" />
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-related"><span data-toggle="tooltip" title="<?php echo $help_related; ?>"><?php echo $entry_related; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="related" value="" placeholder="<?php echo $entry_related; ?>" id="input-related" class="form-control" />
                    <div id="post-related" class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($post_relateds as $post_related) { ?>
                      <div id="post-related<?php echo $post_related['post_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $post_related['name']; ?>
                        <input type="hidden" name="post_related[]" value="<?php echo $post_related['post_id']; ?>" />
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
                  <div class="col-sm-10"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $image_thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-banner"><?php echo $entry_banner; ?></label>
                  <div class="col-sm-10"> <a href="" id="thumb-banner" data-toggle="image" class="img-thumbnail"><img src="<?php echo $banner_thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="banner" value="<?php echo $banner; ?>" id="input-banner" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-keyword"><?php echo $text_keyword; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-keyword" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-image">
                <div class="tab-pane" id="tab-image">
                  <div class="table-responsive">
                    <table id="images" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <td class="text-left"><?php echo $entry_title; ?></td>
                          <td class="text-left"><?php echo $entry_image; ?></td>
                          <td class="text-right"><?php echo $entry_sort_order; ?></td>
                          <td></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $image_row = 0; ?>
                        <?php foreach ($post_images as $post_image) { ?>
                        <tr id="image-row<?php echo $image_row; ?>">
                          <td class="text-left"><?php foreach ($languages as $language) { ?>
                            <div class="input-group pull-left"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> </span>
                              <input type="text" name="post_image[<?php echo $image_row; ?>][post_image_description][<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($post_image['post_image_description'][$language['language_id']]) ? $post_image['post_image_description'][$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
                            </div>
                            <?php if (isset($error_post_image[$image_row][$language['language_id']])) { ?>
                            <div class="text-danger"><?php echo $error_post_image[$image_row][$language['language_id']]; ?></div>
                            <?php } ?>
                            <?php } ?></td>
                          <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $post_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                            <input type="hidden" name="post_image[<?php echo $image_row; ?>][image]" value="<?php echo $post_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                          <td class="text-right" style="width: 10%;"><input type="text" name="post_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $post_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                          <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                        </tr>
                        <?php $image_row++; ?>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="3"></td>
                          <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-attribute">
                <div class="form-group">
                  <table id="attribute" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <td class="text-left"><?php echo $entry_attribute; ?></td>
                        <td class="text-left"><?php echo $entry_text; ?></td>
                        <td></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $attribute_row = 0; ?>
                      <?php foreach ($post_attributes as $post_attribute) { ?>
                      <tr id="attribute-row<?php echo $attribute_row; ?>">
                        <td class="text-left" style="width: 40%;"><input type="text" name="post_attribute[<?php echo $attribute_row; ?>][name]" value="<?php echo $post_attribute['name']; ?>" placeholder="<?php echo $entry_attribute; ?>" class="form-control" />
                          <input type="hidden" name="post_attribute[<?php echo $attribute_row; ?>][attribute_id]" value="<?php echo $post_attribute['attribute_id']; ?>" /></td>
                        <td class="text-left"><?php foreach ($languages as $language) { ?>
                          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                            <textarea name="post_attribute[<?php echo $attribute_row; ?>][post_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo $entry_text; ?>" class="form-control"><?php echo isset($post_attribute['post_attribute_description'][$language['language_id']]) ? $post_attribute['post_attribute_description'][$language['language_id']]['text'] : ''; ?></textarea>
                          </div>
                          <?php } ?></td>
                        <td class="text-left"><button type="button" onclick="$('#attribute-row<?php echo $attribute_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                      </tr>
                      <?php $attribute_row++; ?>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2"></td>
                        <td class="text-left"><button type="button" onclick="addAttribute();" data-toggle="tooltip" title="<?php echo $button_attribute_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <label class="col-sm-3 control-label" for="input-sort_order"><?php echo $text_sort_order; ?></label>
              <div class="col-sm-9">
                <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $text_sort_order; ?>" id="input-sort_order" class="form-control" />
              </div>
            </div>
            <div <?php if($postpermission<2) echo "style='display:none;'"; ?> class="form-group">
              <label class="col-sm-3 control-label" for="input-status"><?php echo $text_status; ?></label>
              <div class="col-sm-9">
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
            <div <?php if($postpermission<2) echo "style='display:none;'"; ?> class="form-group">
              <label class="col-sm-3 control-label" for="input-date-available"><?php echo $entry_date_available; ?></label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <input type="text" name="date_available" value="<?php echo $date_available; ?>" placeholder="<?php echo $entry_date_available; ?>" data-date-format="YYYY-MM-DD" id="input-date-available" class="form-control" />
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="pull-right">
              <button type="submit" form="form-post" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
              <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
    html += '  <td class="text-left">';
	<?php foreach ($languages as $language) { ?>
	html += '    <div class="input-group">';
	html += '      <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span><input type="text" name="post_image[' + image_row + '][post_image_description][<?php echo $language['language_id']; ?>][title]" value="" placeholder="<?php echo $entry_title; ?>" class="form-control" />';
    html += '    </div>';
	<?php } ?>
	html += '  </td>';	
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="post_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right" style="width: 10%;><input type="text" name="post_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#images tbody').append(html);
	
	image_row++;
}
//--></script> 
<script type="text/javascript"><!--
// Related
$('input[name=\'related\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/post/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['post_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'related\']').val('');

		$('#post-related' + item['value']).remove();

		$('#post-related').append('<div id="post-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="post_related[]" value="' + item['value'] + '" /></div>');
	}
});

$('#post-related').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//------------------------------------ thread
$('input[name=\'thread\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/thread/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['thread_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'thread\']').val('');

		$('#post-thread' + item['value']).remove();

		$('#post-thread').append('<div id="post-thread' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="post_thread[]" value="' + item['value'] + '" /></div>');
	}
});

$('#post-thread').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
</script> 
<script type="text/javascript"><!--
var attribute_row = <?php echo $attribute_row; ?>;

function addAttribute() {
    html  = '<tr id="attribute-row' + attribute_row + '">';
	html += '  <td class="text-left" style="width: 20%;"><input type="text" name="post_attribute[' + attribute_row + '][name]" value="" placeholder="<?php echo $entry_attribute; ?>" class="form-control" /><input type="hidden" name="post_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
	html += '  <td class="text-left">';
	<?php foreach ($languages as $language) { ?>
	html += '<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span><textarea name="post_attribute[' + attribute_row + '][post_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo $entry_text; ?>" class="form-control"></textarea></div>';
    <?php } ?>
	html += '  </td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

	$('#attribute tbody').append(html);

	attributeautocomplete(attribute_row);

	attribute_row++;
}

function attributeautocomplete(attribute_row) {
	$('input[name=\'post_attribute[' + attribute_row + '][name]\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
					response($.map(json, function(item) {
						return {
							category: item.attribute_group,
							label: item.name,
							value: item.attribute_id
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'post_attribute[' + attribute_row + '][name]\']').val(item['label']);
			$('input[name=\'post_attribute[' + attribute_row + '][attribute_id]\']').val(item['value']);
		}
	});
}

$('#attribute tbody tr').each(function(index, element) {
	attributeautocomplete(index);
});
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script> 
<script type="text/javascript"><!--
$('#language a:first').tab('show');
$('#option a:first').tab('show');
//--></script>
<?php echo $footer; ?>