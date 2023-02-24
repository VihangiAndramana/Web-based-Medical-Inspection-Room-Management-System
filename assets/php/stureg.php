<?php
     $idno = $_POST['idno'];
     $name = $_POST['name'];
     $email = $_POST['email'];
     $dep = $_POST['dep'];
     $intake = $_POST['intake'];
     $mobile = $_POST['mobile']; 
     $uname = $_POST['uname'];
     $pword = $_POST['pword'];

     //

     
    $conn = new mysqli('localhost','root','','login');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into stureg(idno,name,email,dep,intake,mobile,uname,pword)
        values(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssiiss", $idno, $name, $email, $dep, $intake, $mobile, $uname, $pword);
        $stmt->execute();
        echo "Registered Successfully... ";
        $stmt->close();
        $conn->close();
    }
      
?>