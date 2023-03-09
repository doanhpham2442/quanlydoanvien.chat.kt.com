<div class="ibox mb20 album">
   <div class="ibox-title">
      <div class="uk-flex uk-flex-middle uk-flex-space-between">
         <h5>Album Ảnh </h5>

         <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <!-- <form class="js_upload_now" action="" method="post" enctype="multipart/form-data">
               <input data-result="" class="m-r " type="file" name="a" multiple>
               <input type="submit" name="abx" value="Add">
            </form> -->
            <div class="edit">
               <a onclick="BrowseServerAlbum($(this));return false;" href="" title="" class="upload-picture">Chọn Hình</a>
            </div>
         </div>
      </div>
   </div>
   <div class="ibox-content">
      <?php
         if(isset($_POST['album'])){
            $album = $_POST['album'];
         }else if(isset($articleCatalogue)){
            $album = json_decode($articleCatalogue['album'], TRUE);
         }
       ?>
      <div class="row">
         <div class="col-lg-12">
            <div class="click-to-upload" <?php echo (isset($album))?'style="display:none"':'' ?>>
               <div class="icon">
                  <a type="button" class="upload-picture" onclick="BrowseServerAlbum($(this));return false;">
                     <svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path></svg>
                  </a>
               </div>
               <div class="small-text">Sử dụng nút chọn hình để thêm mới hình ảnh</div>
            </div>
            <div class="upload-list" <?php echo (isset($album))?'':'style="display:none"' ?> style="padding:5px;">
               <div class="row">
                  <ul id="sortable" class="clearfix data-album sortui">
                     <?php if(isset($album) && is_array($album) && count($album)){ ?>
                     <?php foreach($album as $key => $val){ ?>
                        <li class="ui-state-default">
                           <div class="thumb">
                              <span class="image img-scaledown">
                                 <img src="<?php echo $val; ?>" alt="" /> <input type="hidden" value="<?php echo $val; ?>" name="album[]" />
                              </span>
                              <div class="overlay"></div>
                              <div class="delete-image"><i class="fa fa-trash" aria-hidden="true"></i></div>
                           </div>
                        </li>
                     <?php }} ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
