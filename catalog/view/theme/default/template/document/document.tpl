<?php echo $header; ?>
<section class="header-breadcrumb" style="background-image: url(http://carpenter.weblusive-themes.com/wp-content/uploads/2016/04/banner.jpg)">
  
  <div class="container">
    <div class="row m0 page-cover">
      <h2 class="page-cover-tittle">
      <?php echo $heading_title; ?>
      </h2>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>        
    </div>
    </div>
  </section>
<div class="container">

  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">

          <div class="box_document">
          <div class="list_document">
              <div class="row">
            
             <?php $link_url = 'http://'. $_SERVER['SERVER_NAME'] . chop($_SERVER['SCRIPT_NAME'],'index.php');?>

             <?php 
                  $filename1 = substr(strrchr($image, '/'), 1); 
                  $ext1 = substr(strrchr($filename1, '.'), 1);
                  ?>
                  <?php if($ext1 == 'pdf') { ?>
                          <iframe src="<?php echo $link_url; echo $image; ?>" style="width:100%; height:650px;"></iframe>
                        <?php } else if ($ext1 == 'doc' || $ext1 == 'docx' || $ext1 == 'xls' || $ext1 == 'xlsx' || $ext1 == 'ppt' || $ext1 == 'pptx') { ?>
                                         <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $link_url; echo $image; ?>&wdStartOn=1" height="650" style="width: 100%; max-width: 100%"></iframe>
                        <?php } ?>



            <?php if (isset($documents)) { ?> 
            <hr>
            <h2 style="margin-bottom: 20px;">Các tài liệu khác:</h2>
                  <div class="thumbnails">
                  <?php foreach ($documents as $document) { ?>
                  <?php 
                  $filename2 = substr(strrchr($document['image'], '/'), 1); 
                  $ext2 = substr(strrchr($filename2, '.'), 1);
                  ?>
                  <div class="col-sm-6">
                    <div class="item-lb">
                    <div class="item-document">
                      <h3 style="text-transform: uppercase; font-size: 18px; line-height: 1.5;"><?php echo $document['tendocument'];?></h3>
                      <div class="image">
                        <!-- <a class="apopup" href="<?php echo $document['popup'];?>" "><img src="<?php echo $document['thumb'];?>" ></a> -->
                        <?php if($ext2 == 'pdf') { ?>
                          <iframe src="<?php echo $link_url; echo $document['image']; ?>" width="450" height="450" style="max-width: 100%"></iframe>
                        <?php } else if ($ext2 == 'doc' || $ext2 == 'docx' || $ext2 == 'xls' || $ext2 == 'xlsx' || $ext2 == 'ppt' || $ext2 == 'pptx') { ?>
                            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $link_url; echo $document['image']; ?>&wdStartOn=1" width="450" height="450" style="max-width: 100%"></iframe>
                        <?php } ?>
                      </div>
                     
                    </div>
                  </div>
                    </div>
                  <?php } ?>
                  </div>    
             <?php } ?>
          </div>
            </div>
        
        </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<style type="text/css">
  hr{margin: 20px 0 !important;}
</style>
<script type="text/javascript">
  



$(document).ready(function() {
  $('.thumbnails').magnificPopup({
    type:'image',
    delegate: 'a',
    document: {
      enabled:true
    }
  });
});

</script>

<?php echo $footer; ?>
