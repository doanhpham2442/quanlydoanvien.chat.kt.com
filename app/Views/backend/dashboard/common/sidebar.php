<nav class="navbar-default navbar-static-side" role="navigation">
   <?php
      $user = authentication();
      $uri = service('uri');
      $uri = current_url(true);
      $uriModule = $uri->getSegment(2);
      $uriModule_name = $uri->getSegment(3);
      $baseController = new App\Controllers\BaseController();
      // dd($uri);
      $language = $baseController->currentLanguage();
   ?>
   <div class="sidebar-collapse">
      <ul class="nav metismenu" id="side-menu">
         <li class="nav-header">
            <div class="logo-back">
              <a href="index.html" title="logo đoàn" class="img-scaledown">
                <img src="upload/image/logo/logodoan.png" alt="logo đoàn" class="lazyloading">
              </a>
            </div>
         </li>
         <li class="<?php echo ( $uriModule == 'dashboard') ? 'active'  : '' ?>">
            <a href="<?php echo base_url(route('backend.dashboard.dashboard.index')) ?>"><i class="fa fa-bar-chart-o" aria-hidden="true"></i> <span class="nav-label">Thống kê</span></a>
         </li>
         <li class="<?php echo ( $uriModule == 'organization') ? 'active'  : '' ?>">
            <a href="index.html"><i class="fa fa-users" aria-hidden="true"></i> <span class="nav-label">QL Tổ Chức</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li class="<?php echo ( $uriModule_name == 'faculty') ? 'active'  : '' ?>"><a href="<?php echo base_url(route('backend.organization.faculty.index')) ?>">QL Liên Chi Đoàn</a></li>
               <li class="<?php echo ( $uriModule_name == 'branch') ? 'active'  : '' ?>"><a href="<?php echo base_url(route('backend.organization.branch.index')) ?>">QL Chi Đoàn</a></li>
            </ul>
         </li>
         <li class="<?php echo ( $uriModule == 'user') ? 'active'  : '' ?>">
            <a href="index.html"><i class="fa fa-user" aria-hidden="true"></i> <span class="nav-label">Quản lý User</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li class="<?php echo ( $uriModule_name == 'catalogue') ? 'active'  : '' ?>"><a href="<?php echo base_url('backend/user/catalogue/index') ?>">Nhóm Thành Viên</a></li>
               <li class="<?php echo ( $uriModule_name == 'user') ? 'active'  : '' ?>"><a href="<?php echo base_url('backend/user/user/index') ?>">Thành viên</a></li>
            </ul>
         </li>
         <li class="<?php echo ( $uriModule == 'event') ? 'active'  : '' ?>">
            <a href="index.html"><i class="fa fa-sitemap" aria-hidden="true"></i> <span class="nav-label">QL Hoạt Động</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li class="<?php echo ( $uriModule_name == 'semester') ? 'active'  : '' ?>"><a href="<?php echo base_url(route('backend.event.semester.index')) ?>">QL Học Kỳ</a></li>
               <li class="<?php echo ( $uriModule_name == 'event') ? 'active'  : '' ?>"><a href="<?php echo base_url(route('backend.event.event.index')) ?>">QL Chương Trình, Sự Kiện</a></li>
            </ul>
         </li>
         <li class="<?php echo ( $uriModule == 'checkevent') ? 'active'  : '' ?>">
            <a href="index.html"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span class="nav-label">Điểm rèn luyện</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li class="<?php echo ( $uriModule_name == 'checkevent') ? 'active'  : '' ?>"><a href="<?php echo base_url(route('backend.checkevent.checkevent.index')) ?>">Duyệt minh chứng</a></li>
               <li class="<?php echo ( $uriModule_name == 'checkpoint') ? 'active'  : '' ?>"><a href="<?php echo base_url(route('backend.checkevent.checkpoint.index')) ?>">Điểm rèn luyện</a></li>
            </ul>
         </li>
         <li class="<?php echo ( $uriModule == 'article') ? 'active'  : '' ?>">
            <a href="index.html"><i class="fa fa-file"></i> <span class="nav-label">QL Bài Viết</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li class="<?php echo ( $uriModule_name == 'catalogue') ? 'active'  : '' ?>"><a href="<?php echo base_url('backend/article/catalogue/index') ?>">QL Nhóm Bài Viết</a></li>
               <li class="<?php echo ( $uriModule_name == 'article') ? 'active'  : '' ?>"><a href="<?php echo base_url('backend/article/article/index') ?>">QL Bài Viết</a></li>
            </ul>
         </li>
         <li class="<?php echo ( $uriModule == 'slide') ? 'active'  : '' ?>">
            <a href="<?php echo base_url(route('backend.slide.slide.index')) ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> <span class="nav-label">QL Slide</span></a>
         </li>
         <li class="<?php echo ( $uriModule == 'chat') ? 'active'  : '' ?>">
            <a href="<?php echo base_url(route('backend.chat.chat.index')) ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> <span class="nav-label">QL chat</span></a>
         </li>
         <!-- <li class="<?php //echo ( $uriModule == 'language') ? 'active'  : '' ?>">
            <a href="<?php //echo base_url(route('backend.language.language.index')) ?>"><i class="fa fa-language" aria-hidden="true"></i> <span class="nav-label">QL Ngôn ngữ</span></a>
         </li> -->
         
         <li class="<?php echo ( $uriModule == 'system') ? 'active'  : '' ?>">
            <a href="<?php echo base_url(route('backend.system.general.index')) ?>"><i class="fa fa-cog" aria-hidden="true"></i> <span class="nav-label">Cài đặt chung</span></a>
         </li>
      </ul>
   </div>
</nav>
