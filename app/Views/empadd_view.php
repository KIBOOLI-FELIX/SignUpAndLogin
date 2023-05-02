<?php $page_session=CodeIgniter\Config\Services::session();?>
<?=$this->extend("layouts/base");?>
<?=$this->section("body");?>
 <div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Add Employee</h1>
      <div class="container text-danger">
        <div class="container text-success">
         <?=messageAlert($page_session);?>
        </div>
        <?php if(!empty($errors)):?>
          <?php foreach($errors as $field=>$error):?>
            <p><?= $error;?></p>
          <?php endforeach;?>
        <?php endif;?>
      </div>
      <?=form_open();?>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="<?=set_value("name");?>">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" value="<?=set_value("email");?>">
      </div>
      <div class="form-group">
        <label for="salary">Salary</label>
        <input type="text" name="salary" class="form-control" value="<?=set_value("salary");?>">
      </div>
      <div class="form-group">
        <label for="ciy">City</label>
        <input type="text" name="city" class="form-control" value="<?=set_value("city");?>">
      </div>
      <div class="form-group">
        <label for="desgn">Designation</label>
        <input type="text" name="designation" class="form-control" value="<?=set_value("designation");?>">
      </div>
      <div class="form-group">
        <label for="name">Mobile</label>
        <input type="text" name="mobile" class="form-control" value="<?=set_value("mobile");?>">
      </div>
      <div class="form-group mt-4">
        <input type="submit" name="submit" value="Add Employee" class="btn btn-primary">
      </div>
      <?=form_close();?>
    </div>
  </div>
 </div>
<?= $this->endSection();?>