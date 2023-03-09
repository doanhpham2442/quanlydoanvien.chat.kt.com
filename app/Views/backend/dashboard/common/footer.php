<?php
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();
?>

<div class="footer">
    <div class="pull-right">
    </div>
    <div>
        <strong></strong> <?php echo CMS_NAME ?> <?php echo date('Y'); ?>
    </div>
</div>