<!DOCTYPE html>
<html>
<head>
<?php    
if(isset($_POST['s']))
{
    session_start();
    $_SESSION['x']=1;
    $conn=mysqli_connect("localhost","root","");
    if(!$conn)
    {
        die("could not connect".mysqli_error($conn));
    }
    mysqli_select_db($conn,"crime_portal");
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST['email'];
        $pass=$_POST['password'];
	      $query = "SELECT u_id,u_pass FROM user where u_id='$name' and u_pass='$pass'";
        $result=mysqli_query($conn,$query);
          $u_id=$_POST['email'];
          $_SESSION['u_id']=$u_id;
   
        
        if(mysqli_num_rows($result)==0)
        {
             $message = "Id or Password not Matched.";
             echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else 
        {
          header("location:complainer_page.php");
        }
    }                
}
?> 
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    
    <script>
     function f1()
        {
            var sta2=document.getElementById("exampleInputEmail1").value;
            var sta3=document.getElementById("exampleInputPassword1").value;
          var x2=sta2.indexOf(' ');
var x3=sta3.indexOf(' ');
    if(sta2!="" && x2>=0){
    document.getElementById("exampleInputEmail1").value="";
    document.getElementById("exampleInputEmail1").focus();
      alert("Space Not Allowed");
        }
        else if(sta3!="" && x3>=0){
    document.getElementById("exampleInputPassword1").value="";
    document.getElementById("exampleInputPassword1").focus();
      alert("Space Not Allowed");
        }

}
    </script>
    
	<title>Complainant Login</title>
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
            background: linear-gradient(to right, #0062E6, #33AEFF);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form {
            background-color: rgba(0,0,0,0.5);
            
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(60, 60, 60, 0.5);
            padding: 20px;
            width: 100%;
            max-width: 400px;
            margin-top: 5%;
            text-align: center;
        }
        .form h1 {
            color: whitesmoke;
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
            box-shadow: 0 0 5px rgba(0, 98, 230, 0.5);
        }
        .btn {
            background-color: darkgray;
            opacity: 1;
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
        </style>
</head>
<body style="background-size: cover;
    background-image: url(home_bg1.jpeg);
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
            <a class="navbar-brand" href="home.php"><b>Crime Portal</b></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <a class="navbar-brand" href="home.php">Home</li></a>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="registration.php">User Registration  <i class="fa fa-user"></i></a></li>
            </ul>
        </div>
    </div>
</nav>

    <div class="form">
        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1"><h1><b>User Id</b></h1></label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email id" required name="email" onfocusout="f1()">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"><h1><b>Password</b></h1></label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required name="password" onfocusout="f1()">
            </div>
            <button type="submit" class="btn" name="s" onclick="f1()">Submit</button>
        </form>
    </div>

<div style="position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: rgba(0,0,0,0.7);
   color: white;
   text-align: center;">
</div>

</body>
</html>