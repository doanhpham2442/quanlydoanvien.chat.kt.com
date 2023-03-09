<div class="ibox mb20">
   <div class="ibox-title">
      <h5>Danh mục cha</h5>
   </div>
   <div class="ibox-content">
      <div class="row">
         <div class="col-lg-12">
            <div class="form-row mb10">
               <small class="text-danger">* Lựa chọn danh mục cha</small>
            </div>
            <div class="form-row">
               <?php echo form_dropdown('semester_id', $dropdown, set_value('semester_id', (isset($event['semester_id'])) ? $event['semester_id'] : ''), 'class="form-control m-b select2"');?>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- <div class="ibox mb20">
   <div class="ibox-title">
      <h5>Quy mô chương trình</h5>
   </div>
   <div class="ibox-content">
      <div class="row">
         <div class="col-lg-12">
            <div class="form-row mb10">
               <small class="text-danger">* Không lựa chọn nếu là quy mô toàn trường</small>
            </div>
            <div class="form-row">
               <?php // echo form_dropdown('scales', $scales, set_value('scales', (isset($event['scales'])) ? $event['scales'] : ''), 'class="form-control m-b select2"');?>
            </div>
         </div>
      </div>
   </div>
</div> -->
<div class="ibox mb20">
   <div class="ibox-title">
      <h5>Gửi minh chúng</h5>
   </div>
   <div class="ibox-content">
      <div class="row">
         <div class="col-lg-12">
            <div class="form-row">
               <div class="block clearfix">
                  <div class="i-checks mr30" style="width:100%;">
                     <span style="color:#000;" class="uk-flex uk-flex-middle">
                        <?php echo form_radio('scales', set_value('scales', 1), ((isset($_POST['scales']) && $_POST['scales'] == 1 || (isset($event['scales']) && $event['scales'] == 1)) ? true : (!isset($_POST['scales'])) ? true : false),'class=""  id="scales"  style="margin-top:0;margin-right:10px;" '); ?>
                        <label for="scales" style="margin:0;cursor:pointer;">Cho phép gửi minh chứng</label>
                     </span>
                  </div>
               </div>
               <div class="block clearfix">
                  <div class="i-checks" style="width:100%;">
                     <span style="color:#000;" class="uk-flex uk-flex-middle">
                        <?php echo form_radio('scales', set_value('scales', 0), ((isset($_POST['scales']) && $_POST['scales'] == 0 || (isset($event['scales']) && $event['scales'] == 0)) ? true : false),'class=""   id="no-scales" style="margin-top:0;margin-right:10px;" '); ?>

                        <label for="no-scales" style="margin:0;cursor:pointer;">Không cho phép gửi minh chứng</label>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="ibox mb20">
   <div class="ibox-title">
      <h5 class="choose-image" style="cursor: pointer;">Ảnh đại diện </h5>
   </div>
   <div class="ibox-content">
      <div class="row">
         <div class="col-lg-12">
            <div class="form-row">
               <div class="avatar" style="cursor: pointer;"><img src="<?php echo (isset($_POST['image'])) ? $_POST['image'] : ((isset($event['image']) && $event['image'] != '') ? $event['image'] : 'public/not-found.png') ?>" class="img-thumbnail" alt=""></div>
               <?php echo form_input('image', htmlspecialchars_decode(html_entity_decode(set_value('image', (isset($event['image'])) ? $event['image'] : 'public/not-found.png'))), 'class="form-control " placeholder="Đường dẫn của ảnh"  id="imageTxt"  autocomplete="off" style="display:none;" ');?>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="ibox mb20">
   <div class="ibox-title">
      <h5>Hiển thị</h5>
   </div>
   <div class="ibox-content">
      <div class="row">
         <div class="col-lg-12">
            <div class="form-row">
               <div class="text-warning mb15">Quản lý thiết lập hiển thị.</div>
               <div class="block clearfix">
                  <div class="i-checks mr30" style="width:100%;">
                     <span style="color:#000;" class="uk-flex uk-flex-middle">
                        <?php echo form_radio('publish', set_value('publish', 1), ((isset($_POST['publish']) && $_POST['publish'] == 1 || (isset($event['publish']) && $event['publish'] == 1)) ? true : (!isset($_POST['publish'])) ? true : false),'class=""  id="publish"  style="margin-top:0;margin-right:10px;" '); ?>
                        <label for="publish" style="margin:0;cursor:pointer;">Cho phép hiển thị trên website</label>
                     </span>
                  </div>
               </div>
               <div class="block clearfix">
                  <div class="i-checks" style="width:100%;">
                     <span style="color:#000;" class="uk-flex uk-flex-middle">
                        <?php echo form_radio('publish', set_value('publish', 0), ((isset($_POST['publish']) && $_POST['publish'] == 0 || (isset($event['publish']) && $event['publish'] == 0)) ? true : false),'class=""   id="no-publish" style="margin-top:0;margin-right:10px;" '); ?>

                        <label for="no-publish" style="margin:0;cursor:pointer;">Không cho phép hiển thị trên website</label>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
