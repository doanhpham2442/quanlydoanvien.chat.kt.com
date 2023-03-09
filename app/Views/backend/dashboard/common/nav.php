<?php
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();

    $user = authentication();
      $uri = service('uri');
      $uri = current_url(true);
      $uriModule = $uri->getSegment(2);
      $uriModule_name = $uri->getSegment(3);
?>
<div class="row">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-outline btn-success " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="nav-header-right">
                <div class="container" style="width: 100%;">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-4">
                            <span class = "img-cover"><img alt="image" class="img-circle" src="<?php echo (isset($user['image']) && $user['image'] == '')?'upload/image/base_avt.png': $user['image'] ?>" style="min-width:48px;height:48px;" /></span>
                        </div>
                        <div class="col-lg-8">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo site_url('profile') ?>">
                            <span class="clear">
                                <span class="block m-t-xs mb0"> <strong class="font-bold"><?php echo $user['fullname'] ?></strong>
                            </span>
                            <span class="text-muted text-xs block mb0"><?php echo $user['job'] ?> <b class="caret" style="color: #8095a8"></b></span> </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="<?php echo base_url('backend/user/profile/profile/'.$user['id']) ?>">Đổi mật khẩu</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url('backend/user/user/update/'.$user['id']) ?>">Cập nhật thông tin</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url('backend/authentication/auth/logout') ?>">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

    </nav>
</div>
