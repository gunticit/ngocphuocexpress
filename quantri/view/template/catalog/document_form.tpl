<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-document" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-document" class="form-horizontal">
          <ul class="nav nav-tabs" >
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-image" data-toggle="tab">Đăng tải thêm</a></li>
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
                    <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="document_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($document_description[$language['language_id']]) ? $document_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
          
                </div>
                <?php } ?>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-mota">Mô tả</label>
                <div class="col-sm-10">
                  <!-- <input type="text" name="mota" value="<?php echo $mota; ?>" placeholder="Mô tả" id="input-mota" class="form-control" /> -->
                  <textarea name="mota" placeholder="Mô tả" id="input-mota" class="form-control" style="height: 100px;"><?php echo $mota; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-image">Tài liệu</label>
                <div class="col-sm-10">
                  <?php $filenameimage = substr(strrchr($image, '/'), 1); 
                        $extimage = substr(strrchr($filenameimage, '.'), 1); ?>
                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">

                                          <?php 
if($extimage == 'doc' || $extimage == 'docx') 
{ 
//echo $filename1;
?>
<img src="../image/format/doc.png" style="width: 100px;"/><div style="position:absolute; top:60px; width:100%; text-align:center;word-wrap: break-word; padding:0px 7px;"><?php echo $filenameimage; ?></div>
<?php 
} 
else if ($extimage == 'xls' || $extimage == 'xlsx') 
{
?>
<img src="../image/format/excel.png" style="width: 100px;"/><div style="position:absolute; top:60px; width:100%; text-align:center;word-wrap: break-word; padding:0px 7px;"><?php echo $filenameimage; ?></div>
<?php
}
else if ($extimage == 'ppt' || $extimage == 'pptx') 
{
?>
<img src="../image/format/powerpoint.png" style="width: 100px;"/><div style="position:absolute; top:60px; width:100%; text-align:center;word-wrap: break-word; padding:0px 7px;"><?php echo $filenameimage; ?></div>
<?php
}
else if ($extimage == 'pdf') 
{
?>
<img src="../image/format/pdf.png" style="width: 100px;"/><div style="position:absolute; top:60px; width:100%; text-align:center;word-wrap: break-word; padding:0px 7px;"><?php echo $filenameimage; ?></div>
<?php
}
else
{ 
?>
<img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /> 
<?php 
} 
?>

                   <!--  <img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /> -->
                  </a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>

               

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
                <label class="col-sm-2 control-label" for="input-sort">Sắp xếp</label>
                <div class="col-sm-10">
                  <input type="text" name="sort" value="<?php echo $sort; ?>" placeholder="Sắp xếp" id="input-sort" class="form-control" />
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
          
            <div class="tab-pane" id="tab-image">
              <div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Tên tài liệu</td>
                      <td class="text-left">Tài liệu</td>
                      <td class="text-right"><?php echo $entry_sort_order; ?></td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $image_row = 0; ?>
                    <?php foreach ($document_images as $document_image) { ?>
                    <tr id="image-row<?php echo $image_row; ?>">
                      <td class="text-left">
                        <input type="text" name="document_image[<?php echo $image_row; ?>][tendocument]" value="<?php echo $document_image['tendocument']; ?>" placeholder="Tên Tài liệu" class="form-control" />
                      </td>
                      <td class="text-left">
                        <?php $filenameimages = substr(strrchr($document_image['image'], '/'), 1); 
                        $extimages = substr(strrchr($filenameimages, '.'), 1); ?>
                        <a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail">
                          <?php 
                          if($extimages == 'doc' || $extimages == 'docx') 
                          { 
                          //echo $filename1;
                          ?>
                          <img src="../image/format/doc.png" style="width: 100px;"/><div style=" top:60px; width:100%; text-align:center;word-wrap: break-word; padding:0px 7px;"><?php echo $filenameimages; ?></div>
                          <?php 
                          } 
                          else if ($extimages == 'xls' || $extimages == 'xlsx') 
                          {
                          ?>
                          <img src="../image/format/excel.png" style="width: 100px;"/><div style=" top:60px; width:100%; text-align:center;word-wrap: break-word; padding:0px 7px;"><?php echo $filenameimages; ?></div>
                          <?php
                          }
                          else if ($extimages == 'ppt' || $extimages == 'pptx') 
                          {
                          ?>
                          <img src="../image/format/powerpoint.png" style="width: 100px;"/><div style=" top:60px; width:100%; text-align:center;word-wrap: break-word; padding:0px 7px;"><?php echo $filenameimages; ?></div>
                          <?php
                          }
                          else if ($extimages == 'pdf') 
                          {
                          ?>
                          <img src="../image/format/pdf.png" style="width: 100px;"/><div style=" top:60px; width:100%; text-align:center;word-wrap: break-word; padding:0px 7px;"><?php echo $filenameimages; ?></div>
                          <?php
                          }
                          else
                          { 
                          ?>
                          <img src="<?php echo $document_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /> 
                          <?php 
                          } 
                          ?>
                          <!-- <img src="<?php echo $document_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /> -->
                        </a>

                        <input type="hidden" name="document_image[<?php echo $image_row; ?>][image]" value="<?php echo $document_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                      <td class="text-right"><input type="text" name="document_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $document_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                      <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $image_row++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>



            
           
         
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({
	height: 300
});
<?php } ?>
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'path\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/document/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					document_id: 0,
					name: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['document_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'path\']').val(item['label']);
		$('input[name=\'parent_id\']').val(item['value']);
	}
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'filter\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['filter_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter\']').val('');

		$('#document-filter' + item['value']).remove();

		$('#document-filter').append('<div id="document-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="document_filter[]" value="' + item['value'] + '" /></div>');
	}
});

$('#document-filter').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
  <script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
  html  = '<tr id="image-row' + image_row + '">';
    html += '  <td class="text-left"><input type="text" name="document_image['+ image_row +'][tendocument]" value="" placeholder="Tên Tài liệu" class="form-control" /></td>';
  html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="document_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
  html += '  <td class="text-right"><input type="text" name="document_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#images tbody').append(html);

  image_row++;
}
//--></script>
<?php echo $footer; ?>