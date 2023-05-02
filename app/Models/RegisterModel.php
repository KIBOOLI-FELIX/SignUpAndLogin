<?php
namespace App\Models;
use CodeIgniter\Model;

class RegisterModel extends Model{
    public $conn;
    public function __construct()
    {
      $this->conn=\Config\Database::connect();
    }
  public function saveData($data){

    $builder=$this->conn->table('register');
    $res=$builder->insert($data);

    if(!$res){
      return false;
    }else{
      return true;
    }

  }

  public function verifyId($id){
    $builder=$this->conn->table('register');
    $builder->select("activationDate,uniId,status");
    $builder->where("uniId",$id);
    $result=$builder->get();
    $rowResult=$result->getRow();
    if($rowResult){
      return $rowResult;
    }else{
      // return false;
      // echo $id;
      print_r($rowResult);
    }
   
  }

  public function updateStatus($id){
    $builder=$this->conn->table('register');
    $builder->where("uniId",$id);
    $builder->update(["status"=>"active"]);

    if($builder){
      return true;
    }else{
      return false;
    }

  }
}
?>