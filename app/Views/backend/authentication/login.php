<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo BASE_URL; ?>">
    <title><?php echo NAME_TITLE ?></title>
    <link rel="icon" href="upload/image/logo/LOGO-DOAN.png" type="image/png" sizes="30x30">
    <link href="<?php echo ASSET_BACKEND; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ASSET_BACKEND; ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo ASSET_BACKEND; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo ASSET_BACKEND; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo ASSET_BACKEND; ?>css/customize.css" rel="stylesheet">

</head>

<body class="container-fluid login-admin">

    <div class="container-login">
        <div class="row">

            <div class="col-md-3">
                <div class="panel-login">
                    <div class="panel-head">
                        <div class ="img-cover">
                            <img src="upload/image/logo/logodoan.png" alt="">
                        </div>
                        <h2 class="font-bold"><?php echo CMS_NAME ?></h2>
                    </div>
                    <div class="panel-body">
                        <h3 class="title">Thông tin đăng nhập</h3>
                        <?php echo  (!empty($validate) && isset($validate)) ? '<div class="alert alert-danger">'.$validate.'</div>'  : '' ?>
                        <form class="m-t" method="post" action="backend/authentication/auth/login">
                            <div class="form-group mb20">
                                <input type="text" name="email" value="<?php echo set_value('email') ?>" class="form-control" placeholder="Email hoặc Mã sinh viên">
                            </div>
                            <div class="form-group mb20">
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                            </div>
                            <button type="submit" class="btn btn-success block full-width m-b">Đăng nhập</button>
                        </form>
                    </div>
                    <div class="row sub-footer">
                        <div class="col-md-8">
                            <div class="sub-title">
                                <?php echo CMS_NAME ?> <?php echo date('Y'); ?>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <div class="sub-title">
                                <small>© 2022-2023</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel-image img-cover">
                    <img src="upload/image/logo/login2.jpg" alt="">
                </div>
            </div>
        </div>
        
    </div>

</body>

</html>
