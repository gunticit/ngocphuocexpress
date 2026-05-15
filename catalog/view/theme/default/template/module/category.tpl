<?php if(empty($homepage)){ ?> 
  <div class="module-category">

    <div class="title-box">

      <div class="inner-title">Các danh mục sản phẩm</div>

    </div>

    <div class="list-group box-category">

      <ul class="list-item">

        <?php foreach ($categories as $category) { ?>

          <?php if ($category['category_id'] == $category_id) { ?>

            <li><a href="<?php echo $category['href']; ?>" class="active"><?php echo $category['name']; ?></a>

            <?php } else { ?>

              <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>

              <?php } ?>

              <?php if ($category['children']) { ?>

                <ul class="category-col-<?php echo $column; ?>">

                  <?php foreach (array_chunk($category['children'], (round(count($category['children'])/$column))) as $children) { ?>

                    <div class="<?php echo $class; ?>">

                      <?php foreach ($children as $child) { ?>

                        <?php if ($child['category_id'] == $child_id) { ?>

                          <li><a href="<?php echo $child['href']; ?>" class="active"><?php echo $child['name']; ?></a>

                          <?php } else { ?>

                            <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>

                            <?php } ?>

                            <?php if ($child['children']) { ?>

                              <ul>

                                <?php foreach ($child['children'] as $child_lv1) { ?>

                                  <?php if ($child['category_id'] == $child_id) { ?>

                                    <li><a href="<?php echo $child_lv1['href']; ?>" class="active"><i class="fa fa-long-arrow-right"></i> <?php echo $child_lv1['name']; ?></a></li>

                                  <?php } else { ?>

                                    <li><a href="<?php echo $child_lv1['href']; ?>"><i class="fa fa-long-arrow-right"></i> <?php echo $child_lv1['name']; ?></a></li>

                                  <?php } ?>

                                <?php } ?>

                              </ul>

                            <?php } ?>

                          </li>

                        <?php } ?>

                      </div>

                    <?php } ?>

                  </ul>

                <?php } ?>

              </li>

            <?php } ?>

          </ul>

        </div>

      </div>

      <div class="module-category online_support">



        <div class="logo1">



          <h3><i class="icon fa fa-bars"></i>  HỖ TRỢ TRỰC TUYẾN</h3>



        </div>  

        <div class="border-onl">

          <div class="icon-box featured-box icon-box-left text-left">



            <div class="icon-box-img" style="width: 30px">



              <div class="icon">



                <div class="icon-inner">



                  <img width="30" height="30" src="image/icon.png" class="attachment-medium size-medium">         </div>



                </div>



              </div>



              <div class="icon-box-text last-reset">







                <p><span style="font-size: 110%; color: #222;">Tư vấn bán hàng</span><br>



                  <a href="tel: <?= $telephone; ?>" style="font-size: 95%;    color: #8B0F0F; font-weight: bold;  font-size: 19px;"><?= $telephone; ?></a></p>



                </div>



              </div>



              <div class="icon-box featured-box icon-box-left text-left">



                <div class="icon-box-img" style="width: 30px">



                  <div class="icon">



                    <div class="icon-inner">



                      <img width="30" height="30" src="image/icon-email.png" class="attachment-medium size-medium" alt="">         

                    </div>



                  </div>



                </div>



                <div class="icon-box-text last-reset">





                  <p><span style="font-size: 110%; color: #222;">Email liên hệ</span><br>



                    <a href="mailto: <?= $email; ?>" style="font-size: 95%; color: #8B0F0F; font-weight: bold;  font-size: 19px;"><?= $email; ?></a></p>



                  </div>



                </div>

              </div>

            </div>
            <style>
             .online_support a:hover {
              text-decoration: none;
              color: #ba262e !important;
            }
          </style>
        <?php } else { ?> 
         <div class="home-category-pro">
          <div class="container">
            <div class="row">
              <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <?php foreach($categorie_homes as $key => $category){ ?> 
                    <?php if($category['category_id'] != '224'){ ?> 
                      <li role="presentation" class="<?= ($key == 0) ? 'active' : ''; ?>">
                        <a href="#cate<?= $key; ?>" aria-controls="cate<?= $key; ?>" role="tab" data-toggle="tab"><?= $category['name']; ?></a>
                      </li>
                    <?php } ?>
                  <?php } ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <?php foreach($categorie_homes as $key => $category){ ?> 
                    <?php if($category['category_id'] != '224'){ ?> 
                      <?php if(isset($category['products'])){ ?> 
                        <div role="tabpanel" class="tab-pane <?= ($key == 0) ? 'active' : ''; ?>" id="cate<?= $key; ?>">
                          <?php foreach($category['products'] as $product){ ?> 
                            <div class="col-sm-3">
                              <div class="bg-pro-cates">
                                <?php include($product_item); ?>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                        <?php if(!empty($show_more_pro)){ ?> 
                          <a href="<?= $category['href']; ?>">Xem thêm</a>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php foreach($categorie_homes as $key => $category){ ?> 
          <?php if($category['category_id'] == '224'){ ?> 
            <div class="home-vattu">
              <div class="container">
                <div class="row">
                  <div class="box-title">
                    <h3><?= $category['name']; ?></h3>
                  </div>
                  <?php foreach($category['products'] as $product){ ?> 
                    <div class="col-sm-3">
                      <div class="bg-pro-cates">
                        <?php include($product_item); ?>
                      </div>
                    </div>
                  <?php } ?>
                  <?php if(!empty($show_more_pro)){ ?> 
                    <a href="<?= $category['href']; ?>">Xem thêm</a>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
        <?php } ?>