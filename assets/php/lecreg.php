<?php
     $idnol = $_POST['idnol'];
     $namel = $_POST['namel'];
     $emaill = $_POST['emaill'];
     $depl = $_POST['depl'];
     $mobilel = $_POST['mobilel']; 
     $unamel = $_POST['unamel'];
     $pwordl = $_POST['pwordl'];
     //

     
    $conn = new mysqli('localhost','root','','login');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into lecreg(idno,name,email,dep,mobile,uname,pword)
        values(?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssiss", $idnol, $namel, $emaill, $depl, $mobilel, $unamel, $pwordl);
        $stmt->execute();
        echo "Register Successfully... ";
        $stmt->close();
        $conn->close();
    }
      
?>