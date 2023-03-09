<div class="article-catalogue">
      <div class="breadcrumb-panel">
        <div class="uk-container-center uk-container">
          <ul class="uk-breadcrumb uk-clearfix ">
            <li class="breadcrumb-home">
              <a href="index.html">
                <i class="fa fa-home"></i> Trang chủ </a>
            </li>
            <li class="">
              <a href="chuong-trinh-su-kien.html">
                <span>Tìm kiếm</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="page-container">
        <div class="uk-container uk-container-center">
          <div class="uk-grid uk-grid-collapse">
            <div class="uk-width-large-1-1">
              <div class="title-search">
                Tìm kiếm theo từ khóa: <span>"<?php echo $keyword ?>"</span>
              </div>

            </div>
          <?php if(isset($data) && is_array($data) && count($data)){ ?>
            <div class="uk-width-large-1-2">
              <div class="title-catalogue uk-text-center">Kết quả tìm kiếm Bài viết</div>
              <div class="page-list">
              <?php if(isset($data['list']['article']) && is_array($data['list']['article']) && count($data['list']['article'])){ ?>
              <?php foreach ($data['list']['article'] as $key => $val) {?>
                <div class="article uk-clearfix">
                  <a href="<?php  echo $val['canonical'].HTSUFFIX ?>" class="image img-cover">
                    <img data-src="<?php  echo $val['image'] ?>" src="<?php  echo $val['image'] ?>" class="lazyloading " alt="<?php  echo $val['title'] ?>">
                  </a>
                  <div class="info">
                    <h3 class="title">
                      <a href="<?php  echo $val['canonical'].HTSUFFIX ?>" title="<?php  echo $val['title'] ?>"><?php  echo $val['title'] ?></a>
                    </h3>
                    <div class="created_at"> <?php  echo gettime($val['created_at'],'H:m:s - d/m/Y') ?></div>
                    <div class="description"> <?php  echo $val['description'] ?></div>
                    <div class="readmore">
                      <a href="<?php  echo $val['canonical'].HTSUFFIX ?>" class="btn-readmore" title="<?php  echo $val['title'] ?>">Chi tiết »</a>
                    </div>
                  </div>
                </div>
              <?php  }}else{ ?>
                <div class="title-result">
                Không có dữ liệu!
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="uk-width-large-1-2">
              <div class="title-catalogue uk-text-center">Kết quả tìm kiếm Chương trình, sự kiện</div>
              <div class="page-list">
              <?php if(isset($data['list']['event']) && is_array($data['list']['event']) && count($data['list']['event'])){ ?>
              <?php foreach ($data['list']['event'] as $key => $val) {?>
                <div class="article uk-clearfix">
                  <a href="<?php  echo $val['canonical'].HTSUFFIX ?>" class="image img-cover">
                    <img data-src="<?php  echo $val['image'] ?>" src="<?php  echo $val['image'] ?>" class="lazyloading " alt="<?php  echo $val['title'] ?>">
                  </a>
                  <div class="info">
                    <h3 class="title">
                      <a href="<?php  echo $val['canonical'].HTSUFFIX ?>" title="<?php  echo $val['title'] ?>"><?php  echo $val['title'] ?></a>
                    </h3>
                    <div class="created_at"> <?php  echo gettime($val['created_at'],'H:m:s - d/m/Y') ?></div>
                    <div class="description"> <?php  echo $val['description'] ?></div>
                    <div class="readmore">
                      <a href="<?php  echo $val['canonical'].HTSUFFIX ?>" class="btn-readmore" title="<?php // echo $val['title'] ?>">Chi tiết »</a>
                    </div>
                  </div>
                </div>
              <?php }}else{ ?>
                <div class="title-result">
                Không có dữ liệu!
                </div>
                <?php } ?>
              </div>
            </div>
          <?php }else{?>
            Không có dữ liệu!
            <?php } ?>
          </div>
        </div>
      </div>
    </div>