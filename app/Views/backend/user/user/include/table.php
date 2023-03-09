<!-- <table class=" excel-table footable table table-bordered table-hover dataTables-example toggle-arrow-tiny"> -->
<table class=" excel-table  table table-bordered table-hover dataTables-example toggle-arrow-tiny">
   <thead>
   <tr>
        <th class="noExl">
           <input type="checkbox" id="checkbox-all">
           <label for="check-all" class="labelCheckAll"></label>
        </th>
        <th class="text-center">STT</th>
        <!-- <th data-toggle="true">ID</th> -->
        <th class="text-center">Mã Sinh Viên</th>
        <th class="text-center">Họ Tên</th>
        <th class="text-center">Ngày Sinh</th>
        <th class="text-center">Giới Tính</th>
        <th class="text-center">Đơn vị</th>
        <th class="text-center">Chức vụ</th>
        <!-- <th>Nhóm thành viên</th> -->
        <th class="text-center">Email</th>
        <th class="text-center" class="text-center">Số điện thoại</th>
        <th class="text-center" style="width: 100px;">Tình trạng</th>
        <th class="text-center noExl">Thao tác</th>
   </tr>
   </thead>
   <tbody>
        <?php if(isset($user['list']) && is_array($user['list']) && count($user['list'])){ ?>
        <?php foreach($user['list'] as $key => $val){ ?>
        <?php
           $gender = ($val['gender'] == 2) ? 'Nam' : 'Nữ';
           $fullname = ($val['fullname'] != '') ? $val['fullname'] : '-';
           $status = ($val['publish'] == 1) ? '<span class="text-success">Active</span>'  : '<span class="text-danger">Deactive</span>';
           foreach(UNION_POSITION as $key1 => $val1){
               if($val['union_position'] == $key1){
                  $position = UNION_POSITION[$key1];
               }
           }
        ?>
        <tr id="post-<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>">
           <td class="">
                <input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
                <div for="" class="label-checkboxitem"></div>
           </td>
           <td class="text-center"><?php echo $key+1 ?></td>
           <!-- <td><?php //echo $val['id'] ?></td> -->
           <td><?php echo $val['id_student'] ?></td>
           <td class="text-navy"><?php echo $fullname ?></td>
           <td class="text-center"><?php echo  gettime($val['birthday'],'d/m/Y')?></td>
           <td class="text-center"><?php echo $gender ?></td>
           <td><?php echo $val['name_class'] ?> <br> <?php echo $val['name_faculty'] ?></td>
           <td class="text-center"><?php echo $position?></td>
           <!-- <td><?php //echo $val['name_cat']?></td> -->
           <td ><?php echo $val['email'] ?></td>
           <td class="text-center"><?php echo $val['phone'] ?></td>
           <td class="text-center td-status" data-field="publish" data-module="<?php echo $module; ?>"><?php echo $status; ?></td>
           <td class="text-center ">
                <a type="button" href="" id = "reset_key" class="btn btn-warning" data-id = "<?php echo $val['id'] ?>"><i class="fa fa-key"></i></a>
                <a type="button" href="<?php echo base_url('backend/user/user/update/'.$val['id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a type="button" href="<?php echo base_url('backend/user/user/delete/'.$val['id']) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
           </td>
        </tr>
        <?php }}else{ ?>
           <tr>
                <td colspan="100%"><span class="text-danger">Không có dữ liệu phù hợp...</span></td>
           </tr>
        <?php } ?>
   </tbody>
</table>
<div id="pagination">
   <?php echo (isset($user['pagination'])) ? $user['pagination'] : ''; ?>
</div>


