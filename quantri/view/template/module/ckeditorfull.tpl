<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-featured" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-description"><?php echo $entry_skin; ?></label>
            <div class="col-sm-4">
              <select name="ckeditorfull_skin" id="input-description" class="form-control" onchange="updatepreview(this);">
                <?php foreach ($ck_skins as $ck_skin){ ?>
                    <option value="<?php echo $ck_skin; ?>" <?php if ($ck_skin === $ckeditorfull_skin ) { echo 'selected="selected"'; }?>><?php echo $ck_skin; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-description"><?php echo $entry_skin_preview; ?></label>
            <script>
              function updatepreview(e){
                var prevcont = document.getElementById("container_skin_preview");
                prevcont.setAttribute("src", "<?php echo $ck_skins_dir;?>"+e.value+"/"+e.value+".png");
                prevcont.setAttribute("alt", e.value);
              }
            </script>
            <div class="col-sm-4">
              <div style="height: 150px;" class="img-thumbnail"><img id="container_skin_preview" class="" src="<?php echo $ck_skins_dir . $ckeditorfull_skin . '/' . $ckeditorfull_skin . '.png';?>" alt="<?php echo $ckeditorfull_skin;?>"></div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
            <div class="col-sm-10">
              <input type="text" name="ckeditorfull_height" value="<?php echo $ckeditorfull_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
              <?php if ($error_height) { ?>
              <div class="text-danger"><?php echo $error_height; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-apikey"><span data-toggle="tooltip" title="<?php echo $help_apikey; ?>"><?php echo $entry_apikey; ?></span></label>
            <div class="col-sm-10">

              <div class="form-group">
                <div class="col-sm-12">
                  <input type="text" name="ckeditorfull_apikey" value="<?php echo $ckeditorfull_apikey; ?>" placeholder="<?php echo $entry_apikey; ?>" id="input-apikey" class="form-control" />
                </div>
              </div>


              <div class="panel-group">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse1"><i class="fa fa-info-circle" aria-hidden="true"></i> How to get a Google API key.</a>
                    </h4>
                  </div>
                  <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p>
                        To create your personal Google API key for use with the CKEditor Leaflet plugin follow these steps:
                      <ol>
                        <li>Go to <a href="https://console.developers.google.com/projectselector/apis/dashboard">https://console.developers.google.com/projectselector/apis/dashboard</a></li>
                        <li>Create a new project</li>
                        <li>Go to Library and enable "Google Maps JavaScript API" and "Google Places API Web Service".</li>
                        <li>Go to Credentials and create an API key.</li>
                        <li>Finally, paste this API key in the text field above.</li>
                      </ol>
                      </p>
                    </div>
                    <div class="panel-footer"></div>
                  </div>
                </div>
              </div>


            </div>

          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-acf"><?php echo $entry_acf; ?></label>
            <div class="col-sm-10">
              <select name="ckeditorfull_acf" id="input-acf" class="form-control">
                <?php if ($ckeditorfull_acf) { ?>
                <option value="false" <?php if ($ckeditorfull_acf === 'false') {echo 'selected="selected"';}?>><?php echo $text_enabled; ?></option>
                <option value="true" <?php if ($ckeditorfull_acf === 'true') {echo 'selected="selected"';}?>><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="false"><?php echo $text_enabled; ?></option>
                <option value="true" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>


