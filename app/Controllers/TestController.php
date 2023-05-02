<?php
namespace App\Controllers;
use App\Models\Forge;
use \CodeIgniter\Config\Services;
use Throwable;
class TestController extends BaseController{
  public $forgeTest;
  public $migrate;
  public function __construct(){
    $this->forgeTest=new Forge();
    $this->migrate=Services::migrations();
  }
  public function index(){
    if($this->forgeTest->forge()==true){
      echo "God will save us from our sins";
    }else{
      echo "God will surely save us from our sins, For He is able";
    }
  }

  public function migration(){
    try{
      $this->migrate->latest();
    } catch(Throwable $e){
      echo "Failed to migrate ".$e;
    }
  }
}