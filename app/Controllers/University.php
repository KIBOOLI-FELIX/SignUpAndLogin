<?php

namespace App\Controllers;
use \Config\Services;
use App\Models\RegisterModel;
use App\Models\LoginModel;
class University extends BaseController
{
    public $registerModel;
    public $loginModel;
    public $session;
    public $email;
    public $throttler;
    public function __construct()
    {
        $this->registerModel=new RegisterModel();
        $this->loginModel=new LoginModel();
        $this->session=Services::session();
        $this->email=Services::email();
        $this->throttler= Services::throttler();
    }
    protected $helpers=["form","message","date"];
    public function index()
    {
        return view('main.php');
    }

    public function register(){
        $data=[];
        // $data["validation"]=null;
        if(strtolower($this->request->getMethod())!=="post"){
            $data["validation"]=Services::validation();
            return view("register.php",$data);
        }

        $rules=[
            "username"=>[
                "rules"=>"required",
                "errors"=>[
                    "required"=>"This is a required field",
                ],
            ],
            "pwd"=>[
                "rules"=>"required|min_length[8]",
                "errors"=>[
                    "required"=>"This is a required field",
                    "min_length"=>"Password must at least be 8 characters in length",
                ],
            ],
            "confpwd"=>[
                "rules"=>"required|matches[pwd]",
                "errors"=>[
                    "required"=>"This is a required field",
                    "matches"=>"Passwords do not match"
                ],
            ],
            "email"=>[
                "rules"=>"required|valid_email|is_unique[register.email]",
                "errors"=>[
                    "required"=>"This is a required field",
                    "valid_email"=>"Your email is invalid",
                    "is_unique"=>"Email already exists"
                ],
            ],
        ];

        if(!$this->validate($rules)){
            $data["validation"]=$this->validator;
            return view("register.php",$data);
        }else
        {
            $tokken=md5(str_shuffle("abcdefghijklmnopqrstuvwxyz".time()));
            $data=[
                "userName"=>$this->request->getVar("username",FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                "userPassword"=>password_hash($this->request->getVar("pwd"),PASSWORD_DEFAULT),
                "email"=>$this->request->getVar("email"),
                "uniId"=>$tokken,
                "activationDate"=>date("Y-m-d h:i:s"),
            ];

            if($this->registerModel->saveData($data)){
                $to=$this->request->getVar("email");
                $subject="Account Activation Link-JajjaDev";
                $message="Hi ".$this->request->getVar("username",FILTER_SANITIZE_FULL_SPECIAL_CHARS)."
                ,<br><br>Thanks your account created successfully. Follow link below to activate it<br><br>"
                ."<a href='".base_url("activate").$tokken."'>Activate Now</a><br><br>Thanks<br> JajjaDev";

                $this->email->setTo($to);
                $this->email->setFrom("kiboolif@gmail.com","Info");
                $this->email->setSubject($subject);
                $this->email->setMessage($message);
                if($this->email->send()){
                    $this->session->setTempdata("success","Account created successfully. Please verify your account",3);
                    $data["validation"]=null;
                    return view("register",$data);
                }else{
                    // $data=$this->email->printDebugger(["headers"]);
                    // print_r($data);
                    $this->session->setTempdata("error","Account created successfully.But unable to send verification link by email",3);
                    $data["link"]="<a href='".base_url("activate")."/".$tokken."'>Activate Now</a>";
                    return view("activation",$data);
                }
            }else{
                $this->session->setTempdata("error","Sorry unable to create an account, try again",3);
                return redirect()->to(current_url());
            };
        }
    }

    public function activate($id=null){
        // return $id;
        $data=[];
        if(!empty($id)){
            $userData=$this->registerModel->verifyId($id);
            // print_r($userData);
            if($userData){
                if($this->verifyExpiration($userData->activationDate)){
                   if($userData->status=="inactive"){
                    $status=$this->registerModel->updateStatus($id);
                    if($status){
                        $data["success"]="Accounted activated successfully";
                    }else{
                        $data["error"]="Account Activation failed, try again later";
                    }
                   }else{
                    $data["success"]="Your account is already active";
                   }
                }else{
                    $data["error"]="Sorry the link is already expired";
                }
                
            }else{
                // print_r($userData);
                $data["error"]="Sorry We are unable to find your record";
            }
        }else{
          $data["error"]="Sorry unable to process your request";
        }
        return view("account_activation.php",$data);
    }

    public function verifyExpiration($regTime){
        $currentTime=now();
        $registrationTime=strtotime($regTime);
        $timeDiff=(int)$currentTime-(int)$registrationTime;
        if(3600<$timeDiff){
            return true;
        }else{
            return false;
        }
    }

    public function login(){
        $data=[];
        // $data["validation"]=null;
        if(strtolower($this->request->getMethod())!=="post"){
            $data["validation"]=Services::validation();
            return view("login.php",$data);
        }
        $rules=[
            "email"=>[
                "rules"=>"required",
                "errors"=>[
                    "required"=>"This is a required field",
                ],
            ],
            "pwd"=>[
                "rules"=>"required",
                "errors"=>[
                    "required"=>"This is a required field",
                    // "min_length"=>"Password must at least be 8 characters in length",
                ],
            ],
        ];

        if(!$this->validate($rules)){
            $data["validation"]=$this->validator;
            return view("login.php",$data);
        }else{
            $email=$this->request->getVar("email");
            $password=$this->request->getVar("pwd");
            // $allowableLoginTimes=$this->throttler->check("login", 4, MINUTE);
            $userData=$this->loginModel->verifyEmail($email);
            // if($allowableLoginTimes){
            if($userData){
              if(password_verify($password,$userData["userPassword"])){
                if($userData["status"]=="active"){
                    $loginInfo=[
                        "uniId"=>$userData["uniId"],
                        "agent"=>$this->getUserAgentInfo(),
                        "ip"=>$this->request->getIPAddress(),
                        "login_time"=>date("Y-m-d h:i:s"),
                    ];
                    $la_id=$this->loginModel->saveLoginInfo($loginInfo);
                    if($la_id){
                        $this->session->set("logged_info",$la_id);
                    }
                    $this->session->set("logged_user",$userData["uniId"]);
                    return redirect()->to(base_url("dashboard"));
                }else{
                    $this->session->setTempdata("error","Your account needs activation. Contact Admin",3);
                    return redirect()->to(current_url());
                }
              }else{
                $this->session->setTempdata("error","Sorry password was incorrect",3);
                return redirect()->to(current_url());
              }
            }else{
                $this->session->setTempdata("error","Sorry user doesnot exist",3);
                return redirect()->to(current_url());
            }
        // }else{
        //         // $data["error"] = "Maximum number of allowable login times reached! Please try again after a minute";
        //         $this->session->setTempdata("error","Maximum number of allowable login times reached! Please try again after a minute",3);
        //         return redirect()->to(current_url());
        // }
        }
        // return view("login.php");
    }

    public function getUserAgentInfo(){
        $agent=$this->request->getUserAgent();
        if($agent->isBrowser()){
            $currentAgent=$agent->getBrowser();
        }elseif($agent->isRobot()){
            $currentAgent=$agent->getRobot();
        }elseif($agent->isMobile()){
            $currentAgent=$agent->getMobile();
        }else{
            $currentAgent="Unidentified User Agent";
        }

        return $currentAgent;
    }
}
