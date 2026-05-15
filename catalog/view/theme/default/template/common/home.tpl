<?php echo $header; ?>
<?php if (!$page_content) { ?>
<div class="container" style="clear:both;">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?= $class; ?>">
      <?php echo $content_top; ?>
      <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?>
  </div>
</div>
<div class="visaochon">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="box-title">
          <h3>VÌ SAO NÊN CHỌN CHÚNG TÔI</h3>
        </div>
        <div class="content">
          <div class="item">
            <div class="icon"><img src="/image/container-truck.png" alt=""></div>
            <div class="text">
              <h4>Phục vụ đa dạng doanh nghiệp và đối tác quốc tế</h4>
              <p>Với nhiều năm kinh nghiệm vận chuyển hàng hóa tuyến Lào – Campuchia, NgocPhuocExpress tự hào đồng hành cùng nhiều doanh nghiệp, nhà máy và đối tác quốc tế, mang đến dịch vụ vận tải nhanh chóng, an toàn và tối ưu chi phí.</p>
            </div>
          </div>
          <div class="item">
            <div class="icon"><img src="/image/iso.png" alt=""></div>
            <div class="text">
              <h4>Áp dụng hệ thống quản lý chất lượng ISO 9001:2015</h4>
              <p>NgocPhuocExpress vận hành dịch vụ theo tiêu chuẩn quản lý ISO 9001:2015, đảm bảo quy trình vận tải chuyên nghiệp, tối ưu hóa chất lượng và nâng cao hiệu quả logistics cho khách hàng.</p>
            </div>
          </div>
          <div class="item">
            <div class="icon"><img src="/image/strolley-with-packages.png" alt=""></div>
            <div class="text">
              <h4>Tiên phong cung cấp giải pháp vận tải chuyên tuyến</h4>
              <p>Chúng tôi tư vấn và triển khai giải pháp vận chuyển hàng hóa tối ưu trên tuyến Lào – Campuchia, hỗ trợ doanh nghiệp duy trì hoạt động ổn định, mở rộng thị trường và phát triển bền vững.</p>
            </div>
          </div>
          <div class="item">
            <div class="icon"><img src="/image/logistics-management.png" alt=""></div>
            <div class="text">
              <h4>Đội ngũ chuyên gia và nhân viên giàu kinh nghiệm</h4>
              <p>NgocPhuocExpress quy tụ đội ngũ chuyên viên giàu kinh nghiệm, am hiểu thị trường Lào – Campuchia và nghiệp vụ logistics, sẵn sàng đáp ứng mọi yêu cầu vận tải quốc tế của khách hàng.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
<?php echo $page_content; ?>
<?php } ?>
<style>
  .content-header, .categories-mn{
    display: block;
  }
</style>
<?php echo $footer; ?>