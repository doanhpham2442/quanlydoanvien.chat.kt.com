<div class="ibox mb20">
   <div class="ibox-title" style="padding: 9px 15px 0px;">
      <div class="uk-flex uk-flex-middle uk-flex-space-between">
         <h5>Thông tin chung <small class="text-danger">Nhập đầy đủ thông tin chung</small></h5>
         <div class="ibox-tools">
            <button type="submit" name="create" value="create" class="btn btn-primary block full-width m-b">Lưu</button>
         </div>
      </div>
   </div>
   <div class="ibox-content">
      <div class="row mb15">
         <div class="col-lg-12">
            <div class="form-row">
               <label class="control-label text-left">
                  <span>Tiêu đề <b class="text-danger">(*)</b></span>
               </label>
               <?php echo form_input('title', validate_input(set_value('title', (isset($semester['title'])) ? $semester['title'] : '')), 'class="form-control '.(($method == 'create') ? 'title' : '').'"  placeholder="" id="title" autocomplete="off"'); ?>
            </div>
         </div>
      </div>
      <div class="row mb15">
         <div class="col-lg-6">
            <div class="form-row">
               <label class="control-label text-left">
                  <span>Ngày bắt đầu <b class="text-danger">(*)</b></span>
               </label>
               <?php echo form_input('day_start', validate_input(set_value('day_start', (isset($semester['day_start'])) ? $semester['day_start'] : '')), 'class="form-control datetimepicker '.(($method == 'create') ? 'day_start' : '').'"  placeholder="" id="day_start" autocomplete="off"'); ?>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="form-row">
               <label class="control-label text-left">
                  <span>Ngày kết thúc <b class="text-danger">(*)</b></span>
               </label>
               <?php echo form_input('day_end', validate_input(set_value('day_end', (isset($semester['day_end'])) ? $semester['day_end'] : '')), 'class="form-control datetimepicker '.(($method == 'create') ? 'day_end' : '').'"  placeholder="" id="day_end" autocomplete="off"'); ?>
            </div>
         </div>
      </div>
   </div>
</div>
