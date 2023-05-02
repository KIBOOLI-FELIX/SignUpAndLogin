<?php
namespace App\Models;
use CodeIgniter\Model;

class Forge extends Model{
  public $forge;
  public function __construct(){
    $this->forge=\Config\Database::forge();
  }
  public function forge(){

    if($this->forge->createDatabase("salvation",true)){
      return true;
    }else{
      return false;
    }
  }
  
}
?>