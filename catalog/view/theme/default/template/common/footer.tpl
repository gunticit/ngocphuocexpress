<?php echo $footer_top; ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js?ver=4.7.13"></script>
<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-2 col-xs-12">
        <img src="<?= $logo; ?>" />
        <hr />
        <ul class="social-ft">
          <li>
            <a href="<?= $facebook; ?>"><i class="fa fa-facebook"></i></a>
          </li>
          <li>
            <a href="<?= $instagram; ?>"><i class="fa fa-instagram"></i></a>
          </li>
          <li>
            <a href="<?= $youtube; ?>"><i class="fa fa-youtube"></i></a>
          </li>
        </ul>
      </div>
      <div class="col-sm-3 col-xs-12">
        <ul class="info-company">
          <li><h2><?= $store_name; ?></h2></li>
          <li>
            <img src="image/catalog/building-1.png" />
            <span>Địa chỉ: <?= $address; ?></span>
          </li>
          <li>
            <img src="image/catalog/phone-call-1.png" />
            <span>Hotline: +84.979.82.9998</span>
          </li>
          <li>
            <img src="image/catalog/send-1.png" />
            <span>Email: <?= $email; ?></span>
          </li>
        </ul>
      </div>
      <div class="col-sm-4 col-xs-12">
        <h3>FANPAGE FACEBOOK</h3>
        <div class="text-center" style='padding-top:20px'>
         <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0&appId=1421044927945716&autoLogAppEvents=1" nonce="jjNcb1He"></script>
<div class="fb-page" data-href="https://www.facebook.com/ngocphuocexpress" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ngocphuocexpress" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ngocphuocexpress">Ngoc Phuoc Express</a></blockquote></div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0&appId=1421044927945716&autoLogAppEvents=1" nonce="l5LnXddi"></script>
<div class="fb-page" data-href="https://www.facebook.com/deliveryexpressvietnamcambodia/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/deliveryexpressvietnamcambodia/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/deliveryexpressvietnamcambodia/">Delivery Express Vietnam Cambodia</a></blockquote></div>
         </div>
       </div>
      <div class="col-sm-3 col-xs-12">
        <h3>Chính sách</h3>
        <ul class="info-p-ft">
          <?php foreach($informations as $info){ ?> 
          <li class="<?= $info['href']; ?>"><?= $info['title']; ?></li>
          <?php } ?>
        </ul>
      </div>
     </div>
   </div>
 </div>
</footer>

<button type="button" style="position: fixed; right:0; bottom: 10px;right:20px;z-index: 9999;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Gửi hàng đi Campuchia</button>

<!-- Modal -->
<div id="myModal" class="modal form-campuchia fade" role="dialog">
  <button onclick="handleClose()" style="position: absolute; top: 0; right: 0; z-index: 1"><i class="fa fa-close"></i></button>
  [module id=97 name=xform /]
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
<script>
  function handleClose(){
    $(".form-campuchia").removeClass('in');
    $(".modal-backdrop").removeClass('in');
  }
</script>
<?php echo $footer_bottom; ?>

<?php echo $embed_code; ?> 

</div>


<div class="col-sm-12">
  <a href="https://wa.me/84898689998" id="IMAGE449"   target="blank" class="lladi-element" id="IMAGE449">
    <div class="ladi-image">
      <div class="ladi-image-background"></div>
    </div>
  </a>
	  <a href="https://zalo.me/0333993363" target="blank" id="IMAGE448" class="ladi-element">
    <div class="ladi-image">
      <div class="ladi-image-background"></div>
    </div>
  </a>
  <a href="https://zalo.me/0898689998" id="IMAGE447" class="ladi-element">
    <div class="ladi-image">
      <div class="ladi-image-background"></div>
    </div>
  </a>


</div>
<style>
  /* @media (min-width: 768px){ */
    #IMAGE449 {
      width: 82px;
      height: 82px;

      bottom: 130px;
     right:-5px;
      position: fixed;
      z-index: 90000050;
      visibility: visible !important;
    }
    #IMAGE448 {
      width: 82px;
      height: 81px;
      top: auto;
        right:-5px;
      bottom: 45px;
 
      position: fixed;
      z-index: 90000050;
      visibility: visible !important;
    }
    #IMAGE447 {
      width: 82px;
      height: 82px;
      bottom:210px;
      right:-5px;
     
   
      position: fixed;
      z-index: 90000050;
      visibility: visible !important;
    }
    .ladi-image {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      pointer-events: none;
    }
    .ladi-image .ladi-image-background {
      background-repeat: no-repeat;
      background-position: left top;
      background-size: cover;
      background-attachment: scroll;
      background-origin: content-box;
      position: absolute;
      margin: 0 auto;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }
    #IMAGE448 > .ladi-image > .ladi-image-background {
      width: 82px;
      height: 81px;
      top: 0px;
      left: 0px;
 background-image: url(image/ico-zalo-2.png);
      background-size: 60px auto;
      background-position: 11px 12px;
    }
    #IMAGE449 > .ladi-image > .ladi-image-background {
      width: 82px;
      height: 82px;
      top: 0px;
      left: 0px;

      background-image: url(image/WhatsApp.png);
      background-size: 70px;
      background-position: 8px 7px;
    }
    #IMAGE447 > .ladi-image > .ladi-image-background {
      width: 82px;
      height: 82px;
      top: 0px;
      left: 0px;

       background-image: url(image/ico-zalo-2.png);
      background-size: 70px auto;
      background-position: 6px 5px;
    }
    #IMAGE449.ladi-animation > .ladi-image {
      animation-name: swing;
      -webkit-animation-name: swing;
      transform: rotate(0deg);
      animation-delay: 0.4s;
      -webkit-animation-delay: 0.4s;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      animation-iteration-count: infinite;
      -webkit-animation-iteration-count: infinite;
    }
    /* } */
    

    @keyframes swing{
      0%{
transform: rotate(30deg);
        animation-delay: 0.4s;
        -webkit-animation-delay: 0.4s;
        },
        20%{
          transform: rotate(-30deg);
          animation-delay: 0.4s;
          -webkit-animation-delay: 0.4s;
          },
          40%{
            transform: rotate(30deg);
            animation-delay: 0.4s;
            -webkit-animation-delay: 0.4s;
            },
            60%{
              transform: rotate(-30deg);
              animation-delay: 0.4s;
              -webkit-animation-delay: 0.4s;
              },
              80%{
                transform: rotate(30deg);
                animation-delay: 0.4s;
                -webkit-animation-delay: 0.4s;
                },
                100%{
                  transform: rotate(-30deg);
                  animation-delay: 0.4s;
                  -webkit-animation-delay: 0.4s;
                }
              }
            </style>

<div class="call-mobile">
  
  <a id="callnowbutton" href="tel:+84333993363">+84 333 99 3363</a>
  <i class="fa fa-phone"></i>
</div>
<div class="call-mobile2 call-mobile">
  <a id="callnowbutton" href="tel:+84979829998">+84 979 82 9998</a>
<i class="fa fa-phone"></i>
</div>

<div class="drag-target" data-sidenav="mobile-demo" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); left: 0px;"></div>
<style>
  .call-mobile2{
    bottom: 70px;
  }
</style>
</body></html>