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
<form method="post" action="" class="form-horizontal box" >
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="box-body">
				<?php echo  (!empty($validate) && isset($validate)) ? '<div class="alert alert-danger">'.$validate.'</div>'  : '' ?>
			</div><!-- /.box-body -->
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox m0">
					<div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<h5>Thông tin chung</h5>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-3">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-row">
											<label class="control-label text-left">
												<span class="choose-image">Ảnh Đại diện (Click để chọn hình ảnh)</span>
											</label>
											 <div class="avatar img-cover" style="cursor: pointer; height: 250px;">
												 <img src="<?php echo (isset($_POST['image'])) ? $_POST['image'] : ((isset($user['image']) && $user['image'] != '') ? $user['image'] : 'public/not-found.png') ?>" class="img-thumbnail" alt="">
											 </div>
											 <?php echo form_input('image', htmlspecialchars_decode(html_entity_decode(set_value('image', (isset($user['image'])) ? $user['image'] : ''))), 'class="form-control " placeholder="Đường dẫn của ảnh"  id="imageTxt"  autocomplete="off" style="display:none;" ');?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-9">
								<div class="row">
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Mã Sinh Viên<b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_input('id_student', set_value('id_student', (isset($user['id_student'])) ? $user['id_student'] : ''), 'class="form-control " placeholder="" autocomplete="off" required');?>
										</div>
									</div>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Họ tên <b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_input('fullname', set_value('fullname', (isset($user['fullname'])) ? $user['fullname'] : ''), 'class="form-control " placeholder="" autocomplete="off" required');?>
										</div>
									</div>
									<div class="col-lg-3 mb5">
										<script>
											var faculty_id = '<?php echo (isset($_POST['faculty_id'])) ? $_POST['faculty_id'] : ((isset($user['faculty_id'])) ? $user['faculty_id'] : ''); ?>';
										</script>
										<div class="form-row">
											<label class="control-label text-left">
												<span>Khoa trực thuộc <b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_dropdown('faculty_id', $faculty, set_value('faculty_id', (isset($user['faculty_id'])) ? $user['faculty_id'] : ''), 'class="form-control m-b " id = "faculty" required');?>
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
											<select name="class_id" id="class" class="form-control m-b location" required>
												<option value="0">Chọn Chi Đoàn</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Email <b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_input('email', set_value('email', (isset($user['email'])) ? $user['email'] : ''), 'class="form-control " placeholder="" autocomplete="off" required');?>
											<?php echo form_hidden('email_original', set_value('email_original', (isset($user['email'])) ? $user['email'] : ''), 'class="form-control " placeholder="" autocomplete="off"');?>
										</div>
									</div>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Nhóm Thành viên <b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_dropdown('user_catalogue_id', $userCatalogue, set_value('user_catalogue_id', (isset($user['user_catalogue_id'])) ? $user['user_catalogue_id'] : ''), 'class="form-control m-b "'.(($idLogin == '1' || $idLogin == '7')?'':'disabled').'' );?>
										</div>	
									</div>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Giới tính</span>
											</label>
											 <?php
		                               echo form_dropdown('gender', GENDER, set_value('gender', (isset($user['gender'])) ? $user['gender'] : -1),'class="form-control mr20 input-sm perpage filter" style="width:100%" required');
		                           ?>
										</div>
									</div>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Ngày sinh <b class="text-danger"></b></span>
											</label>
											<?php echo form_input('birthday', set_value('birthday', (isset($user['birthday'])) ? $user['birthday'] : ''), 'class="form-control datetimepicker" placeholder="" autocomplete="off" required');?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Số điện thoại<b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_input('phone', set_value('phone', (isset($user['phone'])) ? $user['phone'] : ''), 'class="form-control " placeholder="" autocomplete="off" required');?>
										</div>
									</div>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Dân tộc <b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_dropdown('ethnic', $ethnic, set_value('ethnic', (isset($user['ethnic'])) ? $user['ethnic'] : ''), 'class="form-control m-b " required');?>
										</div>
									</div>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Tôn giáo <b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_dropdown('religion', $religion, set_value('religion', (isset($user['religion'])) ? $user['religion'] : ''), 'class="form-control m-b " required');?>
										</div>
									</div>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Nghề nghiệp <b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_dropdown('profession', PROFESSION, set_value('profession', (isset($user['profession'])) ? $user['profession'] : ''), 'class="form-control m-b " required');?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Số CMND/CCCD <b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_input('id_card', set_value('id_card', (isset($user['id_card'])) ? $user['id_card'] : ''), 'class="form-control " placeholder="" autocomplete="off" required');?>
										</div>
									</div>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Ngày cấp <b class="text-danger"></b></span>
											</label>
											<?php echo form_input('date_id_card', set_value('date_id_card', (isset($user['date_id_card'])) ? $user['date_id_card'] : ''), 'class="form-control datetimepicker" placeholder="" autocomplete="off" required');?>
										</div>
									</div>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Nơi cấp <b class="text-danger">(*)</b></span>
											</label>
											<?php echo form_dropdown('issued_id_card', $province, set_value('issued_id_card', (isset($user['issued_id_card'])) ? $user['issued_id_card'] : ''), 'class="form-control m-b " required');?>
										</div>
									</div>
									<?php if(isset($method) && $method == 'create'){ ?>
									<div class="col-lg-3 mb5">
										<div class="form-row">
											<label class="control-label text-left">
												<span>Mật Khẩu <b class="text-danger">(Mặc định là: <?php echo PASSWORD ?>)</b></span>
											</label>
											<?php echo form_input('password', set_value('password', (isset($user['password'])) ? $user['password'] : PASSWORD), ' class="form-control" placeholder="" autocomplete="off"');?>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox m0">
					<div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<h5>Địa chỉ</h5>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-3">
								<script>
									var countryside_cityid = '<?php echo (isset($_POST['countryside_cityid'])) ? $_POST['countryside_cityid'] : ((isset($user['countryside_cityid'])) ? $user['countryside_cityid'] : ''); ?>';
									var countryside_districtid = '<?php echo (isset($_POST['countryside_districtid'])) ? $_POST['countryside_districtid'] : ((isset($user['countryside_districtid'])) ? $user['countryside_districtid'] : ''); ?>'
									var countryside_wardid = '<?php echo (isset($_POST['countryside_wardid'])) ? $_POST['countryside_wardid'] : ((isset($user['countryside_wardid'])) ? $user['countryside_wardid'] : ''); ?>'
								</script>
								<div class="form-row">
									<label class="control-label text-left">
										<span>Quê quán (Tỉnh/Thành Phố)</span>
									</label>
									<?php
										$countryside_city = get_data(['select' => 'provinceid, name','table' => 'vn_province','order_by' => 'order desc, slug asc']);
										$countryside_city = convert_array([
											'data' => $countryside_city,
											'field' => 'provinceid',
											'value' => 'name',
											'text' => 'Thành Phố',
										]);
									?>
									<?php echo form_dropdown('countryside_cityid', $countryside_city, set_value('countryside_cityid', (isset($user['countryside_cityid'])) ? $user['countryside_cityid'] : 0), 'class="form-control m-b city"  id="countryside_city" required');?>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Quê quán (Quận/Huyện)</span>
									</label>
									<select name="countryside_districtid" id="countryside_district" class="form-control m-b location" required>
										<option value="0">Chọn Quận/Huyện</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Quê quán (Phường xã)</span>
									</label>
									<select name="countryside_wardid" id="countryside_ward" class="form-control m-b location" required>
										<option value="0">Chọn Phường/Xã</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Quê quán (Địa chỉ cụ thể)</span>
									</label>
									<?php echo form_input('countryside_address', set_value('countryside_address', (isset($user['countryside_address'])) ? $user['countryside_address'] : ''), 'class="form-control " placeholder="" autocomplete="off" required');?>
								</div>
							</div>
						</div>
						<div class="row mb10">
							<div class="col-lg-3">
								<script>
									var residence_cityid = '<?php echo (isset($_POST['residence_cityid'])) ? $_POST['residence_cityid'] : ((isset($user['residence_cityid'])) ? $user['residence_cityid'] : ''); ?>';
									var residence_districtid = '<?php echo (isset($_POST['residence_districtid'])) ? $_POST['residence_districtid'] : ((isset($user['residence_districtid'])) ? $user['residence_districtid'] : ''); ?>'
									var residence_wardid = '<?php echo (isset($_POST['residence_wardid'])) ? $_POST['residence_wardid'] : ((isset($user['residence_wardid'])) ? $user['residence_wardid'] : ''); ?>'
								</script>
								<div class="form-row">
									<label class="control-label text-left">
										<span>Thường trú (Tỉnh/Thành Phố)</span>
									</label>
									<?php
										$residence_city = get_data(['select' => 'provinceid, name','table' => 'vn_province','order_by' => 'order desc, slug asc']);
										$residence_city = convert_array([
											'data' => $residence_city,
											'field' => 'provinceid',
											'value' => 'name',
											'text' => 'Thành Phố',
										]);
									?>
									<?php echo form_dropdown('residence_cityid', $residence_city, set_value('residence_cityid', (isset($user['residence_cityid'])) ? $user['residence_cityid'] : 0), 'class="form-control m-b city"  id="residence_city" required');?>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Thường trú (Quận/Huyện)</span>
									</label>
									<select name="residence_districtid" id="residence_district" class="form-control m-b location" required>
										<option value="0">Chọn Quận/Huyện</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Thường trú (Phường xã)</span>
									</label>
									<select name="residence_wardid" id="residence_ward" class="form-control m-b location" required>
										<option value="0">Chọn Phường/Xã</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Thường trú (Địa chỉ cụ thể)</span>
									</label>
									<?php echo form_input('residence_address', set_value('residence_address', (isset($user['residence_address'])) ? $user['residence_address'] : ''), 'class="form-control " placeholder="" autocomplete="off" required');?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">

		<div class="col-lg-12">
			<div class="ibox mb30">
				<div class="ibox-title">
					<div class="uk-flex uk-flex-middle uk-flex-space-between">
						<h5>Thông tin chi tiết</h5>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Trình độ văn hóa <b class="text-danger">(*)</b></span>
								</label>
								<?php echo form_dropdown('level_education', LEVEL_EDUCATION, set_value('level_education', (isset($user['level_education'])) ? $user['level_education'] : ''), 'class="form-control m-b " required');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Trình độ chuyên môn</span>
								</label>
								<?php echo form_dropdown('level_specialize', LEVEL_SPECIALIZE, set_value('level_specialize', (isset($user['level_specialize'])) ? $user['level_specialize'] : ''), 'class="form-control m-b "');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Lí luận chính trị</span>
								</label>
								<?php echo form_dropdown('level_politics', LEVEL_POLITICS, set_value('level_politics', (isset($user['level_politics'])) ? $user['level_politics'] : ''), 'class="form-control m-b "');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Tin học</span>
								</label>
								<?php echo form_dropdown('level_computer', LEVEL_COMPUTER, set_value('level_computer', (isset($user['level_computer'])) ? $user['level_computer'] : ''), 'class="form-control m-b "');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Ngoại ngữ</span>
								</label>
								<?php echo form_dropdown('level_language', LEVEL_LANGUAGE, set_value('level_language', (isset($user['level_language'])) ? $user['level_language'] : ''), 'class="form-control m-b "');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Chức vụ Hội</span>
								</label>
								<?php echo form_dropdown('association_position', UNION_POSITION, set_value('association_position', (isset($user['association_position'])) ? $user['association_position'] : ''), 'class="form-control" placeholder="" autocomplete="off"');?>
							</div>
						</div>
					</div>
					<div class="row mb10">
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Ngày vào Đoàn <b class="text-danger">(*)</b></span>
								</label>
								<?php echo form_input('day_in_union', set_value('day_in_union', (isset($user['day_in_union'])) ? $user['day_in_union'] : ''), 'class="form-control datetimepicker" placeholder="" autocomplete="off" required');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Số nghị quyết kết nạp</span>
								</label>
								<?php echo form_input('number_resolution', set_value('number_resolution', (isset($user['number_resolution'])) ? $user['number_resolution'] : ''), 'class="form-control " placeholder="" autocomplete="off"');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Số thẻ Đoàn</span>
								</label>
								<?php echo form_input('number_union', set_value('number_union', (isset($user['number_union'])) ? $user['number_union'] : ''), 'class="form-control " placeholder="" autocomplete="off"');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Sổ Đoàn viên</span>
								</label>
								<?php echo form_dropdown('book_union', YES_OR_NO, set_value('book_union', (isset($user['book_union'])) ? $user['book_union'] : ''), 'class="form-control m-b "');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Ngày vào Đảng</span>
								</label>
								<?php echo form_input('day_in_communist_party', set_value('day_in_communist_party', (isset($user['day_in_communist_party'])) ? $user['day_in_communist_party'] : ''), ' class="form-control datetimepicker" placeholder="" autocomplete="off" ');?>
							</div>
						</div>
						<div class="col-lg-2 mb5">
							<div class="form-row">
								<label class="control-label text-left">
									<span>Chức vụ Đoàn <b class="text-danger">(*)</b></span>
								</label>
								<?php echo form_dropdown('union_position',UNION_POSITION , set_value('union_position', (isset($user['union_position'])) ? $user['union_position'] : ''), 'class="form-control" placeholder="" autocomplete="off"');?>
							</div>
						</div>
					</div>
					<div class="toolbox action clearfix">
						<div class="uk-flex uk-flex-middle uk-button pull-right">
							<button class="btn btn-primary btn-sm" name="create" value="create" type="submit">Lưu lại</button>
						</div>
					</div>
			</div>
		</div>
	</div>
	
</form>

