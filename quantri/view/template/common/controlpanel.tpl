<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a href="<?php echo $category; ?>"><img src="view/image/icon/category.png" class="img-responsive"/><?php echo $text_category; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a href="<?php echo $product; ?>"><img src="view/image/icon/product.png" class="img-responsive"/><?php echo $text_product; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link" style="display: none;"> <a href="<?php echo $recurring; ?>"><img src="view/image/icon/recurring.png" class="img-responsive"/><?php echo $text_recurring; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a href="<?php echo $filter; ?>"><img src="view/image/icon/filter.png" class="img-responsive"/><?php echo $text_filter; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/attribute.png" class="img-responsive"/><?php echo $text_attribute; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $attribute; ?>"><i class="fa fa-cog" aria-hidden="true"></i><?php echo $text_attribute; ?></a></li>
          <li><a href="<?php echo $attribute_group; ?>"><i class="fa fa-cog" aria-hidden="true"></i><?php echo $text_attribute_group; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a href="<?php echo $option; ?>"><img src="view/image/icon/option.png" class="img-responsive"/><?php echo $text_option; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a href="<?php echo $manufacturer; ?>"><img src="view/image/icon/manufacturer.png" class="img-responsive"/><?php echo $text_manufacturer; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link" style="display: none;"> <a href="<?php echo $download; ?>"><img src="view/image/icon/download.png" class="img-responsive"/><?php echo $text_download; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a href="<?php echo $review; ?>"><img src="view/image/icon/review.png" class="img-responsive"/><?php echo $text_review; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/order.png" class="img-responsive"/><?php echo $text_order; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $order_recurring; ?>"><?php echo $text_order_recurring; ?></a></li>
          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/sale.png" class="img-responsive"/><?php echo $text_sales; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
          <li><a href="<?php echo $voucher_theme; ?>"><?php echo $text_voucher_theme; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/customer.png" class="img-responsive"/><?php echo $text_customer; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $customer1; ?>"><i class="fa fa-user fa-fw"></i><?php echo $text_customer; ?></a></li>
          <li><a href="<?php echo $customer_group; ?>"><i class="fa fa-users" aria-hidden="true"></i><?php echo $text_customer_group; ?></a></li>
          <li><a href="<?php echo $custom_field; ?>"><?php echo $text_custom_field; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/marketing.png" class="img-responsive"/><?php echo $text_marketing; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $marketing; ?>"><i class="fa fa-share-alt fa-fw"></i><?php echo $text_marketing; ?></a></li>
          <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
          <li><a href="<?php echo $coupon; ?>"><?php echo $text_coupon; ?></a></li>
          <li><a href="<?php echo $contact; ?>"><i class="fa fa-envelope" aria-hidden="true"></i><?php echo $text_contact; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/report.png" class="img-responsive"/><?php echo $text_reports; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $report_sale_order; ?>"><?php echo $text_report_sale_order; ?></a></li>
          <li><a href="<?php echo $report_sale_tax; ?>"><?php echo $text_report_sale_tax; ?></a></li>
          <li><a href="<?php echo $report_sale_shipping; ?>"><?php echo $text_report_sale_shipping; ?></a></li>
          <li><a href="<?php echo $report_sale_return; ?>"><?php echo $text_report_sale_return; ?></a></li>
          <li><a href="<?php echo $report_sale_coupon; ?>"><?php echo $text_report_sale_coupon; ?></a></li>
          <li><a href="<?php echo $report_product_viewed; ?>"><?php echo $text_report_product_viewed; ?></a></li>
          <li><a href="<?php echo $report_product_purchased; ?>"><?php echo $text_report_product_purchased; ?></a></li>
          <li><a href="<?php echo $report_customer_online; ?>"><?php echo $text_report_customer_online; ?></a></li>
          <li><a href="<?php echo $report_customer_activity; ?>"><?php echo $text_report_customer_activity; ?></a></li>
          <li><a href="<?php echo $report_customer_order; ?>"><?php echo $text_report_customer_order; ?></a></li>
          <li><a href="<?php echo $report_customer_reward; ?>"><?php echo $text_report_customer_reward; ?></a></li>
          <li><a href="<?php echo $report_customer_credit; ?>"><?php echo $text_report_customer_credit; ?></a></li>
          <li><a href="<?php echo $report_marketing; ?>"><?php echo $text_marketing; ?></a></li>
          <li><a href="<?php echo $report_affiliate; ?>"><?php echo $text_report_affiliate; ?></a></li>
          <li><a href="<?php echo $report_affiliate_activity; ?>"><?php echo $text_report_affiliate_activity; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a href="<?php echo $information; ?>"><img src="view/image/icon/information.png" class="img-responsive"/><?php echo $text_information; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link" style="display: none;"> <a href="<?php echo $extra_info; ?>"><img src="view/image/icon/extra-info.png" class="img-responsive"/><?php echo $text_extra_info; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"> <img src="view/image/icon/post.png" class="img-responsive"/><?php echo $text_news; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $post; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?php echo $text_news; ?></a></li>
          <li><a href="<?php echo $downloadpost; ?>"><i class="fa fa-file" aria-hidden="true"></i><?php echo $text_downloadpost; ?></a></li>
          <li><a href="<?php echo $commentspost; ?>"><i class="fa fa-comments" aria-hidden="true"></i><?php echo $text_commentspost; ?></a></li>
          <li><a href="<?php echo $reportspost; ?>"><?php echo $text_reportspost; ?></a></li>
          <li><a href="<?php echo $thread; ?>"><i class="fa fa-bars" aria-hidden="true"></i><?php echo $text_thread; ?></a></li>
          <li><a href="<?php echo $mangeuser; ?>"><i class="fa fa-user" aria-hidden="true"></i><?php echo $text_mangeuser; ?></a></li>
          <li><a href="<?php echo $settingpost; ?>"><i class="fa fa-cog fa-fw"></i><?php echo $text_settingpost; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a href="<?php echo $form; ?>"><img src="view/image/icon/form.png" class="img-responsive"/><?php echo $text_form; ?></a> </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link">
        <a href="<?php echo $location; ?>"><img src="view/image/icon/address.png" class="img-responsive"/><?php echo $text_location; ?></a>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/language.png" class="img-responsive"/><?php echo $text_language; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $language; ?>"><?php echo $text_language; ?></a></li>
          <li><a href="<?php echo $language_editor; ?>"><?php echo $text_language_editor; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/user.png" class="img-responsive"/><?php echo $text_user; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $user; ?>"><i class="fa fa-user fa-fw"></i><?php echo $text_user; ?></a></li>
          <li><a href="<?php echo $user_group; ?>"><i class="fa fa-users" aria-hidden="true"></i><?php echo $text_user_group; ?></a></li>
          <li><a href="<?php echo $api; ?>"><?php echo $text_api; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/design.png" class="img-responsive"/><?php echo $text_design; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <!--<li><a href="<?php echo $page; ?>"><?php echo $text_page; ?></a></li>-->
          <li><a href="<?php echo $megamenu; ?>"><i class="fa fa-bars" aria-hidden="true"></i><?php echo $text_megamenu; ?></a></li>
          <li><a href="<?php echo $navigation; ?>"><?php echo $text_navigation; ?></a></li>
          <!--<li><a href="<?php echo $block; ?>"><?php echo $text_block; ?></a></li>-->
          <li><a href="<?php echo $visualbuilder; ?>"><?php echo $text_visual_builder; ?></a></li>
          <li><a href="<?php echo $layout; ?>"><i class="fa fa-television fa-fw"></i><?php echo $text_layout; ?></a></li>
          <li><a href="<?php echo $banner; ?>"><?php echo $text_banner; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/extension.png" class="img-responsive"/><?php echo $text_extension; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $analytics; ?>"><?php echo $text_analytics; ?></a></li>
          <li><a href="<?php echo $module; ?>"><?php echo $text_module; ?></a></li>
          <li><a href="<?php echo $captcha; ?>"><?php echo $text_captcha; ?></a></li>
          <li><a href="<?php echo $feed; ?>"><?php echo $text_feed; ?></a></li>
          <li><a href="<?php echo $fraud; ?>"><?php echo $text_fraud; ?></a></li>
          <li><a href="<?php echo $payment; ?>"><?php echo $text_payment; ?></a></li>
          <li><a href="<?php echo $shipping; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?php echo $text_shipping; ?></a></li>
          <li><a href="<?php echo $total; ?>"><?php echo $text_total; ?></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/system.png" class="img-responsive"/><?php echo $text_system; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $setting; ?>"><i class="fa fa-cog fa-fw"></i><?php echo $text_setting; ?></a></li>
          <li><a href="<?php echo $location; ?>"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $text_location; ?></a></li>
          <li><a href="<?php echo $currency; ?>"><?php echo $text_currency; ?></a></li>
          <li><a href="<?php echo $stock_status; ?>"><?php echo $text_stock_status; ?></a></li>
          <li><a href="<?php echo $order_status; ?>"><?php echo $text_order_status; ?></a></li>
          <li><a href="<?php echo $return_status; ?>"><?php echo $text_return_status; ?></a></li>
          <li><a href="<?php echo $return_action; ?>"><?php echo $text_return_action; ?></a></li>
          <li><a href="<?php echo $return_reason; ?>"><?php echo $text_return_reason; ?></a></li>
          <li><a href="<?php echo $country; ?>"><?php echo $text_country; ?></a></li>
          <li><a href="<?php echo $zone; ?>"><?php echo $text_zone; ?></a></li>
          <li><a href="<?php echo $geo_zone; ?>"><?php echo $text_geo_zone; ?></a></li>
          <li><a href="<?php echo $tax_class; ?>"><?php echo $text_tax_class; ?></a></li>
          <li><a href="<?php echo $tax_rate; ?>"><?php echo $text_tax_rate; ?></a></li>
          <li><a href="<?php echo $length_class; ?>"><?php echo $text_length_class; ?></a></li>
          <li><a href="<?php echo $weight_class; ?>"><?php echo $text_weight_class; ?></a></li>

        </ul>
      </div>
      <div class="col-lg-2 col-fm-2 col-md-2 col-sm-2 col-fm-3 col-md-3 col-sm-3 col-xs-4 navigation-link" style="display: none;"> <a data-toggle="dropdown" href="javascript:void(0)"><img src="view/image/icon/tool.png" class="img-responsive"/><?php echo $text_tools; ?></a>
        <ul class="dropdown-menu col-sm-12">
          <li><a href="<?php echo $upload; ?>"><?php echo $text_upload; ?></a></li>
          <li><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
          <li><a href="<?php echo $export_import; ?>"><?php echo $text_export_import; ?></a></li>
          <li><a href="<?php echo $folder_protect; ?>"><?php echo $text_folder_protect; ?></a></li>
          <li><a href="<?php echo $error_log; ?>"><?php echo $text_error_log; ?></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
(function($){
	$.fn.equalHeights=function(minHeight,maxHeight){
		this.height('auto');
		
		tallest = (minHeight)?minHeight:0;
		this.each(function(){
			if($(this).height()>tallest){
				tallest = $(this).height()
			}
		});
		
		if((maxHeight)&&tallest>maxHeight) tallest = maxHeight;
		
		return this.each(function(){
			$(this).height(tallest)
		}
	)}
})(jQuery)

$(window).load(function(){
	if($(".navigation-link").length){
		$(".navigation-link").equalHeights();
	}
	
	$( window ).resize(function() {
		$(".navigation-link").equalHeights();
	});
});
</script>
<?php echo $footer; ?>