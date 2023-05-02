<?=$this->extend("layouts/base");?>
<?=$this->section("note");?>
  Welcome <span><?=$userdata->userName;?></span>
<?=$this->endSection();?>
<?=$this->section("body");?>
<h1>Hi <span class="text-success"><?=$userdata->userName;?></span></h1>
<h5>Login Acivity</h5>
<?php if(count($login_info)>0):?>
  <table class="table table-bordered">
    <tr>
      <th>Id</th>
      <th>Login Time</th>
      <th>Logout Time</th>
      <th>User Agent</th>
      <th>IP Address</th>
    </tr>
    <?php foreach($login_info as $info):?>
      <tr>
        <td><?=$info->id;?></td>
        <td><?=$info->login_time;?></td>
        <td><?=$info->logout_time;?></td>
        <td><?=$info->agent;?></td>
        <td><?=$info->ip;?></td>
      </tr>
    <?php endforeach;?>
  </table>
<?php else:?>
  <h5>Sorry No Record of User Acivity</h5>
<?php endif;?>
<?=$this->endSection();?>