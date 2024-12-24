<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <title>Police Login</title>
    <style>
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
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #333);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form {
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.8);
            padding: 10px;
            width: 100%;
            max-width: 400px;
            text-align: top;
        }
        .form h2 {
            color: #0062E6;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }
        .form-group label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
        }
        .form-group input:focus {
            border-color: #0062E6;
            box-shadow: 0 0 5px rgba(0, 98, 230, 0.0);
        }
        .btn {
            background-color: #0062E6;
            color: whitesmoke;
            border: none;
            padding: 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        .btn:hover {
            background-color: #004bb5;
        }
      
    </style>
    <script>
        function validateInput() {
            var email = document.getElementById("exampleInputEmail1").value;
            var password = document.getElementById("exampleInputPassword1").value;
            var hasSpaceEmail = email.indexOf(' ') >= 0;
            var hasSpacePassword = password.indexOf(' ') >= 0;

            if (hasSpaceEmail) {
                document.getElementById("exampleInputEmail1").value = "";
                document.getElementById("exampleInputEmail1").focus();
                alert("Space Not Allowed in Email");
            }
            if (hasSpacePassword) {
                document.getElementById("exampleInputPassword1").value = "";
                document.getElementById("exampleInputPassword1").focus();
                alert("Space Not Allowed in Password");
            }
        }
    </script>
    <?php
    if(isset($_POST['s'])) {
        session_start();
        $_SESSION['x'] = 1;
        $conn = mysqli_connect("localhost", "root", "");
        if(!$conn) {
            die("Could not connect: " . mysqli_error($conn));
        }
        mysqli_select_db($conn, "crime_portal");
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['email'];
            $pass = $_POST['password'];
            $result = mysqli_query($conn, "SELECT p_id, p_pass FROM police WHERE p_id='$name' AND p_pass='$pass'");
            $_SESSION['pol'] = $name;
            if(mysqli_num_rows($result) == 0) {
                $message = "Id or Password not Matched.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                header("location:police_pending_complain.php");
            }
        }
    }
    ?>
</head>
<body style="background-size: cover;
    background-image: url(investigation.jpg);
    background-position: center;">
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
                    <li><a href="home.php">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="official_login.php">Office login<i class="fa fa-user"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="form" style="background-image: url(); background-size: cover; background-repeat: no-repeat;">
        <form method="post" onsubmit="validateInput()">
            
            <div class="form-group">
                <label for="exampleInputEmail1"><h2>POLICE LOGIN</h2></label>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter user id" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"><h1></h1></label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="s">Submit</button>
        </form>
    </div>

</body>
</html>
