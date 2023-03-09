<form action="" method="">
    <div class="uk-flex uk-flex-middle uk-flex-space-between mb20">
        <div class="perpage mr20">
           <div class="uk-flex uk-flex-middle mb10">
            <?php echo form_dropdown('perpage', PERPAGE, set_value('perpage', (request()->getGet('perpage')) ? request()->getGet('perpage') : 20), 'class="form-control " ');?>
           </div>
        </div>
        <div class="toolbox">
           <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div class="filter">
                    <div class="uk-grid uk-grid-collapse " >
                        <?php if($idLogin == '1' || $idLogin == '7'){ ?>
                        <div class="uk-width-1-3 ">
                        <?php echo form_dropdown('user_catalogue_id', $userCatalogue, set_value('user_catalogue_id', (request()->getGet('user_catalogue_id')) ? request()->getGet('user_catalogue_id') : 0), 'class="form-control" style="margin: 0 0 10px 0;"'); ?>
                        </div>
                        <?php } ?>
                        <div class="uk-width-1-3 ">
                            <?php echo form_dropdown('union_position', UNION_POSITION, set_value('union_position', (request()->getGet('union_position')) ? request()->getGet('union_position') : 0), 'class="form-control" style="margin: 0 0 10px 0;"');?>
                        </div>
                        <div class="uk-width-1-3 ">
                            <?php echo form_dropdown('gender', GENDER, set_value('gender', (request()->getGet('gender')) ? request()->getGet('gender') : 0), 'class="form-control" style="margin: 0 0 10px 0;"');?>
                        </div>
                        <div class="uk-width-1-3 ">
                            <script>
                                var faculty_id = '<?php echo (isset($_POST['faculty_id'])) ? $_POST['faculty_id'] : ((request()->getGet('faculty_id')) ? request()->getGet('faculty_id') : 0); ?>';
                            </script>
                            <?php echo form_dropdown('faculty_id', $faculty, set_value('faculty_id', (request()->getGet('faculty_id')) ? request()->getGet('faculty_id') : 0), 'class="form-control " id = "faculty" style="margin: 0 0 10px 0;"');?>
                        </div>
                        <div class="uk-width-1-3 ">
                            <script>var class_id = '<?php echo (isset($_POST['class_id'])) ? $_POST['class_id'] : ((request()->getGet('class_id')) ? request()->getGet('class_id') : 0); ?>'</script>
                            <select name="class_id" id="class" class="form-control" style="margin: 0 0 10px 0;">
                                <option value="0">Chọn Chi Đoàn</option>
                            </select>
                        </div>
                        <div class="uk-width-1-3">

                        </div>
                    </div>
                </div>
                    
                <div class="uk-search uk-flex uk-flex-middle mr10">
                    <div class="input-group">
                        <input
                           type="text"
                           name="keyword"
                           value="<?php echo (request()->getGet('keyword')) ? request()->getGet('keyword') : ''; ?>" placeholder="Nhập Từ khóa bạn muốn tìm kiếm..."
                           class="form-control"
                        >
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
                            <a href="<?php echo base_url(route('backend.user.user.createexcel')) ?>" class=""><i class="fa fa-upload"></i> Thêm danh sách mới</a>
                        </li>
                        <li>
                            <a href="" class="" id = "btn-export-user"><i class="fa fa-download" aria-hidden="true"></i> Xuất danh sách được chọn</a>
                        </li>
                        <li>
                            <a href=""  data-page="<?php echo $page; ?>"  class="" id = "btn-export-user-all"><i class="fa fa-download" aria-hidden="true"></i> Xuất toàn bộ danh sách</a>
                        </li>
                    </ul>
                </div>
                <div class="uk-button mr10">
                    <a href="<?php echo base_url(route('backend.user.user.create')) ?>" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Thêm thành viên mới</a>
                </div>
           </div>
        </div>
    </div>
</form>
