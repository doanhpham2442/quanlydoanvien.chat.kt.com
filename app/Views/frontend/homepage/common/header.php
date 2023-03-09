<?php echo view(route('frontend.homepage.common.canvas')) ?>
<header class="pc-header" >
      <div class="upper">
        <div class="uk-container uk-container-center">
          <div class="uk-flex uk-flex-space-between uk-flex-middle">
            <form action="/tim-kiem.html" method="get" class="uk-form form">
              <input type="text" value="" name="keyword" placeholder="Nhập từ khóa để tìm kiếm ..." style="width: 17vw; border-radius: 5px;" class="input-text">
              <input type="submit" value="Search" name="search" class="btn-submit btn-search-header">
            </form>
            <ul class="uk-list uk-clearfix sitelink">
              <li>
                <a href="lich-tuan.html" title="Lịch tuần">Lịch tuần</a>
              </li>
              <li>
                <a href="lien-he.html" title="Liên Hệ">Liên Hệ</a>
              </li>
              <li>
                <a href="hop-tac.html" title="Hợp tác">Hợp tác</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- .upper -->
      <div class="middle">
        <div class="uk-container uk-container-center">
          <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <h1 class="hd-logo">
              <a href="index.html" title="logo đoàn" class ="img-scaledown">
                <img src="<?php echo $general['homepage_logo'] ?>" alt="logo đoàn" class="lazyloading">
              </a>
            </h1>
            <div class="uk-flex uk-flex-middle">
              <ul class="uk-navbar-nav uk-clearfix main-menu uk-flex uk-flex-middle">
                <li>
                  <a href="index.html" title="Trang chủ">Trang chủ</a>
                </li>
                <li>
                  <a href="chuong-trinh-su-kien.html" title="Chương trình, sự kiện">Chương trình, sự kiện</a>
                </li>
                <li>
                  <a href="bai-viet.html" title="Bài viết">Bài viết</a>
                </li>
                <!-- <li>
                  <a href="diem-ren-luyen.html" title="Điểm rèn luyện">Điểm rèn luyện</a>
                </li> -->
                <!-- <li>
                  <a href="admin" title="Trang quản lý">Trang quản lý</a>
                </li> -->
                <!-- <li>
                  
                </li> -->
                <li>
                  <a href="" title="Đơn vị trực thuộc" onclick="return false;" >Đơn vị trực thuộc</a>
                  <div class="dropdown-menu" style="min-width: 250px;">
                    <ul class="uk-list submenu">
                    <?php if(isset($faculties) && is_array($faculties) && count($faculties)){ ?>
                      <?php foreach ($faculties as $key => $val) {?>
                      <li>
                        <a href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>
                      </li>
                      <?php }} ?>
                    </ul>
                  </div>
                </li>
              </ul>
              <div class="account-login">
                <?php if(isset($_COOKIE['QLDVKT_backend'])){ ?>
                  <div class="account">
                  <div class="uk-flex uk-flex-middle">
                    <div class="thumb img-cover" style = 'height:50px;width:50px;margin-right:10px'>
                      <img style = 'border-radius:50%' src="<?php echo (isset($user['image']) && $user['image'] == '')?'upload/image/base_avt.png': $user['image'] ?>" alt="">
                    </div>
                    <div class="info">
                      <span><strong><?php echo $user['fullname'] ?></strong></span>
                      <br>
                      <span><?php echo $user['name_cat'] ?></span>
                    </div>
                  </div>
                  <div class="dropdown-menu">
                    <ul class="uk-list submenu">
                      <li>
                        <a href="admin" title="Trang quản lý">Trang quản lý</a>
                      </li>
                      <li>
                        <a href="thong-tin-ca-nhan.html" title="sửa thông tin">Cập nhật thông tin cá nhân</a>
                      </li>
                      <li>
                        <a href="diem-ren-luyen.html" title="Điểm rèn luyện">Điểm rèn luyện</a>
                      </li>
                      <li>
                        <a href="#my-change" data-uk-modal="" title="đổi mật khẩu">Đổi mật khẩu</a>
                      </li>
                      <li>
                        <a href="frontend/authentication/auth/logout"  title="Đăng xuất">Đăng xuất</a>
                      </li>
                    </ul>
                  </div>
                </div>
                  <?php }else{ ?>
                  <div class="login">
                    <a href="#my-login" data-uk-modal="" class="btn-reg" title="Đăng nhập">Đăng nhập</a>
                  </div>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>    
</header>

  <div class="header-mobile header-wrapper">
      <div class="uk-container uk-container-center">
          <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="header-canvas button-item">
                <a href="#" title="menu">
                  <i class="fa fa-bars" aria-hidden="true"></i>
                </a>
            </div>
            <div class="logo">
              <a href="#" title="logo" class="img-cover">
                <img src="upload/image/logo/logodoan.png" alt="">
              </a>
            </div>
            <div class="button-login">
              <a href="#my-form" data-uk-modal title="đăng nhập">Đăng nhập</a>
            </div>
          </div>
      </div>
  </div>
  <div id="my-login" class="uk-modal">
      <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <div class="contact-form">
          <h2 class="heading-2">Đăng nhập</h2>
          <form action="frontend/authentication/auth/login" class="uk-form form" method="post">
            <div class="form-row">
              <input type="text" class="input-text" name="email" value="" placeholder="Mã sinh viên hoặc email">
            </div>
            <div class="form-row">
              <input type="password" class="input-text" name="password" value="" placeholder="Mật khẩu">
            </div>
            <div class="form-row">
              <input type="submit" value="Đăng nhập" name="send" class="btn-submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  <div id="my-change" class="uk-modal">
      <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <div class="contact-form">
          <h2 class="heading-2">Đổi mật khẩu</h2>
          <form action="backend/user/profile/frontendchange" class="uk-form form" method="post">
            <div class="form-row">
              <input type="password" class="input-text" name="old-password" value="" placeholder="Mật khẩu cũ">
            </div>
            <div class="form-row">
              <input type="password" class="input-text" name="password" value="" placeholder="Mật khẩu mới">
            </div>
            <div class="form-row">
              <input type="password" class="input-text" name="re_password" value="" placeholder="Nhập lại mật khẩu mới">
            </div>
            <div class="form-row">
              <input type="submit" value="Cập nhật mật khẩu" name="reset" class="btn-submit">
            </div>
          </form>
        </div>
      </div>
    </div>