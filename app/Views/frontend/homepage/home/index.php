    <div id="homepage">
      <div class="slide-container">
        <?php
          $owlInit = [
            'nav' => true,
            'dots' => true,
            'loop' => true,
            'margin' => 20,
            'autoplay' => true,
            'autoplayTimeout' => 3500,
            'responsive' => array(
              0 => array(
                'items' => 1,
              ),
              480 => array(
                'items' => 1,
              ),
              768 => array(
                'items' => 1,
              ),
              960 => array(
                'items' => 1,
              ),
            ),
          ];
        ?>
        <div class="owl-slide">
          <div class="owl-carousel owl-theme"  data-owl="	<?php echo base64_encode(json_encode($owlInit));?>">
          <?php if(isset($slide) && is_array($slide) && count($slide)){ ?>
          <?php foreach ($slide as $key => $val) {?>
            <div class="item">
              <a href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php echo $val['title'] ?>" class="image img-cover">
                <img src="<?php echo $val['image'] ?>"  class="lazyloading " alt="<?php echo $val['image'] ?>">
              </a>
              <div class="item-content">
                <div class="sub-title"><?php echo $val['slide_title'] ?></div>
                <div class="description"><?php echo $val['slide_description'] ?></div>
                <div class="btn-readmore">
                  <a href="<?php echo $val['canonical'].HTSUFFIX ?>">Xem thêm <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
            <?php }} ?>
          </div>
        </div>
      </div>

      <div class="travel-container">
        <div class="uk-container uk-container-center">
          <div class="heading-1">
            <span>CÁC CHƯƠNG TRÌNH, SỰ KIỆN ĐANG DIỄN RA</span>
          </div>
          <?php
              $owlInit = [
                'nav' => true,
                'dots' => false,
                'loop' => true,
                'margin' => 20,
                'autoplay' => true,
                'autoplayTimeout' => 3000,
                'responsive' => array(
                  0 => array(
                    'items' => 1,
                  ),
                  480 => array(
                    'items' => 2,
                  ),
                  768 => array(
                    'items' => 3,
                  ),
                  960 => array(
                    'items' => 4,
                  ),
                ),
              ];
            ?>
          <div class="owl-slide">
            <div class="owl-carousel owl-theme"  data-owl="	<?php echo base64_encode(json_encode($owlInit)); ?>">
            <?php if(isset($event) && is_array($event) && count($event)){ ?>
            <?php foreach ($event as $key => $val){ ?>
              <div class="travel-item">
                <a href="<?php echo $val['canonical'].HTSUFFIX ?>" class="image img-cover">
                  <img src="<?php echo $val['image'] ?>" alt="<?php echo $val['title'] ?>">
                </a>
                <div class="info">
                  <div class="title">
                    <a href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php  echo $val['title'] ?>">
                      <?php echo $val['title'] ?>
                    </a>
                  </div>
                  <div class="time"> Thời gian:  <?php echo changeDateFormat($val['day_start'],'d/m/Y') ?> - <?php echo changeDateFormat($val['day_end'],'d/m/Y') ?> </div>
                  <div class="description"> <?php echo $val['description'] ?> </div>
                </div>
              </div>
              <?php }} ?>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="homepage-customer">
        <div class="uk-container uk-container-center">
          <h2 class="heading-2">
            <span>Cảm nghĩ của bạn?</span>
          </h2>
          <div class="partner-wrapper owl-slide">
          <?php
              $owlInit = [
                'nav' => true,
                'dots' => false,
                'loop' => true,
                'margin' => 20,
                'autoplay' => true,
                'autoplayTimeout' => 3000,
                'responsive' => array(
                  0 => array(
                    'items' => 1,
                  ),
                  480 => array(
                    'items' => 1,
                  ),
                  768 => array(
                    'items' => 2,
                  ),
                  960 => array(
                    'items' => 2,
                  ),
                ),
              ];
            ?>
            <div class="owl-carousel owl-theme owl-loaded owl-drag" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>">
              <div class="customer-item">
                <div class="uk-grid uk-grid-small">
                  <div class="uk-width-large-1-3">
                    <div class="customer-info">
                      <div class="customer-image">
                        <span class="image img-cover">
                          <img src="upload/image/goc-chia-se/phuong-thi-ha.png" alt="PHƯƠNG THỊ HÀ (2003 - LẠNG SƠN)">
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="uk-width-large-2-3">
                    <div class="customer-message">
                      <div class="customer-fullname">PHƯƠNG THỊ HÀ (2003 - LẠNG SƠN)</div>
                      <div class="customer-description"> Các anh chị tư vấn nhiệt tình lắm luôn ạ, dịch vụ uy tín, chuyên nghiệp. Em đã xin thành công học bổng bán phần 1+3 cảm ơn Du học Vimiss đã hỗ trợ cho em thời gian vừa qua ạ </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="customer-item">
                <div class="uk-grid uk-grid-small">
                  <div class="uk-width-large-1-3">
                    <div class="customer-info">
                      <div class="customer-image">
                        <span class="image img-cover">
                          <img src="upload/image/goc-chia-se/nguyen-thu-phuong.png" alt=" NGUYỄN THU PHƯƠNG (2001 - HÀ NỘI)">
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="uk-width-large-2-3">
                    <div class="customer-message">
                      <div class="customer-fullname"> NGUYỄN THU PHƯƠNG (2001 - HÀ NỘI)</div>
                      <div class="customer-description"> Mình thấy cách mà Vimiss tư vấn rất có tâm và có tầm, và nơi để mình gửi gắm giấc mơ đi du học chính là Vimiss Nếu các bạn đang tìm hiểu ở đâu thì đừng bỏ qua Vimiss nhé có tâm và có tầm, và nơi để mình gửi gắm giấc mơ đi du học chính là Vimiss </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="customer-item">
                <div class="uk-grid uk-grid-small">
                  <div class="uk-width-large-1-3">
                    <div class="customer-info">
                      <div class="customer-image">
                        <span class="image img-cover">
                          <img src="upload/image/goc-chia-se/dao-phuong-thao.png" alt="ĐÀO PHƯƠNG THẢO (2003 - THÁI NGUYÊN)">
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="uk-width-large-2-3">
                    <div class="customer-message">
                      <div class="customer-fullname">ĐÀO PHƯƠNG THẢO (2003 - THÁI NGUYÊN)</div>
                      <div class="customer-description"> Đây đúng là nơi uy tín để chúng ta có thể apply học bổng, thực hiện ước mơ du học Trung Quốc. Cảm ơn Du học Vimiss đã sát cánh bên em trong hành trình chinh phục ước mơ. </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="customer-item">
                <div class="uk-grid uk-grid-small">
                  <div class="uk-width-large-1-3">
                    <div class="customer-info">
                      <div class="customer-image">
                        <span class="image img-cover">
                          <img src="upload/image/goc-chia-se/ha-vi.png" alt="HÀ VI (2000 - HƯNG YÊN) ">
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="uk-width-large-2-3">
                    <div class="customer-message">
                      <div class="customer-fullname">HÀ VI (2000 - HƯNG YÊN) </div>
                      <div class="customer-description"> Tư vấn chính xác, tỉ mỉ, đầy đủ mọi thứ cần thiết để đi du học sang Trung. Cảm ơn Vimiss đã hỗ trợ cho em. Chúc cho Du học Vimiss trong thời gian sắp tới sẽ càng thành công hơn nữa </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    </div>
    <?php if(isset($article) && is_array($article) && count($article)){ ?>
    <div class="news-container">
      <div class="uk-container uk-container-center">
        <h2 class="heading-1">
          <span>BÀI VIẾT MỚI NHẤT</span>
        </h2>
        <div class="uk-grid uk-grid-medium">
          <div class="uk-width-large-1-2">
            <?php foreach ($article as $key => $val){ ?>
            <div class="feature-post">
              <a href="<?php echo $val['canonical'].HTSUFFIX ?>" class="image img-cover">
                <img src="<?php echo $val['image'] ?>"  class="lazyloading " alt="<?php echo $val['image'] ?>">
              </a>
              <h3 class="title">
                <a href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>
              </h3>
              <div class="description"> <?php echo $val['description'] ?> </div>
              <div class="create_at">
                <i class="fa fa-calendar mr5"></i><?php echo gettime($val['created_at'],' H:m - d/m/Y') ?>
              </div>
            </div>
            
            <?php if($key == 0) break; } ?>
          </div>
          <div class="uk-width-large-1-2">
          <?php 
            foreach ($article as $key => $val){ 
            if($key == 0) continue;
            ?>
            <div class="list-post">
              <div class="article-1 uk-clearfix">
                <a href="<?php echo $val['canonical'].HTSUFFIX ?>" class="image img-cover">
                  <img src="<?php echo $val['image'] ?>"  class="lazyloading " alt="<?php echo $val['image'] ?>">
                </a>
                <div class="info">
                  <h3 class="title">
                    <a href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>
                  </h3>
                  <div class="description"><?php echo $val['description'] ?></div>
                  <div class="create_at"><i class="fa fa-calendar mr5"></i><?php echo gettime($val['created_at'],'H:m - d/m/Y') ?></div>
                </div>
              </div>
            </div>
            <?php if($key == 4) break; } ?>
          </div>
        </div>
        <div class="uk-text-center">
          <div class="readmore">
            <a href="bai-viet.html">Xem thêm</a>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if(isset($faculty) && is_array($faculty) && count($faculty)){ ?>
      <div class="partner-section">
        <div class="uk-container uk-container-center">
          <div class="heading-1">
            <span>Các Liên chi Đoàn trực thuộc</span>
          </div>
          <div class="panel-body">
            <?php
              $owlInit = [
                'nav' => false,
                'dots' => false,
                'loop' => true,
                'margin' => 20,
                'autoplay' => true,
                'autoplayTimeout' => 2000,
                'responsive' => array(
                  0 => array(
                    'items' => 2,
                  ),
                  480 => array(
                    'items' => 3,
                  ),
                  768 => array(
                    'items' => 4,
                  ),
                  960 => array(
                    'items' => 5,
                  ),
                ),
              ];
            ?>
            <div class="owl-slide">
                <div class="owl-carousel owl-theme"  data-owl="	<?php echo base64_encode(json_encode($owlInit));?>">
                <?php foreach ($faculty as $key => $val){ ?>
                  <div class="item">
                      <a class="image img-cover" href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php echo $val['title'] ?>">
                        <img src="<?php echo $val['image'] ?>" alt="">
                      </a>
                  </div>
                <?php } ?>
                </div>
              </div>
          </div>
        </div>
      </div>
      <?php } ?>
    <!-- <div class="n-activity">
      <div class="uk-container uk-container-center">
        <div class="n-activity-content">
          <div class="main-title "> Hình ảnh hoạt động </div>
          <div class="n-activity-body ">
            <ul data-uk-switcher="{connect:'#my-id'} " class="uk-flex uk-flex-center n-activity-choice-list mb20 uk-list uk-clearfix">
              <li class="mr20">
                <a href="">Các sự kiện tổ chức1</a>
              </li>
              <li class="mr20">
                <a href="">Các sự kiện tổ chức2</a>
              </li>
            </ul>
            <ul id="my-id" class="uk-switcher ">
              <li>
                <div class="n-activity-pic-list mb50">
                  <div class="uk-grid uk-grid-width-xlarge-1-4 uk-grid-collapse">
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/1.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/1.png">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="n-activity-pic-list mb50">
                  <div class="uk-grid uk-grid-width-xlarge-1-4 uk-grid-collapse">
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/1.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/1.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/2.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/2.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/3.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/3.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/4.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/4.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/5.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/5.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/6.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/6.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/7.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/7.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/8.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/8.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/9.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/9.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/10.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/10.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/11.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/11.png">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="n-wrap-grid">
                      <div class="n-activity-pic">
                        <div class="thumb_ratio">
                          <a href="" target="_blank" title="Các sự kiện tổ chức" class="image img-cover" link="">
                            <img src="/upload/image/hinh-anh-hoat-dong/ngay-hoi-du-hoc-lon-nhat.png"  class="lazyloading " alt="/upload/image/hinh-anh-hoat-dong/ngay-hoi-du-hoc-lon-nhat.png">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div> -->
    