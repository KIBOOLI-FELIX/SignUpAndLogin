<?=$this->extend("layouts/base");?>
<?=$this->section("note");?>
 Welcome <span><?=$userdata->userName;?></span>
<?=$this->endSection();?>
<?=$this->section("body");?>
<div class="container">
  <div class="card">
    <div class="card-header">
      <img src="<?=$userdata->userPic;?>" alt="Profile Pic" class="fluid" height=60>
    </div>
    <div class="card-body">
      <p>Welcome <span><?=$userdata->userName;?></span></p>
    </div>
  </div>
</div>
<?=$this->endSection();?>