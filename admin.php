<?php 

session_start();

if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
    
    require ('connection.php');

$res=mysqli_query($conn,"select * from medicalissue");

if(!empty($_GET['file']))
{
	$filename = basename($_GET['file']);
	$filepath = 'uploads/' . $filename;
	if(!empty($filename) && file_exists($filepath)){

//Define Headers
		header("Cache-Control: public");
		header("Content-Description: FIle Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/zip");
		header("Content-Transfer-Emcoding: binary");

		readfile($filepath);
		exit;

	}
	else{
		echo "This File Does not exist.";
	}
}

?>



<html>

<head>
    <title>
        Admin page
    </title>

    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>


    <style>
    body {
        background-image: url('pic/cover.jpg');
       
    
    }

    .container {
        margin-top: 50px;
        background-color: rgba(156, 206, 249, 0.9);
        padding:20px;
        padding-top: 30px;
        padding-bottom: 20px;
        border-radius: 10px;
       
    }

    .adminform {
        margin-top: 50px;
        padding: 20px;
        background: #0b003b;
        border-radius: 13px;
       
    }

    .title {
        color: rgb(241, 241, 241);
        text-align: center;
        margin-top: 10px;
    }

    .form-group {
        margin-top: 20px;
        color: rgb(255, 255, 255);
    }
    
</style>


</head>

<body>

<h1 class="title">Details of Patients</h1>
  

   <div class="container" style="margin-top:40px;">
        <table class="table table-striped">
            <thead>
                <tr class="table-dark">
                    <th>Name</th>
                    <th>Index No</th>
                    <th>Intake</th>
                    <th>Department</th>
                    <th>Mobile No.</th>
                    <th>Description</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysqli_fetch_assoc($res)){?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['indexNo']?></td>
                    <td><?php echo $row['intake']?></td>
                    <td><?php echo $row['department']?></td>
                    <td><?php echo $row['mobile']?></td>
                    <td><?php echo $row['description']?></td>
                    <td><a href="admin.php?file=<?php echo $row['file']?>"><?php echo $row['file']?></a></td>
                </tr>
                <?php } ?>
                </thead>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
    </script>



<center>
    <a href="logout.php"> <button class="btn btn-warning">Logout</button> </a>
    <a href="index.php"> <button class="btn btn-warning">Back</button> </a>
</center>
                        
    
</body>



<??>

</html>
