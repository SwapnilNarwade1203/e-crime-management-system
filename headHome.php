<!DOCTYPE html>
<html lang="en">
<head>

<?php
session_start();
    if(!isset($_SESSION['x']))
        header("location:headlogin.php");
    
    $conn=mysqli_connect("localhost","root","");
    if(!$conn)
    {
        die("could not connect".mysqli_error());
    }
    mysqli_select_db($conn,"crime_portal");
    
    if(isset($_POST['s1']))
    {
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $cid=$_POST['cid'];
        $_SESSION['cid']=$cid;
        header("location:head_case_details.php");
    }
    }
    
    if(isset($_POST['s2']))
    {
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $loc=$_POST['loc'];
        $_SESSION['loc']=$loc;
        header("location:headHome1.php");
    }
    }
    
?>

	<title>HQ Homepage</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-image: url('search1.jpeg');
            background-size: cover;
            background-position: center;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .navbar {
            border-radius: 0;
            margin-bottom: 0;
            background: rgba(0, 0, 0, 0.8);
        }

        .navbar-brand {
            color: #fff !important;
        }

        .navbar-nav > li > a {
            color: #fff !important;
        }

        .navbar-nav > li > a:hover {
            color: #ddd !important;
        }

        .navbar-nav > li.active > a {
            background-color: #222;
            color: white !important;
        }

        form {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
            width: 400px;
            margin: auto;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #444;
            color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        select.form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #444;
            color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        form div {
            text-align: center;
        }

        @media (max-width: 768px) {
            form {
                width: 90%;
            }
        }
    </style>
    
    <script>
        function f1() {
            var sta2 = document.getElementById("ciid").value;
            var x2 = sta2.indexOf(' ');

            if (sta2 != "" && x2 >= 0) {
                document.getElementById("ciid").value = "";
                alert("Blank Field Not Allowed");
            }
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><b>Crime Management System</b></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="headdashboard1.php">HQ Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="headHome.php">View Complaints</a></li>
                    <li><a href="h_logout.php">Logout &nbsp<i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div style="margin-top: 100px;">
        <form method="post">
            <input type="text" name="cid" placeholder="Complaint Id" id="ciid" onfocusout="f1()" required>
            <div>
                <input class="btn btn-primary" type="submit" value="Search" name="s1">
            </div>
        </form>

        <form method="post" style="margin-top: 40px;">
            <select name="loc" class="form-control">
                <?php
                $r = "select location from police_station";
                $loc = mysqli_query($conn, $r);
                while ($row = mysqli_fetch_array($loc)) {
                ?>
                    <option><?php echo $row[0]; ?></option>
                <?php
                }
                ?>
            </select>
            <div>
                <input class="btn btn-primary" type="submit" value="Search" name="s2">
            </div>
        </form>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
