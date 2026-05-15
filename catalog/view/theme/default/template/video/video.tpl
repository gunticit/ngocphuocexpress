<?php echo $header; ?>
<div class="page-title title-left transparent-bg" style="min-height: 50px;">
  <div class="wf-wrap">
    <div class="wf-container-title">
      <div class="wf-table container" style="height: 50px;">
        <div class="row">
          <div class="wf-td col-sm-7"><h1 class="h3-size entry-title"><?php echo $heading_title; ?></h1></div>
          <div class="wf-td col-sm-5"><div class="assistive-text"></div>
          <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
              <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="<?php echo $breadcrumb['href']; ?>" itemprop="item"><span itemprop="name"><?php echo $breadcrumb['text']; ?></span></a></li>
            <?php } ?>
          </ul> 
        </div>
      </div>
    </div>
  </div>
</div>
</div>
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

          <div class="box_video">
          <div class="list_video">
              <div class="row">
                <div class="thuvienvideo-trinhchieu-css">
                  <iframe id="_ytid_80245" height="400" src="https://www.youtube.com/embed/<?php echo $duongdan; ?>?enablejsapi=1&amp;rel=0&amp;autoplay=1&amp;cc_load_policy=0&amp;iv_load_policy=1&amp;loop=0&amp;modestbranding=0&amp;showinfo=1&amp;theme=dark&amp;color=red&amp;autohide=2&amp;controls=2&amp;playsinline=0&amp;index=0&amp;" class="__youtube_prefs__" title="YouTube player" data-epytvideoid="epyt_video_70345" allowfullscreen="" data-no-lazy="1" data-skipgform_ajax_framebjll="" style="width: calc(100% - 35px); margin:auto; max-width: 100%;"></iframe>
                </div>
            <?php if ($videos) { ?> 
                  <div class="thuvienvideo-css">
                  <?php foreach ($videos as $video) { ?>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="epyt-video-thumb" tabindex="0" role="button" data-videoid="<?php echo $video['thumb'];?>" >
                    <div class="href-video" style="display: none;"><?php echo $video['thumb'];?></div>
                    <div class="epyt-video-img-box">
                      <div class="epyt-video-img" style="background-image: url(https://i.ytimg.com/vi/<?php echo $video['thumb'];?>/hqdefault.jpg)">
                        <div class="epyt-video-playhover">
                          
                          <img alt="play" class="epyt-play-img" width="30" height="23" src="image/playhover.png" data-no-lazy="1" data-skipgform_ajax_framebjll="">
                          <div class="epyt-video-playcrutch"></div>
                        </div>
                      </div>
                    </div>
                    <div class="epyt-video-title"><?php echo $video['tenvideo'];?></div>
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
  
.epyt-video-img {
  height: 0;
    width: 100%;
    padding-top: 56.25%!important;
    position: relative;
    overflow: hidden!important;
    background-size: cover!important;
    background-position: center!important;
}

.thuvienvideo-css {
    display: flex;
    flex-wrap: wrap;
}

.thuvienvideo-trinhchieu-css{
  width: 100%;
  text-align: center;
  margin-bottom: 20px;
}

.epyt-video-title{
  text-align: center;
  font-size: 11px;
    padding: 10px;
}

.epyt-video-thumb{
  margin-bottom: 10px;

  padding: 7px;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease-in-out 0s;
    -moz-transition: all 0.3s ease-in-out 0s;
    -o-transition: all 0.3s ease-in-out 0s;
    -webkit-transition: all 0.3s ease-in-out 0s;
    -ms-transition: all 0.3s ease-in-out 0s;
    background: #fff;
}

.epyt-video-thumb:hover .epyt-video-playhover {
  opacity: 1;
    bottom: 80px;
    transition: all 0.5s ease-in-out 0s;
    -moz-transition: all 0.5s ease-in-out 0s;
    -o-transition: all 0.5s ease-in-out 0s;
    -webkit-transition: all 0.5s ease-in-out 0s;
    -ms-transition: all 0.5s ease-in-out 0s;
}

.epyt-video-playhover{
  display: block;
    background: rgba(255,255,255, .5);
    margin: 0 30px;
    -webkit-box-shadow: 2px 4px 5px 0px rgba(0, 0, 0, 0.09);
    box-shadow: 2px 4px 5px 0px rgba(0, 0, 0, 0.09);
    min-height: 40px;
    padding: 8px 0;
    position: absolute;
    bottom: -50px;
    left: 0;
    right: 0;
    visibility: hidden;
    opacity: 0;
    transition: all 0.5s ease-in-out 0s;
    -moz-transition: all 0.5s ease-in-out 0s;
    -o-transition: all 0.5s ease-in-out 0s;
    -webkit-transition: all 0.5s ease-in-out 0s;
    -ms-transition: all 0.5s ease-in-out 0s;
}
</style>
<script>
  $(document).ready(function(){
    $('.epyt-video-thumb').click(function(){
      var a = $(this).children().html();
       var iframe = '<iframe id="_ytid_80245" width="640" height="360" src="https://www.youtube.com/embed/'+ a +'?enablejsapi=1&amp;rel=0&amp;autoplay=1&amp;cc_load_policy=0&amp;iv_load_policy=1&amp;loop=0&amp;modestbranding=0&amp;showinfo=1&amp;theme=dark&amp;color=red&amp;autohide=2&amp;controls=2&amp;playsinline=0&amp;index=0&amp;" class="__youtube_prefs__" title="YouTube player" data-epytvideoid="epyt_video_70345" allowfullscreen="" data-no-lazy="1" data-skipgform_ajax_framebjll="" style="max-width: 100%;"></iframe>';
      $(".thuvienvideo-trinhchieu-css").html(iframe);
      $('html, body').animate({ scrollTop: $('#content').offset().top - 50 }, 'slow');
    });
  });
</script>
<?php echo $footer; ?>
