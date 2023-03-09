<div class="page-body">
      <section class="breadcrumb-panel">
        <div class="uk-container-center uk-container">
          <ul class="uk-breadcrumb uk-clearfix ">
            <li class="breadcrumb-home">
              <a href="index.html">
                <i class="fa fa-home"></i> Trang chủ </a>
            </li>
            <li class="">
              <a href="<?php echo $faculty['canonical'].HTSUFFIX ?>">
                <span><?php echo $faculty['title'] ?></span>
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
                    <span>Danh mục</span>
                  </div>
                  <ul class="uk-clearfix uk-list">
                    <?php if(isset($facultyCatalogue) && is_array($facultyCatalogue) && count($facultyCatalogue)){ ?>
                    <?php foreach ($facultyCatalogue as $key => $val){ ?>
                    <li>
                      <a href="<?php echo $val['canonical'].HTSUFFIX ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>
                    </li>
                    <?php }}?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="uk-width-large-3-4">
            <?php if(isset($faculty) && is_array($faculty) && count($faculty)){ ?>
              <div class="article-wrapper">
                <h1 class="title mb0"><?php echo $faculty['title'] ?></h1>
                <div class="founding">Ngày thành lập: <?php echo changeDateFormat($faculty['founding'],'d/m/Y') ?></div>
                <div class="description">
                  <?php echo $faculty['description'] ?>
                </div>
                <div class="content">
                  <?php echo $faculty['content'] ?>
                </div>
                
              </div>
              <?php }?>
            </div>
            
          </div>
        </div>
      </div>
    </div>