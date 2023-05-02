<?php
namespace App\Controllers;
use App\Models\AutoModel;

class AutoController extends BaseController{
  public $autoModel;
  public function __construct(){
    $this->autoModel = new AutoModel();
  }

  public function index(){
    $data1 = $this->autoModel->find(6);
    $data2 = $this->autoModel->where("id",8)->find();
    // return view("emyview", $data);
    var_dump($data1);
    var_dump($data2);
    echo $data1->Fullname;
  }
}