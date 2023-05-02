<?php
namespace App\Models;
use CodeIgniter\Model;

class LoginModel extends Model{
  protected $table="login_activity";
  protected $allowedFields=[
    "uniId",
    "agent",
    "ip",
    "login_time"
];
  public $conn;
  public function __construct()
  {
    $this->conn=\Config\Database::connect();
  }

  public function verifyEmail($email){
    $builder=$this->conn->table("register");
    $builder->select("uniId,status,userName,userPassword");
    $builder->where("email",$email);
    $result=$builder->get();
    if(count($result->getResultArray())==1){
      return $result->getRowArray();
    }else{
      return false;
    }
    // $rowResult=$result->getRow();
    // if($builder->countAll()==1){
    //   return $rowResult;
    // }else{
    //   return false;
    // }

  }

  public function saveLoginInfo($data){
    $builder=$this->conn->table("login_activity");
    $builder=$this->insert($data);
    if($this->db->affectedRows()==1){
      return $this->db->insertID();
    }else{
      return false;
    }
  }
}
?>