<form action="" method="">
    <div class="uk-flex uk-flex-middle uk-flex-space-between mb20">
      <div class="perpage">
        <div class="uk-flex uk-flex-middle">
             <select name="perpage" class="form-control input-sm perpage filter mr20">
                 <?php for($i = 20; $i <= 200; $i+= 20){?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?> bản ghi</option>
                 <?php } ?>
             </select>
        </div>
     </div>
        <div class="toolbox">
           <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div class="uk-width-1-3 mr20">
                    <script>
                        var semester_1_id = '<?php echo (isset($_POST['semester_1_id'])) ? $_POST['semester_1_id'] : ((request()->getGet('semester_1_id')) ? request()->getGet('semester_1_id') : ''); ?>';
                    </script>
                    <?php echo form_dropdown('semester_1_id', $dropdown, set_value('semester_1_id', (request()->getGet('semester_1_id')) ? request()->getGet('semester_1_id') : ''), 'class="form-control " id = "semester_1_id"');?>                
                </div>
                <div class="uk-width-1-3 mr20">
                    <script>
                        var semester_2_id = '<?php echo (isset($_POST['semester_2_id'])) ? $_POST['semester_2_id'] : ((request()->getGet('semester_2_id')) ? request()->getGet('semester_2_id') : ''); ?>'
                    </script>
                    <select name="semester_2_id" id="semester_2_id" class="form-control location ">
                        <option value="0">Chọn Học Kì</option>
                    </select>
                </div>
                <div class="uk-width-1-3 mr20 ">
                    <script>
                        var faculty_id = '<?php echo (isset($_POST['faculty_id'])) ? $_POST['faculty_id'] : ((request()->getGet('faculty_id')) ? request()->getGet('faculty_id') : 0); ?>';
                    </script>
                    <?php echo form_dropdown('faculty_id', $faculty, set_value('faculty_id', (request()->getGet('faculty_id')) ? request()->getGet('faculty_id') : 0), 'class="form-control " id = "faculty" ');?>
                </div>
                <div class="uk-width-1-3 mr20 ">
                    <script>var class_id = '<?php echo (isset($_POST['class_id'])) ? $_POST['class_id'] : ((request()->getGet('class_id')) ? request()->getGet('class_id') : 0); ?>'</script>
                    <select name="class_id" id="class" class="form-control">
                        <option value="0">Chọn Chi Đoàn</option>
                    </select>
                </div>
                <div class="uk-width-1-3 mr20">
                    <div class="input-group">
                       <input type="text" name="keyword" value="<?php echo (request()->getGet('keyword')) ? request()->getGet('keyword') : ''; ?>" placeholder="Nhập từ khóa muốn tìm kiếm ..." class="form-control">
                       <span class="input-group-btn">
                           <button type="submit" name="search" value="search" class="btn btn-success mb0 btn-sm">Tìm Kiếm
                       </button>
                       </span>
                    </div>
                </div>
                <div class="btn-group mr10">
                    <button data-toggle="dropdown" class="btn btn-w-m btn-info dropdown-toggle"> <i class="fa fa-file-excel-o"></i> Excel <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="" class="" id = "btn-export-point"><i class="fa fa-upload"></i> Xuất danh sách được chọn</a>
                        </li>
                        <li>
                            <a href=""  data-page="<?php //echo $page; ?>"  class="" id = "btn-export-point-all"><i class="fa fa-download" aria-hidden="true"></i> Xuất toàn bộ danh sách</a>
                        </li>
                    </ul>
                </div>
           </div>
        </div>
    </div>
</form>
