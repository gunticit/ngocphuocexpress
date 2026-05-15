<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a> <a href="<?php echo $repair; ?>" data-toggle="tooltip" title="<?php echo $button_rebuild; ?>" class="btn btn-default"><i class="fa fa-refresh"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-document').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-document">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-center"><?php echo $column_image; ?></td>
                  <td class="text-left"><?php if ($sort == 'name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                  <td class="text-right">
                    <a ><?php echo $column_status; ?></a>
                  </td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($documents) { ?>
                <?php foreach ($documents as $document) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($document['document_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $document['document_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $document['document_id']; ?>" />
                    <?php } ?></td>

                    <td class="text-center"><?php if ($document['image']) { ?>

                      <?php $filenameimage = substr(strrchr($document['image'], '/'), 1); 
                        $extimage = substr(strrchr($filenameimage, '.'), 1); ?>
                        <?php 

if($extimage == 'doc' || $extimage == 'docx') 
{ 
?>
<img src="../image/format/doc.png" style="width: 40px;"/>
<?php 
} 
else if($extimage == 'xls' || $extimage == 'xlsx') 
{ 
?>
<img src="../image/format/excel.png" style="width: 40px;"/>
<?php 
} 
else if($extimage == 'ppt' || $extimage == 'pptx') 
{ 
?>
<img src="../image/format/powerpoint.png" style="width: 40px;"/>
<?php 
}
else 
{ 
?>
<img src="<?php echo $document['image']; ?>" alt="<?php echo $document['name']; ?>" title="" data-placeholder="" width="80" height="80"/> 
<?php 
} 
?>

                   <!--  <img src="<?php echo $document['image']; ?>" alt="<?php echo $document['name']; ?>" class="img-thumbnail" /> -->
                    <?php } else { ?>
                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                    <?php } ?></td>
                 
                    
                  <td class="text-left"><?php echo $document['name']; ?></td>
                  <td class="text-right"><?php echo $document['status']; ?></td>
                  <td class="text-right"><a href="<?php echo $document['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>