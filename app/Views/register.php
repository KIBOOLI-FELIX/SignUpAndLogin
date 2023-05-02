<?php
 $page_session=\Config\Services::session();
?>
<?=$this->extend("layouts/base.php");?>
<?=$this->section("body");?>
<div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-6">
      <h1>Register</h1>
      <div class="text-warning">
        <?=messageAlert($page_session);?>
      </div>
      <?=form_open();?>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?=set_value("username");?>" class="form-control">
        <span class="text-danger"><?=errorMessage($validation,"username");?></span>
      </div>
      <div class="form-group">
        <label for="username">Password</label>
        <input type="password" name="pwd" value="<?=set_value("pwd");?>" class="form-control">
        <span class="text-danger"><?=errorMessage($validation,"pwd");?></span>
      </div>
      <div class="form-group">
        <label for="username">Confirm Password</label>
        <input type="password" name="confpwd" class="form-control">
        <span class="text-danger"><?=errorMessage($validation,"confpwd");?></span>
      </div>
      <div class="form-group">
        <label for="username">Email</label>
        <input type="email" name="email" value="<?=set_value("email");?>" class="form-control">
        <span class="text-danger"><?=errorMessage($validation,"email");?></span>
      </div>
      <div class="form-group">
        <input type="submit" name="register" value="Register" class="btn btn-primary">
      </div>
      <?=form_close();?>
    </div>
  </div>
</div>
<?=$this->endSection();?>