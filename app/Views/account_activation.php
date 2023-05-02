<?=$this->extend("layouts/base.php");?>
<?=$this->section("body");?>
<?php if(isset($error)):?>
  <?=$error;?>
<?php endif;?>
<?php if(isset($success)):?>
  <?=$success;?>
<?php endif;?>
<?=$this->endSection();?>