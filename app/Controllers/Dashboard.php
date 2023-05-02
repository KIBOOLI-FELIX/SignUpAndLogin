<?php
namespace App\Controllers;
use \CodeIgniter\Controller;
use \Config\Services;
use App\Models\DashboardModel;
class Dashboard extends BaseController{
  public $dModel;
  protected $helpers=["form","message"];
  public function __construct(){
    $this->dModel=new DashboardModel();
    
  }
  public function index(){
    $userId=session()->get("logged_user");
    $data["userdata"]=$this->dModel->getUserLogged($userId);
    
    return view("dashboard",$data);
  }
  public function LogOut(){
    if(session()->has("logged_info")){
      $la_id=session()->get("logged_info");
      $this->dModel->updateOnlogoutTime($la_id);
    }
    session()->remove("logged_user");
    session()->destroy();
    return redirect()->to(base_url("login"));
  }

  public function login_activity(){
    $data["userdata"]=$this->dModel->getUserLogged(session()->get("logged_user"));
    $data["login_info"]=$this->dModel->getLoginUserInfo(session()->get("logged_user"));
    // var_dump($data);
    return view("login_activity",$data);
  }

  public function avatarUpload(){
    $data=[];
    if(strtolower($this->request->getMethod())=="post"){
      $rules=[
        "avatar"=>"uploaded[avatar]|max_size[avatar,1024]|ext_in[avatar,png,jpg,gif]"
      ];
      if($this->validate($rules)){

        $file=$this->request->getFile("avatar");
        if($file->isValid() && !$file->hasMoved()){
          if($file->move(FCPATH."profiles",$file->getRandomName())){
            $path= base_url()."/profiles/".$file->getName();
            
            $status=$this->dModel->updateAvatar($path,session()->get("logged_user"));
            if($status){
              session()->setTempdata("success","Avatar uploaded successfully",3);
              return redirect()->to(current_url());
            }else{
              session()->setTempdata("error","Sorry Avatar Upload failed",3);
              return redirect()->to(current_url());
            }
          }else{
            session()->setTempdata("error",$file->getErrorString(),3);
            return redirect()->to(current_url());
          };
        }else{
          session()->setTempdata("error","Invalid file ",3);
          return redirect()->to(current_url());
        }
    }else{
      $data["validation"]=$this->validator;
    }
  }
    return view("avatar",$data);
  }

  public function changePassword(){
    $data=[];
    $data["userdata"]=$this->dModel->getUserLogged(session()->get("logged_user"));
    
    if (strtolower($this->request->getMethod()) !== "post") {
      $data["validation"]=Services::validation();
      return view("change_password",$data);
    }

      $rules = [
        "oldpwd"=>[
          "rules"=>"required|min_length[8]",
          "errors"=>[
              "required"=>"This is a required field",
              "min_length"=>"Password must at least be 8 characters in length",
          ],
        ],
        "nwpwd" => [
          "rules" => "required|min_length[8]",
          "errors" => [
            "required" => "This is a required field",
            "min_length" => "Password must at least be 8 characters in length",
          ],
        ],
        "confnwpwd" => [
          "rules" => "required|matches[nwpwd]",
          "errors" => [
            "required" => "This is a required field",
            "matches" => "Passwords do not match"
          ],
        ]
      ];

      if($this->validate($rules)){

        $oldpwd=$this->request->getvar("oldpwd");
        $nwpwd = $this->request->getVar("nwpwd");
        print_r($data["userdata"]);
      if(password_verify($oldpwd,$data["userdata"]->userPassword)){
        if($this->dModel->updatePassword($nwpwd,session()->get("logged_user"))){
          session()->setTempdata("success", "Password updated successfully", 3);
        }else{
          session()->setTempdata("error", "Sorry, failed to update password", 3);
        }
        return redirect()->to(base_url('changepassword'));
      }else{
        session()->setTempdata("error", "Old password is incorrect", 3);
      }
     
      }else{
        $data["validation"] = $this->validator;
      }

    return view("change_password",$data);
  }
}