<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-8">
      <h2><?php echo $title ?></h2>
      <ol class="breadcrumb" style="margin-bottom:10px;">
         <li>
            <a href="<?php echo base_url(route('backend.dashboard.dashboard.index')) ?>">Dashboard</a>
         </li>
         <li class="active"><strong><?php echo $title ?></strong></li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $title ?></h5>
                    <?php echo view(route('backend.event.checkevent.include.toolbox')) ?>
                </div>
                <div class="ibox-content">
                   <?php echo view(route('backend.event.checkevent.include.filter_point_training')) ?>
                   <?php echo view(route('backend.event.checkevent.include.table_point_training')) ?>

                </div>
            </div>
        </div>
    </div>
</div>
