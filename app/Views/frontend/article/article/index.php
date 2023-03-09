<div class="page-body">
      <section class="breadcrumb-panel">
        <div class="uk-container-center uk-container">
          <ul class="uk-breadcrumb uk-clearfix ">
            <li class="breadcrumb-home">
              <a href="index.html">
                <i class="fa fa-home"></i> Trang chủ </a>
            </li>
            <li class="">
              <a href="<?php echo $article['canonical'].HTSUFFIX ?>">
                <span><?php echo $article['title'] ?></span>
              </a>
            </li>
          </ul>
        </div>
      </section>
      <div class="page-container">
        <div class="uk-container uk-container-center">
          <div class="uk-grid uk-grid-medium">
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
              <div class="article-wrapper">
              <?php if(isset($article) && is_array($article) && count($article)){ ?>
                <h1 class="title"><?php echo $article['title'] ?></h1>
                <div class="founding"> <?php echo gettime($article['created_at'],'H:i - d/m/Y') ?></div>
                <div class="description">
                  <?php echo $article['description'] ?>
                </div>
                <div class="content">
                <?php echo $article['content'] ?>
              </div>
              <?php } ?>
                <div class="related-post">
                <?php if(isset($articleRelate) && is_array($articleRelate) && count($articleRelate)){ ?>
                  <div class="heading-3">Có thể bạn quan tâm</div>
                  <ul class="uk-list uk-clearfix">
                  <?php foreach ($articleRelate as $key => $val) {?>
                    <li>
                      <a href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
                <?php }  ?>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>