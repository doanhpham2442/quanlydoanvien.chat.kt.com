<div class="ibox-content">
   <div class="row mb15">
      <div class="col-lg-12">
         <div class="form-row">
            <label class="control-label text-left">
               <span>Tiêu đề <b class="text-danger">(*)</b></span>
            </label>
            <?php echo form_input('title', validate_input(set_value('title', (isset($event['title'])) ? $event['title'] : '')), 'class="form-control '.(($method == 'create') ? 'title' : '').'" placeholder="" id="title" autocomplete="off"'); ?>
         </div>
      </div>
   </div>
   <div class="row mb15">
      <div class="col-lg-12">
         <div class="form-row">
            <label class="control-label text-left">
               <span>Điểm được cộng <b class="text-danger">(*)</b></span>
            </label>
            <?php echo form_input('score', validate_input(set_value('score', (isset($event['score'])) ? $event['score'] : '')), 'class="form-control '.(($method == 'create') ? 'score' : '').'" placeholder="Tối đa là 5" id="score" autocomplete="off"'); ?>
         </div>
      </div>
   </div>
   <div class="row mb15">
         <div class="col-lg-6">
            <div class="form-row">
               <label class="control-label text-left">
                  <span>Ngày bắt đầu <b class="text-danger">(*)</b></span>
               </label>
               <?php echo form_input('day_start', validate_input(set_value('day_start', (isset($event['day_start'])) ? $event['day_start'] : '')), 'class="form-control datetimepicker '.(($method == 'create') ? 'day_start' : '').'"  placeholder="" id="day_start" autocomplete="off"'); ?>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="form-row">
               <label class="control-label text-left">
                  <span>Ngày kết thúc <b class="text-danger">(*)</b></span>
               </label>
               <?php echo form_input('day_end', validate_input(set_value('day_end', (isset($event['day_end'])) ? $event['day_end'] : '')), 'class="form-control datetimepicker '.(($method == 'create') ? 'day_end' : '').'"  placeholder="" id="day_end" autocomplete="off"'); ?>
            </div>
         </div>
      </div>
   <div class="row mb15">
      <div class="col-lg-12">
         <div class="form-row form-description">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
               <label class="control-label text-left">
                  <span>Mô tả ngắn</span>
               </label>
               <a href="" title="" data-target="description" class="uploadMultiImage">Click để upload hình ảnh</a>
            </div>
            <?php echo form_textarea('description', htmlspecialchars_decode(html_entity_decode(set_value('description', (isset($event['description'])) ? $event['description'] : ''))), 'class="form-control ck-editor" id="description" placeholder="" autocomplete="off"');?>

         </div>
      </div>
   </div>

   <div class="row mb15">
      <div class="col-lg-12">
         <div class="form-row">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
               <label class="control-label text-left">
                  <span>Nội dung</span>
               </label>
               <a href="" title="" data-target="content" class="uploadMultiImage">Click để upload hình ảnh</a>
            </div>
            <?php echo form_textarea('content', htmlspecialchars_decode(html_entity_decode(set_value('content', (isset($event['content'])) ? $event['content'] : ''))), 'class="form-control ck-editor" id="content" placeholder="" autocomplete="off"');?>
         </div>
      </div>
   </div>
</div>
