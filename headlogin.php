<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="styles.css">
    <?php
    if(isset($_POST['s'])) {
        session_start();
        $_SESSION['x'] = 1;
        $conn = mysqli_connect("localhost", "root", "");
        if(!$conn) {
            die("Could not connect: ". mysqli_error($conn));
        }
        mysqli_select_db($conn, "crime_portal");
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['email'];
            $pass = $_POST['password'];
            $result = mysqli_query($conn, "SELECT h_id, h_pass FROM head WHERE h_id='$name' AND h_pass='$pass'");
            
            if(mysqli_num_rows($result) == 0) {
                $message = "Id or Password not Matched.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                header("Location: headdashboard1.php");
            }
        }                
    }
    ?> 
</head>
<style>
body {
    font-family: 'Lato', sans-serif;
    background: url('home_bg1.jpeg') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
    color: #333;
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

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 40px); 
}

.form-container {
    background: rgba(0,0,0, 0.5);
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.form-container h1 {
    color: #0062E6;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-size: 18px;
    color: #333;
}

.form-control {
    border-radius: 4px;
    border: 1px solid #ddd;
    padding: 10px;
    box-sizing: border-box;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.form-control:focus {
    border-color: #0062E6;
    box-shadow: 0 0 5px rgba(0, 98, 230, 0.5);
}

.btn-primary {
    background-color: #0062E6;
    border: none;
    padding: 10px;
    border-radius: 4px;
    font-size: 16px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.btn-primary:hover {
    background-color: #004bb5;
}
</style>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><b>Crime Management System</b></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="official_login.php">Official Login</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="head_reg.php">Head Registration <i class="fa fa-user"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h1>HQ Login</h1>
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1"><h4>HQ Id</h4></label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter user id" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"><h4>Password</h4></label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="s">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
