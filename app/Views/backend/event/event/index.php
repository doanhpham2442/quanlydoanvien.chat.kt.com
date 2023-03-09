<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-8">
      <h2>Quản lý Chương trình, sự kiện</h2>
      <ol class="breadcrumb" style="margin-bottom:10px;">
         <li>
            <a href="<?php echo base_url(route('backend.dashboard.dashboard.index')) ?>">Dashboard</a>
         </li>
         <li class="active"><strong>Quản lý Chương trình, sự kiện</strong></li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh sách Chương trình, sự kiện </h5>
                    <?php echo view(route('backend.event.event.include.toolbox')) ?>
                </div>
                <div class="ibox-content">
                   <?php echo view(route('backend.event.event.include.filter')) ?>
                   <?php echo view(route('backend.event.event.include.table')) ?>

                </div>
            </div>
        </div>
    </div>
</div>
