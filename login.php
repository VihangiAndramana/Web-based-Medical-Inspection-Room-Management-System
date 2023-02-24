<?php 

include 'connection.php';

session_start();

error_reporting(0);


if (isset($_SESSION['username'])) {
    header("Location: admin.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = ($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['email'];
		header("Location: admin.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}



        // $result1=mysqli_query($conn, "Select * from users");
        // if($result1>0){
        // $xml = new DOMDocument("1.0");
        
        // // It will format the output in xml format otherwise
        // // the output will be in a single row
        // $xml->formatOutput=true;
        // $fitness=$xml->createElement("users");
        // $xml->appendChild($fitness);
        // while($row=mysqli_fetch_array($result1)){
        //     $user=$xml->createElement("user");
        //     $fitness->appendChild($user);
            
        //     $uid=$xml->createElement("uid", $row['Id']);
        //     $user->appendChild($uid);
            
        //     $uname=$xml->createElement("uname", $row['Name']);
        //     $user->appendChild($uname);
            
        //     $email=$xml->createElement("email", $row['email']);
        //     $user->appendChild($email);
            
        //     $password=$xml->createElement("password", $row['password']);
        //     $user->appendChild($password);
           
            
        // }
        // // echo "<xmp>".$xml->saveXML()."</xmp>";
        // $xml->save("report.xml");  


?>

<html>

<head>
    <title>Login</title>
    <!-- Link to css -->
    <link rel="stylesheet" type="text/css" href="assets/css/stylelog.css">
</head>

<body>
    <!-- Main Body  -->
    <div class="body">
        <!-- login form -->
        <div class="form-boxl">
            <img src="assets/img/log/z_pXX-KDU.png" class="logo">
            <h1 class="h1">Admin Login</h1>

            <form id="Login" class="input-group" action="login.php" method="POST">
                <input class="input-field" type="email" placeholder="Enter Email" name="email"
                    value="<?php echo $email; ?>" required>
                <input type="password" class="input-field" placeholder="Enter Password" name="password"
                    value="<?php echo $_POST['password']; ?>" required><br>
                <input type="checkbox" class="check-box"><span>Rember Passowrd</span>
                <button type="submit" name="submit" class="submit-btn">Log In</button>


            </form>



        </div>
    </div>

</body>

</html>
?>