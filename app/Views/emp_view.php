
<?=$this->extend("layouts/base");?>
<?=$this->section("body");?>
<div class="container">
  <div class="row">
    <h1>Employees' list</h1>
    <div class="container text-success">
         <?=messageAlert(session());?>
    </div>
    <?php if(count($employeesData)>0):?>
      <table class="table">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Salary</th>
          <th>City</th>
          <th>Designation</th>
          <th>Email</th>
          <th>Created</th>
          <th>Action</th>
        </tr>
        <?php foreach($employeesData as $data):?>
        <tr>
          <td><?=$data->id;?></td>
          <td><?=$data->name;?></td>
          <td><?=$data->salary;?></td>
          <td><?=$data->city;?></td>
          <td><?=$data->designation;?></td>
          <td><?=$data->email;?></td>
          <td><?=$data->created_at;?></td>
          <td>
            <a href="<?= base_url("edit");?>/<?=$data->id?>" class="btn btn-primary">Edit</a>
            <a href="<?= base_url("delete");?>/<?=$data->id?>" class="btn btn-secondary">Delete</a>
          </td>
        </tr>
        <?php endforeach;?>
      </table>
    <?php endif;?>
  </div>
</div>
<?=$this->endSection();?>