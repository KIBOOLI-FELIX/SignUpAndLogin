<?=$this->extend("layouts/base");?>
<?=$this->section("body");?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Change Password</h1>
    <?=form_open();?>
    <div class="text-success">
      <?=messageAlert($session=session());?>
    </div>
      <div class="form-group">
        <label for="oldpassword">Enter old Password</label>
        <input type="password" name="oldpwd" class="form-control">
        <span class="text-danger"><?=errorMessage($validation,"oldpwd");?></span>
      </div>
      <div class="form-group">
        <label for="newpassword">Enter New Password</label>
        <input type="password" name="nwpwd" class="form-control">
        <span class="text-danger"><?=errorMessage($validation,"nwpwd");?></span>
      </div>
      <div class="form-group">
        <label for="oldpassword">Confirm New Password</label>
        <input type="password" name="confnwpwd" class="form-control">
        <span class="text-danger"><?=errorMessage($validation,"confnwpwd");?></span>
      </div>
      <div class="form-group mt-3">
        <input type="submit" name="submit" value="change" class="btn btn-primary">
      </div>
      <?=form_close()?>
    </div>
  </div>
</div>
<?=$this->endSection();?>
