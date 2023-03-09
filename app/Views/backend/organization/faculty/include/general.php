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
               <?php echo form_input('title', validate_input(set_value('title', (isset($faculty['title'])) ? $faculty['title'] : '')), 'class="form-control '.(($method == 'create') ? 'title' : '').'"  placeholder="" id="title" autocomplete="off"'); ?>
            </div>
         </div>
      </div>
      <div class="row mb15">
         <div class="col-lg-12">
            <div class="form-row">
               <label class="control-label text-left">
                  <span>Tên rút gọn <b class="text-danger">(*)</b></span>
               </label>
               <?php echo form_input('short_title', validate_input(set_value('short_title', (isset($faculty['short_title'])) ? $faculty['short_title'] : '')), 'class="form-control '.(($method == 'create') ? 'short_title' : '').'"  placeholder="" id="short_title" autocomplete="off"'); ?>
            </div>
         </div>
      </div>
      <div class="row mb15">
         <div class="col-lg-12">
            <div class="form-row">
               <label class="control-label text-left">
                  <span>Ngày thành lập <b class="text-danger">(*)</b></span>
               </label>
               <?php echo form_input('founding', validate_input(set_value('founding', (isset($faculty['founding'])) ? $faculty['founding'] : '')), 'class="form-control datetimepicker '.(($method == 'create') ? 'founding' : '').'"  placeholder="" id="founding" autocomplete="off"'); ?>
            </div>
         </div>
      </div>
      <div class="row mb15">
         <div class="col-lg-12">
            <div class="form-row form-description">
               <div class="uk-flex uk-flex-middle uk-flex-space-between">
                  <label class="control-label text-left">
                     <span>Mô tả</span>
                  </label>
                  <a href="" title="" data-target="description" class="uploadMultiImage">Upload Hình Ảnh</a>
               </div>
               <?php echo form_textarea('description', htmlspecialchars_decode(html_entity_decode(set_value('description', (isset($faculty['description'])) ? $faculty['description'] : ''))), 'class="form-control ck-editor" id="description" placeholder="" autocomplete="off"');?>

            </div>
         </div>
      </div>
      <div class="row mb15">
         <div class="col-lg-12">
            <div class="form-row form-content">
               <div class="uk-flex uk-flex-middle uk-flex-space-between">
                  <label class="control-label text-left">
                     <span>Nội dung</span>
                  </label>
                  <a href="" title="" data-target="content" class="uploadMultiImage">Upload Hình Ảnh</a>
               </div>
               <?php echo form_textarea('content', htmlspecialchars_decode(html_entity_decode(set_value('content', (isset($faculty['content'])) ? $faculty['content'] : ''))), 'class="form-control ck-editor" id="content" placeholder="" autocomplete="off"');?>

            </div>
         </div>
      </div>
   </div>
</div>
