<table class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
    <tr>
        <th style="width: 35px;">
           <input type="checkbox" id="checkbox-all">
           <label for="check-all" class="labelCheckAll"></label>
        </th>
        <th >Tên Học Kỳ</th>
        <th class="text-center" style="width: 200px;">Ngày bắt đầu</th>
        <th class="text-center" style="width: 200px;">Ngày kết thúc</th>
        <th style="width:150px;">Người tạo</th>
        <th style="width:150px;" class="text-center">Ngày tạo</th>
        <th class="text-center" style="width:88px;">Tình Trạng</th>
        <th class="text-center" style="width:103px;">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        <?php if(isset($semester['list']) && is_array($semester['list']) && count($semester['list'])){ ?>
            <?php foreach($semester['list'] as $key => $val){ ?>
            <?php
                $status = ($val['publish'] == 1) ? '<span class="text-success">Active</span>'  : '<span class="text-danger">Deactive</span>';
            ?>

        <tr id="post-<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>">
           <td>
                <input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
                <div for="" class="label-checkboxitem"></div>
           </td>
           <!-- <td>
                <div class="uk-flex uk-flex-middle">
                   <div class="main-info">
                       <div class="title"><a class="maintitle" href="<?php //echo site_url('backend/event/event/index/?semester_id='.$val['id']); ?>" title=""><?php echo $val['title']; ?> </a></div>
                       
                   </div>
               </div>
            </td> -->
            <td <?php echo ($val['level'] == 1) ? 'class="text-success text-bold"' : '' ?>>
                <a href="<?php echo base_url('backend/event/event/index/?semester_id='.$val['id']) ?>">
                    <?php echo str_repeat('|----', (($val['level'] > 0)?($val['level'] - 1):0)).$val['title']; ?>
                </a>
            </td>

           <td class="text-center text-primary">
                <?php echo gettime($val['day_start'],'d/m/Y');?>
           </td>
           <td class="text-center text-primary">
                <?php echo gettime($val['day_end'],'d/m/Y');?>
           </td>
           <td class="text-primary"><?php echo $val['creator']; ?></td>
           <td class="text-center text-primary"><?php echo gettime($val['created_at'],'d/m/Y') ?></td>
           <td class="text-center td-status" data-field="publish" data-module="<?php echo $module; ?>" data-where="id"><?php echo $status; ?></td>
           <td class="text-center">
                <a type="button" href="<?php echo base_url('backend/event/semester/update/'.$val['id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a type="button" href="<?php echo base_url('backend/event/semester/delete/'.$val['id']) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
           </td>
        </tr>
        <?php }}else{ ?>
           <tr>
                <td colspan="100%"><span class="text-danger">Không tìm thấy dữ liệu phù hợp</span></td>
           </tr>
        <?php } ?>
    </tbody>
</table>
<div id="pagination">
    <?php echo (isset($faculty['pagination'])) ? $faculty['pagination'] : ''; ?>
</div>
