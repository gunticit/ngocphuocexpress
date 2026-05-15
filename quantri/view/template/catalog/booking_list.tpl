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

    <?php if ($error_warning) { ?>

      <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>

      <button type="button" class="close" data-dismiss="alert">&times;</button>

    </div>

  <?php } ?>

  <?php if ($success) { ?>

    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>

    <button type="button" class="close" data-dismiss="alert">&times;</button>

  </div>

<?php } ?>

<div class="panel panel-default">

  <div class="panel-heading">

    <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>

  </div>

  <div class="panel-body">

    <div class="well">

      <div class="row">

        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label" for="input-status">Ngày đi</label>
            <input type="date" name="filter_date" value="<?= $filter_date; ?>" id="input-date" class="form-control">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label" for="input-status">Trạng thái</label>
            <select name="filter_status" id="input-status" class="form-control">
              <option value="*"></option>
              <?php if (isset($filter_status)&&$filter_status == 0) { ?>
                <option value="0" selected="selected">Chưa xử lý</option>
              <?php } else { ?>
                <option value="0"><?php echo $text_enabled; ?></option>
              <?php } ?>
              <?php if (isset($filter_status)&&$filter_status == 1) { ?>
                <option value="1" selected="selected">Đã xử lý</option>
              <?php } else { ?>
                <option value="1">Đã xử lý</option>
              <?php } ?>
              <?php if (isset($filter_status)&&$filter_status == 2) { ?>
                <option value="2" selected="selected">Huỷ vé</option>
              <?php } else { ?>
                <option value="2">Huỷ vé</option>
              <?php } ?>
            </select>
          </div>
          <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
        </div>

      </div>

    </div>

    <form id="form-booking">

      <div class="table-responsive">

        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-center">ID</td>
              <td class="text-center">Ngày khởi hành</td>
              <td class="text-center">Tên khách hàng</td>
              <td class="text-center">Số điện thoại</td>
              <td class="text-center">Chỗ đặt</td>
              <td class="text-center">Điểm đón</td>
              <td class="text-center">Tổng tiền</td>
              <td class="text-center">
                <?php if ($sort == 'p.status') { ?>
                  <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Trạng thái'; ?></a>
                <?php } else { ?>
                  <a href="<?php echo $sort_status; ?>"><?php echo 'Trạng thái'; ?></a>
                <?php } ?>
              </td>
              <td class="text-center"><?php echo $column_action; ?></td>

            </tr>

          </thead>

          <tbody>

            <?php if ($bookings) { ?>

              <?php foreach ($bookings as $booking) { ?>

                <tr>
                  <td class="text-center"><a href="<?= $booking['link_pro']; ?>"><?= $booking['id_pro']; ?></a></td>
                  <td class="text-center"><?php echo $booking['date_booking']; ?></td>
                  <td class="text-center"><?php echo $booking['name_booking']; ?></td>
                  <td class="text-center"><?php echo $booking['phone_booking']; ?></td>
                  <td class="text-center"><?php echo $booking['seat_booking']; ?></td>
                  <td class="text-center"><?php echo $booking['address_booking']; ?></td>
                  <td class="text-center"><?php echo $booking['price_booking']; ?></td>
                  <td class="text-center"><?= ($booking['status'] == 1)?'<label class=\'label label-success\'>Thành công</label>':(($booking['status'] == 2)?'<label class=\'label label-danger\'>Đã huỷ</label>':'<label class=\'label label-default\'>Chờ xử lý</label>') ?></td>

                  <td class="text-center"><a href="<?php echo $booking['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>

                </tr>

              <?php } ?>

            <?php } else { ?>

              <tr>

                <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>

              </tr>

            <?php } ?>

          </tbody>

        </table>

      </div>

    </form>

    <div class="row">

      <div class="col-sm-6 text-center"><?php echo $pagination; ?></div>

      <div class="col-sm-6 text-center"><?php echo $results; ?></div>

    </div>

  </div>

</div>

</div>

<script type="text/javascript"><!--

  $('#button-filter').on('click', function() {

   var url = 'index.php?route=catalog/booking&token=<?php echo $token; ?>';



  var filter_status = $('select[name=\'filter_status\']').val();



  if (filter_status != '*') {

    url += '&filter_status=' + encodeURIComponent(filter_status);

  }


  var filter_date = $('input[name=\'filter_date\']').val();



  if (filter_date != '*') {

    url += '&filter_date=' + encodeURIComponent(filter_date);

  }



  location = url;

});

//--></script>

<script type="text/javascript"><!--

  $('input[name=\'filter_name\']').autocomplete({

   'source': function(request, response) {

    $.ajax({

     url: 'index.php?route=catalog/booking/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),

     dataType: 'json',

     success: function(json) {

      response($.map(json, function(item) {

       return {

        label: item['name'],

        value: item['id_booking']

      }

    }));

    }

  });

  },

  'select': function(item) {

    $('input[name=\'filter_name\']').val(item['label']);

  }

});



  $('input[name=\'filter_model\']').autocomplete({

   'source': function(request, response) {

    $.ajax({

     url: 'index.php?route=catalog/booking/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request),

     dataType: 'json',

     success: function(json) {

      response($.map(json, function(item) {

       return {

        label: item['model'],

        value: item['id_booking']

      }

    }));

    }

  });

  },

  'select': function(item) {

    $('input[name=\'filter_model\']').val(item['label']);

  }

});

//--></script></div>

<?php echo $footer; ?>