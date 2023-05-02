<?php
namespace App\Filters;
use  CodeIgniter\Filters\FilterInterface;
use  CodeIgniter\HTTP\RequestInterface;
use  CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class IpBlocker implements FilterInterface{
  public function before(RequestInterface $request,$arguments=null){
    $iPBlocker = Services::throttler();
      $allowableLoginTimes=$iPBlocker->check("login", 4, MINUTE);
    // if($iPBlocker->check("test",4,MINUTE)===false){
    //   return Services::response()->setStatusCode(429);
    // }
    if($allowableLoginTimes){

    }else{
      return Services::response()->setStatusCode(429);
    }
  }
  public function after(RequestInterface $request,ResponseInterface $response,$arguments=null){
    ;
  }
}