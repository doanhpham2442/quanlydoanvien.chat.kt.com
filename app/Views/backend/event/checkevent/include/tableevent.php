
<table class="table table-striped table-bordered table-hover dataTables-example">
   <thead>
       <tr>
           <th style="width: 35px;">
               <input type="checkbox" id="checkbox-all">
               <label for="check-all" class="labelCheckAll"></label>
           </th>
           <th >ID</th>
           <th >Minh chứng</th>
           <th class="text-center" style="width: 67px;">Mã Sinh viên</th>
           <th class="text-center" style="width: 180px;">Họ Tên</th>
           <th class="" style="width: 250px;">Đơn vị</th>
           <th class="text-center" style="width: 150px;">Ngày gửi</th>
           <th class="text-center" style="width: 100px;">Trạng thái</th>
           <th class="text-center" style="width:103px;">Duyệt minh chứng</th>
       </tr>
   </thead>
   <tbody>

       <?php if(isset($eventUser['list']) && is_array($eventUser['list']) && count($eventUser['list'])){ ?>
       <?php foreach($eventUser['list'] as $key => $val){ ?>
       <?php
           $status = ($val['publish'] == 2) ? '<span class="text-success">Đã Duyệt</span>'  : (($val['publish'] == 3) ? '<span class="text-danger">Bị Loại</span>':'<span class="text-warning">Chờ Duyệt</span>');
           $image = ($val['image']) ? getthumb($val['image'])  :  'public/not-found.png';
       ?>

       <tr id="post-<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>" class = "tr-event">
           <td>
               <input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
               <div for="" class="label-checkboxitem"></div>
           </td>
           <td><?php echo $val['id']; ?></td>
           <td>
               <div class="uk-flex uk-flex-middle">
                   <div class="image mr5">
                   <a href="<?php echo $image; ?>" data-gallery="" class="image-post img-scaledown"><img src="<?php echo $image; ?>" alt="<?php echo $val['title_event']; ?>" /></a>
                   </div>
                   <div class="main-info">
                       <div class="catalogue" style="font-size:10px">
                           <span style="color:#f00000;">Ghi chú: </span>
                           <span ><?php echo $val['note']; ?> </span>
                           
                       </div>
                   </div>
               </div>
           </td>
           <td class="text-center text-primary">
                <?php echo $val['id_student'];?>
           </td>
           <td class="text-center text-primary">
                <?php echo $val['fullname'];?>
           </td>
           <td class=" text-primary">
                <?php echo $val['name_class'];?>
                <br>
                <?php echo $val['name_faculty'];?>
           </td>
           <td class="text-center text-primary">
                <?php echo gettime($val['created_at'],'H:i - d/m/Y');?>
           </td>
           <td class="text-center event-status" ><?php echo $status; ?></td>
           <td class="text-center">
               <a type="button" href="" class="btn btn-primary check-event event-accept" data-field="publish" data-where ="2" data-id="<?php echo $val['id'];?>"><i class="fa fa-check"></i></a>
               <a data-toggle="modal" type="button" href="#modal-form-<?php echo $val['id'];?>" class="btn btn-danger"><i class="fa fa-times-circle-o"></i></a>
               <div id="modal-form-<?php echo $val['id'];?>" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <h3 class="">Không duyệt minh chứng của: "<?php echo $val['fullname']?>"</h3>
                                    <h3 class="">Mã SV: <?php echo $val['id_student']?> </h3>
                                    <div class="form">
                                        <div class="form-group">
                                            <input type="text" placeholder="Nhập lí do" class="form-control note-reviewer">
                                        </div>
                                        <div class = "pull-right">
                                            <a class="btn btn-primary event-ignore" type="submit" data-field="publish" data-where ="3" data-id="<?php echo $val['id'];?> "data-dismiss="modal">Xác nhận</a>
                                            <a class="btn btn-warning" data-dismiss="modal" type="submit">Hủy</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

