<?php
$conn=mysqli_connect( 'localhost', 'root', '', 'vuecurd' );
if ($conn->connect_errno){
    die("Data Base Conneted Problem");
}
$response=["error"=>false];
switch($_GET['action'])
{
    case "read" :
        $users=array();
        $result=mysqli_query($conn,"SELECT * FROM tbl_user");
        while ($row=mysqli_fetch_assoc($result)){
            array_push($users,$row);
        }
       $response["users"]=$users;

        break;
    case "update" :
        $id=$_POST['id'];
        $name  =$_POST['name'];
        $email =$_POST['email'];
        $phone =$_POST['phone'];
        $query=mysqli_query($conn,"UPDATE tbl_user SET name='$name',email='$email',phone='$phone' WHERE id='$id'" );
        if ($query){
            $response["message"]="Data Update Success!!";
        }else{
            $response["error"]=true;
            $response["message"]="Data Update failed!!";
        }

        break;
    case "create" :
       $name  =$_POST['name'];
       $email =$_POST['email'];
       $phone =$_POST['phone'];
       $query=mysqli_query($conn,"INSERT INTO tbl_user(name,email,phone) VALUES('$name','$email','$phone')");
       if ($query){
           $response["message"]="Data Save Success!!";
       }else{
           $response["error"]=true;
           $response["message"]="Data Save failed!!";
       }

        break;
    case "delete" :
        $id=$_POST['id'];
        $query=mysqli_query($conn,"DELETE FROM tbl_user WHERE id='$id'");
        if ($query){
            $response["message"]="Data Deleted Success!!";
        }else{
            $response["error"]=true;
            $response["message"]="Data Deleted failed!!";
        }

        break;
    default :
        echo "";
        break;
}
echo json_encode($response);

?>