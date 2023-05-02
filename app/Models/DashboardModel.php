<?php
namespace App\Models;
use CodeIgniter\Model;

class DashboardModel extends Model{
  public function getUserLogged($id){
    $builder=$this->db->table("register");
    $builder->where("uniId",$id);
    $result=$builder->get();
    if(count($result->getResultArray())==1){
      return $result->getRow();
    }else{
      return false;
    }
  }

  public function updateOnlogoutTime($id){
    $builder=$this->db->table("login_activity");
    $builder->where("id",$id);
    $builder->update(["logout_time"=>date("Y-m-d h:i:s")]);
    if($this->db->affectedRows()>0){
      return true;
    }
  }
public function  getLoginUserInfo($id){
  $builder=$this->db->table("login_activity");
  $builder->where("uniId",$id);
  $builder->orderBy("id","DESC");
  $builder->limit(10);
  $result=$builder->get();
  if(count($result->getResultArray())>0){
    return $result->getResult();
  }else{
    return false;
  }
}

public function updateAvatar($path,$id){
  $builder=$this->db->table("register");
  $builder->where("uniId",$id);
  $builder->update(["userPic"=>$path]);
  if($this->db->affectedRows()>0){
    return true;
  }else{
    return false;
  }
}

public function updatePassword($nwpwd,$id){
  $hashedPwd=password_hash($nwpwd,PASSWORD_DEFAULT);
  $builder=$this->db->table("register");
  $builder->where("uniId",$id);
  $builder->update(["userPassword"=>$hashedPwd]);
  if($this->db->affectedRows()>0){
    return true;
  }else{
    return false;
  }
}
}
?>