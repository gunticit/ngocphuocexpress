<!-- <h3><?php echo $heading_title; ?></h3>
<div class="list-group">
    <ul class="list-item">
        <?php foreach ($informations as $information) { ?>
            <li>
                <a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a>
            </li>
        <?php } ?>
        <li>
            <a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a>
        </li>
        <li>
            <a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a>
        </li>
    </ul>
</div> -->
<div class="box-sidebar box-ext-tools cat-service">
  <div class="title-box">
    <div class="inner-title">Tiện ích</div>
</div>
<div class="content-box">
    <div class="item"><a class="link-currency" rel="nofollow" href="https://www.vietcombank.com.vn/ExchangeRates/#ctl00_Content_ExrateView" target="_blank">Tỷ giá ngoại tệ</a></div>
    <div class="item"><a class="link-stock" rel="nofollow" href="http://chart.vietstock.vn/publicchart/RealTimeChart_TTO.aspx" target="_blank">Bảng giá chứng khoán</a></div>
    <div class="item"><a class="link-gold" rel="nofollow" href="http://vip2.giavang.net/teline2/data/aj2a.php" target="_blank">Giá vàng</a></div>
    <div class="item"><a class="link-weather" rel="nofollow" href="http://www.vietnamtourism.com/v_pages/tools/thoitiet_vn.asp " target="_blank">Thời tiết</a></div></div>
</div>
<div class="module-category-ifo box-sidebar box-news cat-service">
    <div class="title-box">
        <div class="inner-title">Tiện ích</div>
    </div>
    <ul>
        <?php foreach ($categories as $category){ ?>
        <?php if(!$category['children']){ ?> 
        <li><a href="<?= $category['href']; ?>"><?= $category['name']; ?></a></li>
        <?php } else {?> 
        <?php foreach($category['children'] as $child){ ?> 
        <li>
            <div class="image"><a href="<?= $child['href']; ?>"><img src="image/<?= $child['image']; ?>" alt="<?= $child['name']; ?>"></a></div>
            <div class="caption">
                <a href="<?= $child['href']; ?>"><?= $child['name']; ?></a>
            </div>
        </li>
        <?php } ?>
        <?php } ?>
        <?php } ?>
    </ul>
</div>