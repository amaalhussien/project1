<?php
//Get title



function getTitle() {

    global $pageTitle;

    if (isset($pageTitle)) {

        echo $pageTitle;

    } else {

        echo 'Default';

    }
}


 $errors=array();
/*redicrt to page */
       function redicrt($url){
       header("location:".$url);
     
         exit();
}
//message error to lgin
function error_msg_login(){

    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>!!</strong>cann’t login .";
    $emsg.="Please enter your user_name and password correctly";
    $emsg.="</div>";

   
    return($emsg);


}



function error_msg_edit(){   
    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>!!</strong>cann’t Edit .";
    $emsg.="not found user id";
    $emsg.="</div>";

   
    return($emsg);
}

//Access checks

function check_login(){
    if(!(isset($_SESSION['admin_id'])&&$_SESSION['type']==1)){
        redicrt('index.php');
    }
}
function exist(){
    if(isset($_SESSION['admin_id'])&&$_SESSION['type']==1){
        redicrt('dashboard.php');
    }
}



//check empty
function secusse_msg_Edit(){
    $emsg="<div class='alert alert-success alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Success!</strong>Successful Edit.";
    $emsg.="</div>";

   
    return($emsg);


}

function error_msg_change(){   
    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>!!</strong>cann’t Edit .";
    $emsg.="Please change the information to be changed.";
    $emsg.="</div>";

   
    return($emsg);
}

function check_empty($data){
    global $errors;
    $data=trim($data);
    if(isset($data)==true && $data===''){
        $errors['empty']="empty fielad";

    }else{
        return $data;

    }
}


function errors_function($errors=array())
{
   if(!empty($errors)){

    foreach ($errors as $key => $value) {
     echo"<div class='alert alert-danger alert-dismissible'>";
     echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
     echo "<strong>Warning!</strong> worng {$key}=>${value}.";
     echo "</div>";
    }

}
}

function check_input_admin($data){
    $data=str_replace("-"," ",$data);
    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

function check_lenghtpass($data,$max,$min){
global $errors ;
if(strlen($data)<$min)
{
   $errors['tooshort']="password is short ";

}elseif(strlen($data)>$max){
   $errors['toolong']="password is long";

}else{
   return $data;
}
}


function secusse_msg_admin(){
    $emsg="<div class='alert alert-success alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Success!</strong>Successful  Add admin.";
    $emsg.="</div>";



   
    return($emsg);

} 




function secusse_msg_delete(){
    $emsg="<div class='alert alert-success alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Success!</strong>Successful delete.";
    $emsg.="</div>";

   
    return($emsg);


}
 //function check item
 
 function checkItem($select, $from, $value) {

    global $conn;
    $query="SELECT $select FROM $from WHERE $select= '$value' ";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    return $count;
    


}//check adminstarter
function checkadmin($select,$from,$value,$type,$value2){
    global $conn;
    $query="SELECT $select FROM $from WHERE $select= '$value' AND $type='$value2'";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    return $count;
}

//check count 
function countItems($item,$tabel){
    global $conn;
    $sql="SELECT id FROM admin";
    $result=mysqli_query($conn,$sql);
    return mysqli_num_rows($result) ;;
    
}




function error_msg_add()
{
    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Warning!</strong>Username exists.";
    $emsg.="</div>";

   
    return($emsg);
}

function error_msg_delete(){
    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Warning!</strong>cann’t delete.";
    $emsg.="</div>";

   
    return($emsg);

}

function error_msg_admin(){

    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Warning!</strong>cann’t add admin.";
    $emsg.="</div>";

   
    return($emsg);
}
function getLatest($select, $table, $order, $limit = 5) {
    global $conn;
    $query="SELECT $select FROM $table ORDER BY $order  DESC LIMIT $limit ";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
    return $row;
}

function secusse_msg_activate()
{
    $emsg="<div class='alert alert-success alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Success!</strong>Successful activate .";
    $emsg.="</div>";

   
    return($emsg);
   
}

function error_msg_activate()
{
    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Warning!</strong>cann’t activate.";
    $emsg.="</div>";

   
    return($emsg); 
}