<table class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
    <tr>
        <th style="width: 35px;">
           <input type="checkbox" id="checkbox-all">
           <label for="check-all" class="labelCheckAll"></label>
        </th>
        <th >Tên Liên chi Đoàn</th>
        <th class="text-center" style="width: 200px;">Năm thành lập</th>
        <th style="width:150px;">Người tạo</th>
        <th style="width:150px;" class="text-center">Ngày tạo</th>
        <th class="text-center" style="width:88px;">Tình Trạng</th>
        <th class="text-center" style="width:103px;">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        <?php if(isset($faculty['list']) && is_array($faculty['list']) && count($faculty['list'])){ ?>
            <?php foreach($faculty['list'] as $key => $val){ ?>
            <?php
                $status = ($val['publish'] == 1) ? '<span class="text-success">Active</span>'  : '<span class="text-danger">Deactive</span>';
                $image = ($val['image']) ? getthumb($val['image'])  :  'public/not-found.png';
            ?>

        <tr id="post-<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>">
           <td>
                <input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
                <div for="" class="label-checkboxitem"></div>
           </td>
           <td>
                <div class="uk-flex uk-flex-middle">
                   <div class="image mr5">
                       <span class="image-post img-scaledown"><img src="<?php echo $image; ?>" alt="<?php echo $val['title']; ?>" /></span>
                   </div>
                   <div class="main-info">
                       <div class="title"><a class="maintitle" href="<?php echo site_url('backend/organization/branch/index/?faculty_id='.$val['id']); ?>" title=""><?php echo $val['title']; ?> </a></div>
                       
                   </div>
               </div>
            </td>

           <td class="text-center text-primary">
                <?php echo gettime($val['founding'],'d/m/Y');?>
           </td>
           <td class="text-primary"><?php echo $val['creator']; ?></td>
           <td class="text-center text-primary"><?php echo gettime($val['created_at'],'d/m/Y') ?></td>
           <td class="text-center td-status" data-field="publish" data-module="<?php echo $module; ?>" data-where="id"><?php echo $status; ?></td>
           <td class="text-center">
                <a type="button" href="<?php echo base_url('backend/organization/faculty/update/'.$val['id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a type="button" href="<?php echo base_url('backend/organization/faculty/delete/'.$val['id']) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
