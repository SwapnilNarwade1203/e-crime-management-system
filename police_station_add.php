<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['x'])) {
    header("location:headlogin.php");
}

$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    die('could not connect: ' . mysqli_error());
}

if (isset($_POST['s'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $loc = $_POST['location'];
        $i_name = $_POST['incharge_name'];
        $i_id = $_POST['incharge_id'];
        $u_pass = $_POST['password'];

        $reg = "INSERT INTO police_station VALUES('$i_id','$i_name','$loc','$u_pass')";
        mysqli_select_db($conn, "crime_portal");
        $res = mysqli_query($conn, $reg);
        if (!$res) {
            $message1 = "User Already Exists";
            echo "<script type='text/javascript'>alert('$message1');</script>";
        } else {
            $message = "Police Station Added Successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>

<head>
    <title>Log Police Station</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-size: cover;
            background-image: url(home_bg1.jpeg);
            background-position: center;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styles */
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

        .video {
            margin-top: 10%;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .login-form {
            color: gray;
            text-align: left;
        }

        .login-form h2 {
            color: #fff;
            font-weight: bold;
            font-size: 26px;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #444;
            color: #fff;
            font-size: 16px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .warning-section {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.5;
            background-color: rgba(255, 0, 0, 0.8);
            padding: 15px;
            border-radius: 5px;
        }

        .warning-section h4 {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .warning-section blockquote {
            margin: 0;
            padding: 0 15px;
            border-left: 5px solid #fff;
        }
    </style>
    <script>
        function f1() {
            var sta = document.getElementById("station").value;
            var sta1 = document.getElementById("iname").value;
            var sta2 = document.getElementById("iid").value;
            var sta3 = document.getElementById("pas").value;

            var x = sta.trim();
            var x2 = sta2.indexOf(' ');
            var x1 = sta1.trim();
            var x3 = sta3.indexOf(' ');

            if (sta != "" && x == "") {
                document.getElementById("station").value = "";
                document.getElementById("station").focus();
                alert("Space Not Allowed");
            } else if (sta1 != "" && x1 == "") {
                document.getElementById("iname").value = "";
                document.getElementById("iname").focus();
                alert("Space Not Allowed");
            } else if (sta2 != "" && x2 >= 0) {
                document.getElementById("iid").value = "";
                document.getElementById("iid").focus();
                alert("Space Not Allowed");
            } else if (sta3 != "" && x3 >= 0) {
                document.getElementById("pas").value = "";
                document.getElementById("pas").focus();
                alert("Space Not Allowed");
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
                <a class="navbar-brand" href=""><b>Crime Management System</b></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="headdashboard1.php">HQ Dashboard</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="police_station_add.php">Log Police Station</a></li>
                    <li><a href="h_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="video">
        <div class="center-container">
            <div class="bg-agile">
                <div class="login-form">
                    <h2>Log Police Station</h2>
                    <form method="post">
                        Police Station Location
                        <input type="text" name="location" placeholder="Station Location" required="" id="station" onfocusout="f1()" />
                        Incharge Name
                        <input type="text" name="incharge_name" placeholder="Incharge Name" required="" id="iname" onfocusout="f1()" />
                        Incharge Id
                        <input type="text" name="incharge_id" placeholder="Incharge Id" required="" id="iid" onfocusout="f1()" />
                        <br>
                        Password
                        <input type="password" name="password" placeholder="Password" required="" id="pas" onfocusout="f1()" />
                        <input type="submit" value="Submit" name="s">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
