<?php
namespace App\Controllers;
use App\Models\EmployeeModel;
use \CodeIgniter\Config\Services;
class EmployeeController extends BaseController{
  public $empModel;
  public $session;
  protected $helpers = ["form",'message'];
  public function __construct(){
    $this->empModel = new EmployeeModel();
    $this->session= Services::session();
  }

  public function addEmp(){
    if($this->request->getMethod()=='post'){
      $data = [
        "name" => $this->request->getvar("name", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        "email" => $this->request->getvar("email", FILTER_SANITIZE_EMAIL),
        "salary" => $this->request->getvar("salary", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        "mobile" => $this->request->getvar("mobile"),
        "designation" => $this->request->getvar("designation", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        "city" => $this->request->getvar("city", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      ];
      if($this->empModel->save($data)==true){
        echo "Success";
        session()->setTempdata("success", "Employee added successfully", 2);
        return redirect()->to(current_url());
      }else{
        return view("empadd_view",['errors'=>$this->empModel->errors()]);
      }
      
    }
    return view("empadd_view");

   
  }
  public function viewEmp(){
    $data["employeesData"] = $this->empModel->findAll();
    return view("emp_view", $data);
  }
  public function editEmp($id=null){

    if($this->request->getMethod()=='post'){
      $data2 = [
        "name" => $this->request->getvar("name", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        // "email" => $this->request->getvar("email", FILTER_SANITIZE_EMAIL),
        "salary" => $this->request->getvar("salary", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        "mobile" => $this->request->getvar("mobile"),
        "designation" => $this->request->getvar("designation", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        "city" => $this->request->getvar("city", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      ];

      if($this->empModel->update($id,$data2)==true){
        echo "Success";
        session()->setTempdata("success", "Employee Edited successfully", 2);
        return redirect()->to(base_url("view"));
      }else{
        // echo "Something went wrong";
        // var_dump(["errors"=>$this->empModel->errors()]);
        return view("empedit_view",["data"=>$this->empModel->find($id),"errors"=>$this->empModel->errors()]);
      }
      
    }else{
      echo "Hi God";
      return view("empedit_view",["data"=>$this->empModel->find($id)]);
    }
    // return view("empedit_view", $data);
  }
  public function deleteEmp($id=null){
    if($this->empModel->where("id",$id)->delete()){
      session()->setTempdata("success", "Employee deleted successfully", 2);
      return redirect()->to(base_url("view"));
    }else{
      session()->setTempdata("error", "Sorry failed to delete", 2);
      return redirect()->to(base_url("view"));
    }
  }
}