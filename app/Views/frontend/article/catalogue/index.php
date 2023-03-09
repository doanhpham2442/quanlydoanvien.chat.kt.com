<div class="article-catalogue">
      <div class="breadcrumb-panel">
        <div class="uk-container-center uk-container">
          <ul class="uk-breadcrumb uk-clearfix ">
            <li class="breadcrumb-home">
              <a href="index.html">
                <i class="fa fa-home"></i> Trang chủ </a>
            </li>
            <li class="">
              <a href="bai-viet.html">
                <span>Bài viết</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="page-container">
        <div class="uk-container uk-container-center">
          <div class="uk-grid uk-grid-large">
            <div class="uk-width-large-1-4">
              <div class="aside" >
                <div class="aside-category">
                  <div class="aside-heading">
                    <span>Danh mục bài viết</span>
                  </div>
                  <ul class="uk-clearfix uk-list">
                  <?php if(isset($articleCatalogue) && is_array($articleCatalogue) && count($articleCatalogue)){ ?>
                    <?php foreach ($articleCatalogue as $key => $val) {?>
                    <li <?php echo ($val['level'] == 1) ? 'class="text-success text-bold"' : '' ?>>
                        <a href="<?php echo $val['canonical'].HTSUFFIX ?>" class="<?php echo str_repeat('ml20', (($val['level'] > 0)?($val['level'] - 1):0)) ?>" >
                            <?php echo $val['title']; ?>
                        </a>
                    </li>
                    <?php }} ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="uk-width-large-3-4">
              <div class="title-catalogue uk-text-center"><?php echo $article['catalogue_title'] ?></div>
              <div class="page-list">
              <?php if(isset($article['list']) && is_array($article['list']) && count($article['list'])){ ?>
              <?php foreach ($article['list'] as $key => $val) {?>
                <div class="article uk-clearfix">
                  <a href="<?php echo $val['canonical'].HTSUFFIX ?>" class="image img-cover">
                    <img data-src="<?php echo $val['image'] ?>" src="<?php echo $val['image'] ?>" class="lazyloading " alt="<?php echo $val['title'] ?>">
                  </a>
                  <div class="info">
                    <h3 class="title">
                      <a href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>
                    </h3>
                    <div class="created_at"> <?php echo gettime($val['created_at'],'H:m:s - d/m/Y') ?></div>
                    <div class="description"> <?php echo $val['description'] ?></div>
                    <div class="readmore">
                      <a href="<?php echo $val['canonical'].HTSUFFIX ?>" class="btn-readmore" title="<?php echo $val['title'] ?>">Chi tiết »</a>
                    </div>
                  </div>
                </div>
              <?php }} ?>
                <div class="pagination">
                <?php  echo (isset($article['pagination'])) ? $article['pagination']  : ''; ?>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>