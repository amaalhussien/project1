<?php

$errors=array();

function redicrt($url){
    header("location:".$url);
     
    exit();
}

function error_msg_login(){

    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Warning!</strong>cann’t login .";
    $emsg.="</div>";

   
    return($emsg);


}