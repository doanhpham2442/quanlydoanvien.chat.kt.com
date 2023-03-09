<div class="page-body">
      <section class="breadcrumb-panel">
        <div class="uk-container-center uk-container">
          <ul class="uk-breadcrumb uk-clearfix ">
            <li class="breadcrumb-home">
              <a href="index.html">
                <i class="fa fa-home"></i> Trang chủ </a>
            </li>
            <li class="">
              <a href="<?php echo $event['canonical'].HTSUFFIX ?>">
                <span><?php echo $event['title'] ?></span>
              </a>
            </li>
          </ul>
        </div>
      </section>
      <div class="page-container">
        <div class="uk-container uk-container-center">
          <div class="uk-grid uk-grid-medium">
            <div class="uk-width-large-1-4">
              <?php  ?>
              <div class="contact-form mb30">
                <h2 class="heading-2">Gửi minh chứng tham gia</h2>
                
                <?php  if(isset($_COOKIE['QLDVKT_backend']) && $event['scales'] == 1){ ?>
                <form action="" class="uk-form form reg-form mb20" method="post">
                  <div class="form-row">
                      <label class="control-label text-left">
                          <span class="choose-image">Ảnh Minh chứng (Click để chọn hình ảnh)</span>
                      </label>
                      <div class="avatar img-cover" style="cursor: pointer; height: 250px;">
                          <img src="<?php echo (isset($_POST['image'])) ? $_POST['image'] : 'public/_not-found.png' ?>" class="img-thumbnail" alt="">
                      </div>
                      <?php echo form_input('image', htmlspecialchars_decode(html_entity_decode(set_value('image',''))), 'class="form-control " placeholder="Đường dẫn của ảnh"  id="imageTxt"  autocomplete="off" style="display:none;" ');?>
                  </div>
                  <div class="form-row">
                    <input type="text" class="input-text" name="note" value="" placeholder="Ghi chú">
                    <input type="hidden" class="input-text" name="event_id" value="<?php echo $event['id'] ?>" placeholder="Ghi chú">
                  </div>
                  <div class="form-row">
                    <input type="submit" class="btn-submit" value="Gửi minh chứng" name="send">
                  </div>
                </form>
                <?php }else if (isset($event['scales']) && $event['scales'] == 0){?>
                  <div class="heading-2" style="color:hsl(0,75%,60%);">Chưa đến thời gian hoặc thời gian gửi minh chứng đã hết !</div>
                <?php
                 }else{?>
                  <div class="heading-2" style="color:hsl(0,75%,60%);">Bạn cần đăng nhập để gửi minh chứng !</div>
                <?php
                }
                ?>
                <?php if(isset($eventUser) && $eventUser > 0){ ?>
                  <div class="uk-text-center" style="font-size:12px; color:hsl(0,75%,60%);">Lưu ý: Bạn đã gửi minh chứng cho chương trình này !</div>
                <?php } ?>
              </div>
              
            </div>
            <div class="uk-width-large-3-4">
              <div class="article-wrapper">
              <?php if(isset($event) && is_array($event) && count($event)){ ?>
                <h1 class="title"><?php echo $event['title'] ?></h1>
                <div class="founding"><?php echo gettime($event['day_start'],'d/m/Y') ?> - <?php echo gettime($event['day_end'],'d/m/Y') ?></div>
                <div class="description">
                <?php echo $event['description'] ?>
                </div>
                <div class="content">
                <?php echo $event['content'] ?>
                </div>
                <?php } ?>
                <div class="related-post">
                  <div class="heading-3">Có thể bạn quan tâm</div>
                  <ul class="uk-list uk-clearfix">
                    <?php if(isset($eventRelate) && is_array($eventRelate) && count($eventRelate)){ ?>
                    <?php foreach ($eventRelate as $key => $val) {?>
                    <li>
                      <a href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>
                    </li>
                    <?php }} ?>
                  </ul>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>