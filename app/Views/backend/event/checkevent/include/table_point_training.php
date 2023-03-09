
<table class="table table-striped table-bordered table-hover dataTables-example">
   <thead>
       <tr>
           <th style="width: 35px;">
               <input type="checkbox" id="checkbox-all">
               <label for="check-all" class="labelCheckAll"></label>
           </th>
           <th style="width: 30px;">ID</th>
           <th class="text-center" style="width: 180px;">Mã Sinh viên</th>
           <th class="text-center" style="width: 180px;">Họ Tên</th>
           <th class="text-center" style="width: 100px;">Giới tính</th>
           <th class="text-center" style="width: 100px;">Ngày sinh</th>
           <th class="" style="width: 250px;">Đơn vị</th>
           <th class="text-center" style="width: 80px;">Số hoạt động tham gia</th>
           <th class="text-center" style="width: 80px;">Tổng số điểm theo hoạt động</th>
           <th class="text-center" style="width: 80px;">Số điểm tối đa</th>
       </tr>
   </thead>
   <tbody>

       <?php if(isset($userEvent['list']) && is_array($userEvent['list']) && count($userEvent['list'])){ ?>
       <?php foreach($userEvent['list'] as $key => $val){ ?>
       <?php
        //    $status = ($val['publish'] == 1) ? '<span class="text-success">Active</span>'  : '<span class="text-danger">Deactive</span>';
        //    $image = ($val['image']) ? getthumb($val['image'])  :  'public/not-found.png';
        $gender = ($val['gender'] == 2) ? 'Nam' : 'Nữ';
       ?>

       <tr id="post-<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>">
           <td>
               <input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
               <div for="" class="label-checkboxitem"></div>
           </td>
           <td><?php echo $val['id']; ?></td>
           <td class="text-center text-primary">
                <?php echo $val['id_student'];?>
           </td>
           <td class="text-center text-primary">
                <?php echo $val['fullname'];?>
           </td>
           <td class="text-center text-primary">
                <?php echo $gender?>
           </td>
           <td class="text-center text-primary">
                <?php echo gettime($val['birthday'],'d/m/Y')?>
           </td>
           <td class=" text-primary">
                <?php echo $val['name_class'];?>
                <br>
                <?php echo $val['name_faculty'];?>
           </td>
           <td class="text-center text-primary">
                <?php echo $val['count_event'];?>
           </td>
           <td class="text-center text-primary">
                <?php echo $val['sum_score'];?>
           </td>
           <td class="text-center text-primary">
                <?php echo ($val['sum_score'] > 15)? '15' : $val['sum_score'];?>
           </td>
       </tr>
       <?php }}else{ ?>
           <tr>
               <td colspan="100%"><span class="text-danger">Không có dữ liệu phù hợp</span></td>
           </tr>
       <?php } ?>
   </tbody>
</table>

<div id="pagination">
   <?php echo (isset($pagination)) ? $pagination : ''; ?>
</div>
