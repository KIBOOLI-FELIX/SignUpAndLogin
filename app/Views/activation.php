<?php
 $page_session=\Config\Services::session();
?>
<?=$this->extend("layouts/base");?>
<?=$this->section("body");?>
<div class="text-warning">
  <?=messageAlert($page_session);?>
  <p>But you can use the link below as an alternative to account activation</p>
<div class="alert">
<?php if(isset($link)):?>
    <?=$link;?>
  <?php endif;?>
</div>
<?=$this->endSection();?>

