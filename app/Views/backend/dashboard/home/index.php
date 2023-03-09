<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    <?php if(isset($users) && is_array($users) && count($users)){ ?>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <!-- <span class="label label-success pull-right">Monthly</span> -->
                    <h5>Đoàn viên đang quản lý</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $users['count_user'] ?></h1>
                    <small>Đoàn viên</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Liên chi Đoàn đang quản lý</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $users['count_faculty'] ?></h1>
                    <small>Liên chi Đoàn</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Chi Đoàn đang quản lý</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $users['count_class'] ?></h1>
                    <small>Chi Đoàn</small>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Số lượng Đoàn viên theo Liên chi Đoàn</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="morris-bar-chart-1"></div>
                </div>
            </div>
        </div>
        <?php if($user_cat_id == 8 || $user_cat_id == 9){}else{ ?>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Số lượng chi Đoàn thuộc Liên chi Đoàn</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="morris-bar-chart-2"></div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Số lượng Đoàn viên theo giới tính</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="morris-bar-chart-3"></div>
                </div>
            </div>
        </div>
        <?php if($user_cat_id == 8 || $user_cat_id == 9){}else{ ?>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Số lượng Chương trình, sự kiện</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="morris-bar-chart-4"></div>
                </div>
            </div>
        </div>
        <?php } ?>
<script>
    $(function() {
        <?php if(isset($userClass) && is_array($userClass)){ ?>
            var class_user = <?php echo json_encode($userClass) ?>;
        <?php } ?>
        var faculty = <?php echo json_encode($userFaculty) ?>;
        var semester = <?php echo json_encode($userEvent) ?>;
        // var data1 = faculty.map(function(item) {
        //     return { y: item['short_title'], a: parseInt(item['count_user']) };
        // });
    <?php if($user_cat_id == 8 || $user_cat_id == 9){ ?>
        Morris.Bar({
            element: 'morris-bar-chart-1',
            data: class_user,
            xkey: 'name_class',
            ykeys: ['count_user'],
            labels: ['Số Đoàn viên'],
            hideHover: 'auto',
            resize: true,
            barColors: ['#36a2eb'],
        });
        Morris.Bar({
            element: 'morris-bar-chart-3',
            data: class_user,
            xkey: 'name_class',
            ykeys: ['count_user_man', 'count_user_girl'],
            labels: ['Nam', 'Nữ'],
            hideHover: 'auto',
            resize: true,
            barColors: ['#36a2eb', '#ff6384'],
        });
    <?php
    }else{
    ?>
        Morris.Bar({
            element: 'morris-bar-chart-1',
            data: faculty,
            xkey: 'short_title',
            ykeys: ['count_user'],
            labels: ['Số Đoàn viên'],
            hideHover: 'auto',
            resize: true,
            barColors: ['#36a2eb'],
        });
        Morris.Bar({
            element: 'morris-bar-chart-2',
            data: faculty,
            xkey: 'short_title',
            ykeys: ['count_class'],
            labels: ['Chi Đoàn'],
            hideHover: 'auto',
            resize: true,
            barColors: ['#36a2eb'],
        });
        Morris.Bar({
            element: 'morris-bar-chart-3',
            data: faculty,
            xkey: 'short_title',
            ykeys: ['count_user_man', 'count_user_girl'],
            labels: ['Nam', 'Nữ'],
            hideHover: 'auto',
            resize: true,
            barColors: ['#36a2eb', '#ff6384'],
        });
        Morris.Bar({
            element: 'morris-bar-chart-4',
            data: semester,
            xkey: 'title_semester',
            ykeys: ['count_event', 'count_checkevent','count_checkevent_succsess'],
            labels: ['Sự kiện', 'Minh chứng đã gửi', 'Minh chứng đã duyệt'],
            hideHover: 'auto',
            resize: true,
            barColors: ['#36a2eb', '#ff6384', '#1ab394'],
        });
    <?php } ?>


});


</script>