<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />

<style>
  #slideshow-0{
    height: 700px;
    overflow: hidden;
    background:linear-gradient(to right, #333F4D, #FEFFA3);
  }
  #slideshow-0 .slick-active img{
    z-index: 2;
  }
  #slideshow-0 .slick-active .cloud{
    transition: all ease 1.8s;
    transform: scale(1.2);
    position: absolute;
    z-index: 1; 
  }
  #slideshow-0 .main-image{
    position: relative;
    transition: all ease 2.8s;
  }
  #slideshow-0 .lefttoright.main-image{
    left: -1200px;
    top: 50px
  }
  #slideshow-0 .righttoleft.main-image{
    right: -1200px;
    top: auto;
    bottom: 30px;
    position: absolute;
  }
  #slideshow-0 .fadeIn.main-image{
    left: -1200px;
    bottom: 0
  }
  #slideshow-0 .slick-active .lefttoright.main-image{
    left: 0;
  }
  #slideshow-0 .slick-active .righttoleft.main-image{
    right: 50%;
    transform: translate(50%);
  }
  #slideshow-0 .slick-active .fadeIn.main-image{
    left: 28%;
    bottom: 0
  }
  .div-item-slide{
    width: 100%; height: 100%; justify-content: center; display: flex; position: relative;
  }
  .div-item-slide img{
    position: absolute;
  }
#slideshow-0 .slick-slide, #slideshow-0 > div{
height: 700px !important;
    width: 100%;
}
#slideshow-0 .div-item-slide{
height: 700px;
}
@media (max-width: 768px){
  #slideshow-0{
    height: 330px;
  }
#slideshow-0 .slick-slide, #slideshow-0 > div{
height: 330px !important;
    width: 100%;
}
#slideshow-0 .div-item-slide,.img-mbsss{
height: 330px !important;
object-fit: contain;
}
}
</style>
<div id="slideshow-<?php echo $module; ?>">
  <?php foreach ($banners as $banner) { ?>
    <?php if(empty($banner['html_effect'])){ ?>
      <div><img class="cloud" src="image/clouds.png" /> <div style="width: 100%; justify-content: center; display: flex;"><img src="<?php echo $banner['image']; ?>" class="img-mbsss"  style="height: 100%; height: 700px; width: 100%"/></div></div>
    <?php } else { ?>
      <?php if($banner['html_effect'] === 'moveFromLeft'){ ?> 
        <div>
          <img class="cloud" src="image/clouds.png" /> 
          <div class="div-item-slide">
            <div style="display: flex; flex-direction: column; position: relative;">
              <img class="lefttoright main-image" style="max-height: 189px;" src="<?php echo $banner['image']; ?>"/>
              <div class="slide-description">
                <?= html_entity_decode($banner['html']); ?> 
              </div>
            </div>
          </div>
        </div>
      <?php } else if($banner['html_effect'] === 'moveFomRight'){ ?>
        <div>
            <img class="cloud" src="image/clouds.png" /> 
            <div class="div-item-slide">
              <div class="slide-description-right">
                <?= html_entity_decode($banner['html']); ?> 
              </div>
              <img class="righttoleft main-image" style="max-height: 189px;" src="<?php echo $banner['image']; ?>"/>
            </div>
        </div>
      <?php } else if($banner['html_effect'] === 'fadeIn'){ ?>  
        <div>
            <img class="cloud" src="image/clouds.png" /> 
            <div class="div-item-slide">
              <div class="slide-description-right">
                <?= html_entity_decode($banner['html']); ?> 
              </div>
              <img class="fadeIn main-image" src="<?php echo $banner['image']; ?>"/>
            </div>
        </div>
      <?php } ?> ?>
    <?php } ?>
  <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<script>
$(document).ready(function () {
  $('#slideshow-<?php echo $module; ?>').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    // autoplay: true,
    // autoplaySpeed: 5000,
  });
});
</script>
