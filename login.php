<?php

$sendIt=new stdClass;
$mail=$_POST['mail'];
$password=md5($_POST['password']);
$sendIt->status=false;
$sendIt->message="Technical Issue";
include "db_config.php";
$sql="SELECT * FROM users WHERE email='{$mail}'";
$result=mysqli_query($conn,$sql);
if($result)
{
    if(mysqli_num_rows($result)>0)
    {
        $data=mysqli_fetch_assoc($result);
        if($data['passkey']==$password)
        {
            $sendIt->status=true;
            $sendIt->message="Successfull";
        }else{
            $sendIt->status=false;
            $sendIt->message="Wrong Password";
        }
        
    }else{
        $sendIt->status=false;
        $sendIt->message="User not registered";
    }
}


   
echo  json_encode($sendIt);
?>