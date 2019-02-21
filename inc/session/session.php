<?php

if(!isset($_SESSION)){
    session_start();

}?>
<?php
function msg(){
    if(isset($_SESSION['msg']))
    {
        $msge=$_SESSION['msg'];
        $_SESSION['msg']=null;
        return $msge;
    }
}

function er()
{
    if(isset($_SESSION['errors'])){
        $err=$_SESSION['errors'];
        $_SESSION['errors']=null;
        return $err;

    }
   
}
?>