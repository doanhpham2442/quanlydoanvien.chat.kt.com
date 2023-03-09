<!DOCTYPE html>
<html lang="vi-VN">
  <head>
    <base href="<?php echo BASE_URL ?>">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="upload/image/logo/LOGO-DOAN.png" type="image/png" sizes="30x30">
    <title>Trang thông tin Đoàn viên Kiến trúc</title>

    <link href="public/frontend/resources/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="public/frontend/resources/library/css/carousel.css" rel="stylesheet">
    <link href="public/frontend/resources/uikit/css/components/slideshow.min.css" rel="stylesheet">
    <link href="public/frontend/resources/uikit/css/components/accordion.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="public/frontend/resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="public/frontend/resources/uikit/css/uikit.modify.css" rel="stylesheet">
    <link href="public/backend/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="public/frontend/resources/library/css/general.css" rel="stylesheet">
    <link href="public/backend/plugin/jquery-nice-select-1.1.0/css/nice-select.css" rel="stylesheet">

    <link href="public/frontend/resources/style.css?<?php echo time() ?>" rel="stylesheet">
    <link href="public/frontend/resources/canvas.css?<?php echo time() ?>" rel="stylesheet">
    <link href="public/backend/plugin/datetimepicker-master/build/jquery.datetimepicker.min.css" rel="stylesheet">
    <!-- <link href="public/frontend/resources/web.css?<?php //echo time() ?>" rel="stylesheet"> -->

    <link href="public/frontend/resources/plugins/grapesjs/dist/css/grapes.min.css" rel="stylesheet">

    <script src="public/frontend/resources/library/js/jquery.js"></script>
    <script src="public/frontend/resources/uikit/js/uikit.min.js"></script>
  </head>
  <body class="homepage">
    
    <?php echo view(route('frontend.homepage.common.notification')) ?>
    <?php echo view(route('frontend.homepage.common.header')) ?>


    <?php echo view((isset($template)) ? $template : '') ?>
      
    <?php echo view(route('frontend.homepage.common.footer')) ?>
    
    <style>
      .nice-select {
        width: 100%;
        border: 1px solid #818a91;
        height: 30px;
        line-height: 30px;
        padding: 0 15px;
      }

      .uk-modal-close.uk-close {
        background: #fff url(public/close.png) center no-repeat;
        -webkit-background-size: auto;
        -moz-background-size: auto;
        background-size: auto;
      }

      .btn-submit-filter {
        height: 47px;
        border: 0;
        background: #0d509c;
        color: #fff;
        border-radius: 5px;
        width: 100%;
        cursor: pointer;
      }
    </style>
    <script src="public/frontend/resources/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="public/frontend/resources/uikit/js/components/slideshow.min.js"></script>
    <script src="public/backend/js/plugins/toastr/toastr.min.js"></script>
    <script src="public/frontend/resources/plugins/jquery.countdown.min.js"></script>
    <script src="public/frontend/resources/plugins/timeago.js"></script>
    <script src="public/frontend/resources/plugins/jquery_scroll_loading.js"></script>
    <script src="public/frontend/resources/plugins/jquery.lazyload.min.js" type="text/javascript"></script>
    <script src="public/frontend/resources/plugins/jquery.scrollstop.min.js" type="text/javascript"></script>
    <script src="public/frontend/resources/uikit/js/components/slider.min.js" type="text/javascript"></script>
    <script src="public/frontend/resources/uikit/js/components/sticky.min.js" type="text/javascript"></script>
    <script src="public/frontend/resources/plugins/timeago.js"></script>
    <script src="public/frontend/resources/plugins/sweetalert.min.js"></script>
    <script src="public/frontend/resources/plugins.js"></script>
    <script src="public/frontend/resources/cart.js"></script>
    <script src="public/frontend/resources/uikit/js/components/lightbox.min.js"></script>
    
    <script src="public/backend/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="public/backend/plugin/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
    <script src="public/backend/plugin/ckfinder/ckfinder.js"></script>
    <script src="public/backend/library/ckfinder.js"></script>

    <script src="public/frontend/resources/function.js"></script>
    <script src="public/frontend/resources/custom.js"></script>
    <!-- <script src="public/frontend/resources/_function.js"></script> -->
    <script type='text/javascript' src='public/frontend/resources/plugins/bacola/gsap.min.js' ></script>
    <script type='text/javascript' src='public/frontend/resources/plugins/bacola/bundle.js' ></script>
    <script type='text/javascript' src='public/frontend/resources/plugins/bacola/bootstrap.bundle.min.js' ></script>
    <script type='text/javascript' src='public/frontend/resources/plugins/bacola/slick.min.js' ></script>
    
    <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/comment-reply.min.js'></script> -->
    <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/imagesloaded.min.js' ></script> -->
    <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/select2.full.min.js' ></script> -->
    <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/jquery.magnific-popup.min.js' ></script> -->
    <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/perfect-scrollbar.min.js' ></script> -->
    <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/core.min.js' ></script> -->
    <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/mouse.min.js' ></script> -->
    <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/sortable.min.js' ></script> -->
  <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/slider.min.js'></script> -->
  <!-- <script type='text/javascript' src='public/frontend/resources/plugins/bacola/accounting.min.js' ></script> -->
  
  <script src="public/frontend/resources/uikit/js/core/switcher.min.js"></script>
  <script src="public/frontend/resources/uikit/js/core/offcanvas.min.js"></script>
  <script src="public/frontend/resources/uikit/js/components/accordion.min.js"></script>
  
  <script src="public/frontend/resources/plugins/grapesjs/dist/grapes.min.js"></script>
  <script src="public/frontend/resources/grapesjs-custom.js"></script>
  </body>
</html>