<!DOCTYPE html>
<html>
<head>
    <title>Crime Management System</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background: url('home_bg1.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding-top: 70px; /* Space for fixed navbar */
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
        .content {
            text-align: center;
            padding: 60px;
            background: rgba(60, 60, 60, 0.5);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin: 50px auto;
            max-width: 600px;
        }
        .content b{
            color:aqua
        }
        .content h1 b{
            color:white
        }
        .content h1 {
            color: #333;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .content h3 {
            color: #555;
            font-weight: 400;
            margin-bottom: 30px;
        }
        .btn-lg {
            background-color: #007bff;
            color: #fff;
            border-radius: 30px;
            padding: 15px 30px;
            text-transform: uppercase;
            font-weight: 700;
            border: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-lg:hover {
            background-color: #0056b3;
            color: #fff;
            transform: scale(1.05);
        }
        .fa-hand-o-down {
            color: #007bff;
        }
        .fa-hand-o-down:hover {
            color: #0056b3;
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
            <a class="navbar-brand" href="home.php"><b>Crime Management System</b></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            
            <ul class="nav navbar-nav navbar-right">
                <li><a href="userlogin.php">User Login  <i class="fa fa-user"></i></a></li>
                <li><a href="official_login.php" id="officialLogin">Official Login  <i class="fa fa-user"></i></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" >
    <div class="row">
        <div class="col-lg-12">
            <div class="content">
                <h1><b>Have a Complaint?</b></h1>
                <h3><b>Register Below &nbsp &nbsp</b><i class="fa fa-hand-o-down" aria-hidden="true"></i></h3>
                <hr>
                <a href="registration.php" class="btn btn-lg" role="button" aria-pressed="true">Sign Up!</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
    document.getElementById('officialLogin').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        var confirmation = confirm('This section is only for authorized personnel. Do you wish to proceed?');
        if (confirmation) {
            window.location.href = 'official_login.php'; // Proceed to the official login page if confirmed
        }
    });
</script>
    
</body>
</html>
