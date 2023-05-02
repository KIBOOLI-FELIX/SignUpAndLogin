<?php
function messageAlert($session){
  if(isset($session)){
    if($session->getTempdata("success")){
      echo $session->getTempdata("success");
    }elseif($session->getTempdata("error")){
      echo $session->getTempdata("error");
    }
  }else
  {
    echo "No session data detected";
  }
}
?>