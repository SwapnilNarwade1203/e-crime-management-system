<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['x'])) {
    header("location:userlogin.php");
}

$conn = mysqli_connect("localhost", "root", "");
if (!$conn) {
    die("could not connect" . mysqli_error());
}
mysqli_select_db($conn, "crime_portal");

$u_id = $_SESSION['u_id'];
$result = mysqli_query($conn, "SELECT a_no FROM user WHERE u_id='$u_id'");
$q2 = mysqli_fetch_assoc($result);
$a_no = $q2['a_no'];

$result1 = mysqli_query($conn, "SELECT u_name FROM user WHERE u_id='$u_id' ");
$q2 = mysqli_fetch_assoc($result1);
$u_name = $q2['u_name'];

if (isset($_POST['s'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $location = $_POST['location'];
        $type_crime = $_POST['type_crime'];
        $d_o_c = $_POST['d_o_c'];
        $description = $_POST['description'];

        $var = strtotime(date("Ymd")) - strtotime($d_o_c);

        if ($var >= 0) {
            $comp = "INSERT INTO complaint(a_no, location, type_crime, d_o_c, description) VALUES('$a_no','$location','$type_crime','$d_o_c','$description')";
            mysqli_select_db($conn, "crime_portal");
            $res = mysqli_query($conn, $comp);

            if (!$res) {
                $message1 = "Complaint already filed";
                echo "<script type='text/javascript'>alert('$message1');</script>";
            } else {
                $message = "Complaint Registered Successfully";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        } else {
            $message = "Enter Valid Date";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>

<script>
    // Show alert when the page is loaded
    window.onload = function () {
        alert("Warning: Filing a fake complaint is a serious offense. It can lead to legal consequences, including fines and imprisonment. Please ensure the accuracy of your claims.");
    };

    function f1() {
        var sta1 = document.getElementById("desc").value;
        var x1 = sta1.trim();
        if (sta1 != "" && x1 == "") {
            document.getElementById("desc").value = "";
            document.getElementById("desc").focus();
            alert("Space Found");
        }
    }
</script>

<head>
    <title>Complainer Home Page</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-size: cover;
            background-image: url(complainbg1.png);
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
        input[type="date"],
        select,
        textarea {
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
                <a class="navbar-brand" href="home.php"><b>Crime Portal</b></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="complainer_page.php">Log New Complaint</a></li>
                    <li><a href="complainer_complain_history.php">Complaint History</a></li>
                    <li><a href="logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="video">
        <div class="center-container">
            <div class="bg-agile">
                <div class="login-form">
                    <h2>Welcome <?php echo "$u_name" ?></h2>
                    <h2 style="font-size: 20px;">Log New Complaint</h2>
                    <form action="#" method="post">
                        Aadhar
                        <input type="text" name="aadhar_number" placeholder="Aadhar Number" required="" disabled value=<?php echo "$a_no"; ?>>

                        <div class="top-w3-agile">Location of Crime
                            <select class="form-control" name="location" required>
                                <?php
                                $r = "SELECT location FROM police_station";
                                $loc = mysqli_query($conn, $r);
                                while ($row = mysqli_fetch_array($loc)) {
                                ?>
                                    <option> <?php echo $row[0]; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="top-w3-agile">Type of Crime
                            <select class="form-control" name="type_crime" required>
                                <option>Theft</option>
                                <option>Robbery</option>
                                <option>Pick Pocket</option>
                                <option>Murder</option>
                                <option>Rape</option>
                                <option>Molestation</option>
                                <option>Kidnapping</option>
                                <option>Missing Person</option>
                            </select>
                        </div>
                        <div class="Top-w3-agile">
                            Date Of Crime : &nbsp &nbsp
                            <input type="date" name="d_o_c" required>
                        </div>
                        <br>
                        <div class="top-w3-agile">Description
                            <textarea name="description" rows="4" cols="50" id="desc" placeholder="Description" onfocusout="f1()" required></textarea>
                        </div>
                        <input type="submit" value="Submit" name="s">
                    </form>
                    <div class="warning-section">
                        <h4>Important Notice:</h4>
                        <blockquote>"Filing a false complaint is an offense punishable under Section 182 of the Indian Penal Code. 
                            Punishment may include imprisonment for a term which may extend to six months, or with a fine which may extend to one thousand rupees, or with both."
                        </blockquote>
                        <p>Please ensure that your complaint is genuine to avoid legal repercussions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
