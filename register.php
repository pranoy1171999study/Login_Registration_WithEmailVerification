<?php
 include "db_config.php";

        $mail=mysqli_real_escape_string($conn,$_POST['mail']);
        $password=mysqli_real_escape_string($conn,md5($_POST['password']));
        $fname=mysqli_real_escape_string($conn,$_POST['fname']);
        $lname=mysqli_real_escape_string($conn,$_POST['lname']);
        $dob=mysqli_real_escape_string($conn,$_POST['dob']);
        $country=mysqli_real_escape_string($conn,$_POST['country']);

        $sendIt=new stdClass;
        $sendIt->status=false;
        $sendIt->message="Technical issue";
       

        $sql="SELECT * FROM users WHERE email='{$mail}'";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
                if(mysqli_num_rows($result)>0)
                {
                        $sendIt->message="mail already exists";
                }
                else
                {
                        $sql="INSERT INTO users(fname,lname,email,passkey,dob,country)
                        VALUES
                        ('{$fname}','{$lname}','{$mail}','{$password}','{$dob}','{$country}');";
                        $result=mysqli_query($conn,$sql);

                        if($result)
                        {
                                $sendIt->status=true;
                                $sendIt->message="registration successfull🥰🥰";
                                mysqli_close($conn);
                        }
                        else{
                                $sendIt->message="Technical issue";

                        }
                }
        }
        else{
                $sendIt->message="Technical issue";
        }

        echo  json_encode($sendIt);
        

?>