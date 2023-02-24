<?php

include 'connection.php';

error_reporting(0);



$errors = []; // Store errors here




if (isset($_POST['submit'])) {
    // echo "<script>alert('Wow! User Registration Completed.')</script>";
    $fname = $_POST['stu_name'];
    $index = $_POST['stu_num'];
    $intake = $_POST['intake'];
    $dep = $_POST['province'];
    $mobile = $_POST['mobile'];
    $reason = $_POST['description'];

    $location = "uploads/";
    $file_new_name = date("dmy") . time() . $_FILES["file"]["name"]; // New and unique name of uploaded file
    $file_name = $_FILES["file"]["name"]; // Get uploaded file name
    $file_temp = $_FILES["file"]["tmp_name"]; // Get uploaded file temp
    $file_size = $_FILES["file"]["size"]; // Get uploaded file size


    if ($file_size > 10485760) { // Check file size 10mb or not
        echo "<script>alert('Woops! File is too big. Maximum file size allowed for upload 10 MB.')</script>";
    } else {
        $sql = "
                INSERT INTO `medicalissue`(`name`, `indexNo`, `intake`, `department`, `mobile`, `description`, `file`) VALUES 
        ('$fname', '$index', '$intake', '$dep', '$mobile', '$reason', '$file_name')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            move_uploaded_file($file_temp, $location . $file_name);
            echo "<script>alert('File uploaded successfully.')</script>";



            //Generate XML file

            $result1 = mysqli_query($conn, "Select * from medicalissue");
            if ($result1 > 0) {
                $xml = new DOMDocument("1.0");

                // It will format the output in xml format otherwise
                // the output will be in a single row
                $xml->formatOutput = true;
                $fitness = $xml->createElement("users");
                $xml->appendChild($fitness);
                while ($row = mysqli_fetch_array($result1)) {
                    $user = $xml->createElement("user");
                    $fitness->appendChild($user);

                    $uid = $xml->createElement("id", $row['id']);
                    $user->appendChild($uid);

                    $uname = $xml->createElement("name", $row['name']);
                    $user->appendChild($uname);

                    $email = $xml->createElement("indexNo", $row['indexNo']);
                    $user->appendChild($email);

                    $password = $xml->createElement("mobileNo", $row['mobile']);
                    $user->appendChild($password);
                    
                    $description = $xml->createElement("description", $row['description']);
                    $user->appendChild($description);

                    $file = $xml->createElement("file", $row['file']);
                    $user->appendChild($file);
                }
                // echo "<xmp>".$xml->saveXML()."</xmp>";
                $xml->save("xml/report.xml");
            }
        } else {
            echo "<script>alert('Woops! Something wong went.')</script>";
        }

        // header("Location:index.php");
    }
}

?>




<html>

<head>
    <title>
        Home page
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>


    <style>
        body {
            background-image: url('pic/cover.jpg');


        }

        .container {
            margin-top: 5px;
            background-color: transparent;

        }

        .regform {
            margin-top: 50px;
            padding: 20px;
            background: #0b003b;
            border-radius: 13px;

        }

        .title {
            color: rgb(241, 241, 241);
        }

        .form-group {
            margin-top: 20px;
            color: rgb(255, 255, 255);
        }

        .submit {
            margin-top: 20px;
        }



    </style>


</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">


                <div class="regform">
                    <center>
                        <h1 class="title">Enter your Detalis</h1>
                    </center>

                    <form method="POST" action="miform.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Student Name</label>
                                    <input type="text" name="stu_name" id="stu_name" class="form-control input-sm" placeholder="Username" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Index Number</label>
                            <input type="text" name="stu_num" id="stu_num" class="form-control input-sm" placeholder="Index Number" required>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="">Intake</label>
                                    <input type="text" name="intake" id="intake" class="form-control input-sm" placeholder="Intake" required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    Department:
                                    <select name="province" class="province" required>
                                        <option value="none">Select Your Department</option>
                                        <option value="IT">Information Technology</option>
                                        <option value="IS">Information System</option>
                                        <option value="QS">Quantity Surveying</option>
                                        <option value="SS">Servey Science</option>
                                        <option value="ARCHI">Architecture</option>
                                        <option value="Tech">Technology</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Mobile Number</label>
                            <input type="text" name="mobile" id="mobile" class="form-control input-sm" placeholder="Mobile Number" required>
                        </div>

                        <div class="row">
                            <div class="">
                                <div class="form-group">
                                    <label for="">Write a brief description about your illness</label>
                                    <input type="text" name="description" id="description" class="form-control input-sm" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="">
                                <div class="form-group">
                                    Please attached your medical prescriptions
                                    <input type="file" name="file" id="file">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <center>
                            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info btn-warning">
                            <a href="index.php"> <button class="btn btn-warning">Back</button> </a>
                        </center>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>





</html>