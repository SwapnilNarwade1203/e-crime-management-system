
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

	<title>Incharge Login</title>
  <style>
 .navbar {
            border-radius: 0;
            margin-bottom: 0;
            background: rgba(0, 0, 0, 0.9);
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

/* Body Styling */
body {
    background-image: url('locker.jpeg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: white;
    font-family: 'Lato', sans-serif;
}

/* Form Container Styling */
.form {
    background-color: rgba(0, 0, 0, 0.6);
    padding: 5px;
    border-radius: 8px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.8);
    margin-top: 12%;
    width: 32%;
}

/* Form Heading */
.form h1 {
  color: #0062E6;
  margin-bottom: 4px;
}

/* Input Fields Styling */
.form-group input {
    padding: 10px;
    border: 4px solid #dddddd;
    border-radius: 4px;
    width: 80%;
    background-color: rgba(255, 255, 255, 0.9);
    color: #333333;
    font-size: 16px;
}

.form-group input:focus {
    border-color: #0062E6;
    box-shadow: 0 0 8px rgba(0, 98, 230, 0.5);
}

/* Button Styling */
.btn-primary {
    background-color: #0062E6;
    border: none;
    padding: 10px 20px;
    font-size: 18px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 90%;
}

.btn-primary:hover {
    background-color: #004bb5;
}

</style>
   <?php
    
if(isset($_POST['s']))
{
    session_start();
    $_SESSION['x']=1;
    $conn=mysqli_connect("localhost","root","");
    if(!$conn)
    {
        die("could not connect".mysqli_error());
    }
    mysqli_select_db($conn,"crime_portal");
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST['email'];
        $pass=$_POST['password'];
        $result=mysqli_query($conn,"SELECT i_id,i_pass FROM police_station where i_id='$name' and i_pass='$pass' ");
        
        $_SESSION['email']=$name;
        if(mysqli_num_rows($result)==0)
        {
             $message = "Id or Password not Matched.";
             echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else 
        {
          header("location:incharge_complain_page.php");
        }
    }                
}
?> 
    <script>
    function f1()
    {
      var sta2=document.getElementById("exampleInputEmail1").value;
      var sta3=document.getElementById("exampleInputPassword1").value;
      var x2=sta2.indexOf(' ');
      var x3=sta3.indexOf(' ');
      if(sta2!="" && x2>=0)
      {
        document.getElementById("exampleInputEmail1").value="";
        document.getElementById("exampleInputEmail1").focus();
        alert("Space Not Allowed");
      }
      else if(sta3!="" && x3>=0)
      {
        document.getElementById("exampleInputPassword1").value="";
        document.getElementById("exampleInputPassword1").focus();
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
                <a class="navbar-brand"><b>Crime Management System</b></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                <li><a href="official_login.php">Office login<i class="fa fa-user"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
 <div align="center">
	<div class="form">
		 <form method="post">
  <div class="form-group" >
    <label for="exampleInputEmail1"  ><h1>Incharge Id</h1></label>
    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" size="5" placeholder="Enter user id" required onfocusout="f1()">
     </div>
  <div class="form-group">
    <label for="exampleInputPassword1"><h1>Password</h1></label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required onfocusout="f1()">
  </div>
  
  
  <button type="submit" class="btn btn-primary" name="s">Submit</button>
</form>
</div>


</body>
</html>