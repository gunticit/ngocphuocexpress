<?php echo $header; ?>
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
     <h3 class="heading_title"><span><?php echo $heading_title; ?></span></h3>

     <div class="row"><div class="video_sl"><?php echo $content_top; ?></div></div>
          <div class="box_video">
          <div class="list_video">
          
            <?php if ($videos) { ?> 
                <?php $i=0;?>
                  <?php foreach ($videos as $video) { ?>
                  <?php $i++;?>
                    <div class="item-lb">
                    <div class="item-video">
                      <div class="image"><a class="apopup" href="#popup_video<?php echo $i;?>"><img src="<?php echo $video['thumb'];?>" alt="<?php echo $video['name'];?>" title="<?php echo $video['name'];?>"></a></div>
                      <div class="caption">
                      <div class="name"><a class="apopup" href="#popup_video<?php echo $i;?>"><?php echo $video['name'];?></a></div>
                      </div>
                    </div>
                    <div style="display: none;">
                    <div id="popup_video<?php echo $i;?>" class="video-popup">
                        <a class="close-popup" href="#"><i class="fa fa-times"></i></a>
                         <div class="video-video">
                           <?php foreach ($video['images'] as $image) { ?>
                              <div class="item"><img src="<?php echo $image['thumb'];?>" /></div>
                            <?php } ?>      
        
                       </div>
                     </div>
                     </div>
                    </div>
                  <?php } ?>    
             <?php } ?>
          </div>

          <div class="pana"><?php echo $pagination; ?></div>
        </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript">
  
  $(document).ready(function() {
  $('.apopup').magnificPopup({
    type: 'inline',
    preloader: false,
    modal: true
});
});

</script>
<script>
  $(".video-video").owlCarousel({
                    singleItem:true,
                    item:1,
                    autoPlay:false,
                    navigation:true,
                    autoPlay: 10000,
                    navigationText: ['<span class="icon_prev">', '<span class="icon_next">'],
                    pagination:false,
                                        transitionStyle : "fade"
                                  });

                  
                              </script>
<?php echo $footer; ?>
