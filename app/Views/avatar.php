<?php $page_session=\Config\Services::session();?>
<?=$this->extend("layouts/base");?>
<?=$this->section("body");?>
<div class="container">
<div class="row">
  <div class="col-md-12">
    <?=form_open_multipart();?>
    <div class="alert alert-danger">
      <?php if(isset($validation)):?>
        <?=$validation->listErrors();?>
      <?php endif;?>
      <?=messageAlert($page_session);?>
    </div>
    <div class="form-group">
      <label>Upload Avatar</label>
      <input type="file" name="avatar" class="form-control">
    </div>
    <div class="form-group">
      <input type="submit" value="Upload" class="btn btn-primary">
    </div>
    <?=form_close();?>
  </div>
</div>
</div>
<?=$this->endSection();?>