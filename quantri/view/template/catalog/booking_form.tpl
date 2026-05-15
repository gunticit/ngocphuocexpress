<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">

  <div class="page-header">

    <div class="container-fluid">

      <div class="pull-right">

        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>

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

    <div class="panel panel-default">

      <div class="panel-heading">

        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>

      </div>

      <div class="panel-body">

        <div class="info-booking">
          <div class="row">
            <div class="form-group col-sm-6">
              <label for="">Chuyến đi</label>
              <input type="text" class="form-control" readonly="readonly" placeholder="Chuyến đi" value="<?= $pro_info['name']; ?>">
            </div>
            <div class="form-group col-sm-6">
              <label for="">Ghế đã đặt</label>
              <input type="text" class="form-control" readonly="readonly" placeholder="Ghế đã đặt" value="<?= $booking_info['seat_booking']; ?>">
            </div>
            <div class="form-group col-sm-6">
              <label for="">Tên khách hàng</label>
              <input type="text" class="form-control" readonly="readonly" placeholder="Tên khách hàng" value="<?= $booking_info['name_booking']; ?>">
            </div>
            <div class="form-group col-sm-6">
              <label for="">Số điện thoại</label>
              <input type="text" class="form-control" readonly="readonly" placeholder="Số điện thoại" value="<?= $booking_info['phone_booking']; ?>">
            </div>
            <div class="form-group col-sm-6">
              <label for="">Email</label>
              <input type="text" class="form-control" readonly="readonly" placeholder="Email" value="<?= $booking_info['email_booking']; ?>">
            </div>
            <div class="form-group col-sm-6">
              <label for="">Ngày đi</label>
              <input type="text" class="form-control" readonly="readonly" placeholder="Email" value="<?= $booking_info['date_booking']; ?>">
            </div>
            <div class="form-group col-sm-12">
              <label for="">Ghi chú thêm của khách hàng</label>
              <textarea class="form-control" id="" rows="10" readonly="readonly"><?= $booking_info['note_booking']; ?></textarea>
            </div>
          </div>
        </div>
        <br><br>

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-booking" class="form-horizontal">

          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Admin xử lý đơn</a></li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="tab-general">

              <div class="col-sm-12">
                <div class="tab-content">
                  <div class="form-group">
                    <label for="status-booking">Trạng thái xử lý</label>
                    <select name="status" class="form-control" id="status-booking">
                      <option <?= (isset($booking_info['status'])&&$booking_info['status'] == 0)?'selected="selected"':''; ?> value="0">Chưa xử lý</option>
                      <option <?= (isset($booking_info['status'])&&$booking_info['status'] == 1)?'selected="selected"':''; ?> value="1">Đã xử lý (thành công)</option>
                      <option <?= (isset($booking_info['status'])&&$booking_info['status'] == 2)?'selected="selected"':''; ?> value="2">Huỷ vé đặt</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status-booking">Ghi chú thêm</label>
                    <textarea name="note_admin" id="input-note" cols="30" rows="10" placeholder="Ghi chú thêm (nếu có)"><?= !empty($booking_info['note_admin'])?html_entity_decode($booking_info['note_admin']):''; ?></textarea>
                  </div>

                </div>
              </div>


            </div>

          </form>
          <button type="submit" form="form-booking" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>
        </div>

      </div>

    </div>

    <script type="text/javascript">
      $('#input-note').summernote({height: 300});
    </script>

    <?php echo $footer; ?>

