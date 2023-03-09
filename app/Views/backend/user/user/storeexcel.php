<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?php echo $title; ?></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url('admin'); ?>">Home</a>
			</li>
			<li class="active"><strong><?php echo $title; ?></strong></li>
		</ol>
	</div>
</div>
<form method="post" action="" class="form-horizontal box" enctype="multipart/form-data">
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="box-body">
				<?php  echo  (!empty($validate) && isset($validate)) ? '<div class="alert alert-danger">'.$validate.'</div>'  : '' ?>
			</div><!-- /.box-body -->
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel-head">
					<h2 class="panel-title">Thêm Danh sách Đoàn viên</h2>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="ibox m0">
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-3 mb5">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Chọn file Excel <b class="text-danger">(*)</b></span>
									</label>
									<div class="fileinput fileinput-new input-group" data-provides="fileinput">
										<div class="form-control" data-trigger="fileinput">
											<i class="glyphicon glyphicon-file fileinput-exists"></i>
										<span class="fileinput-filename"></span>
										</div>
										<span class="input-group-addon btn btn-default btn-file">
											<span class="fileinput-new">Chọn File</span>
											<span class="fileinput-exists">Thay đổi</span>
											<input type="file" name="file" accept=".xlsx"/>
										</span>
										<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
									</div> 
									<span>Nếu chưa có file excel chuẩn bấm <a href="public/base_excel.xlsx">Tải xuống</a> </span>
								</div>
							</div>
							<div class="col-lg-3 mb5">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Khoa trực thuộc <b class="text-danger">(*)</b></span>
									</label>
									<script>
										var faculty_id = '<?php echo (isset($_POST['faculty_id'])) ? $_POST['faculty_id'] : ((isset($user['faculty_id'])) ? $user['faculty_id'] : ''); ?>';
									</script>
									<?php echo form_dropdown('faculty_id', $faculty, set_value('faculty_id', (isset($user['faculty_id'])) ? $user['faculty_id'] : ''), 'class="form-control m-b " id = "faculty"');?>
								</div>
							</div>
							<div class="col-lg-3 mb5">
								<div class="form-row">
								<script>
									var class_id = '<?php echo (isset($_POST['class_id'])) ? $_POST['class_id'] : ((isset($user['class_id'])) ? $user['class_id'] : ''); ?>'
								</script>
									<label class="control-label text-left">
										<span>Chi Đoàn trực thuộc <b class="text-danger">(*)</b></span>
									</label>
									<select name="class_id" id="class" class="form-control m-b location">
										<option value="0">Chọn Chi Đoàn</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3 mb5">
								<label class="control-label text-left">
									<span> &nbsp;</span>
								</label>
								<div class="toolbox action ">
									<div class="uk-button">
										<button style="width: 100%;" class="btn btn-primary btn-sm" name="create" value="create" type="submit">Lưu lại</button>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</form>

