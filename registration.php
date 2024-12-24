 <!DOCTYPE html>
<html>
<?php
if(isset($_POST['s'])){
    $conn = mysqli_connect('localhost','root', '');
    if(!$conn)
    {
        die('could not connect: '.mysqli_error($conn));
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $u_name=$_POST['name'];
        $u_id=$_POST['email'];
        $u_pass=$_POST['password'];
        $u_addr=$_POST['adress'];
        $a_no=$_POST['aadhar_number'];
        $gen=$_POST['gender'];
        $mob=$_POST['mobile_number'];
       // $password=md5($u_pass);
       $reg="insert into user values('$u_name','$u_id','$u_pass','$u_addr','$a_no','$gen','$mob')";
        mysqli_select_db($conn,"crime_portal");
        $res=mysqli_query($conn,$reg);
        if(!$res)
        {
        $message1 = "User Already Exist";
        echo "<script type='text/javascript'>alert('$message1');</script>";
    }
            else
    {
        $message = "User Registered Successfully";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    }
}

?>
  
<script>
     function f1()
        {
            var sta=document.getElementById("name1").value;
            var sta1=document.getElementById("email1").value;
            var sta2=document.getElementById("pass").value;
            var sta3=document.getElementById("addr").value;
            var sta4=document.getElementById("aadh").value;
            var sta5=document.getElementById("mobno").value;
	   
  var x=sta.trim();
  var x1=sta1.indexOf(' ');
  var x2=sta2.indexOf(' ');
  var x3=sta3.trim();
  var x4=sta4.indexOf(' ');
	var x5=sta5.indexOf(' ');
	if(sta!="" && x==""){
		document.getElementById("name1").value="";
		document.getElementById("name1").focus();
		  alert("Space Not Allowed");
        }
        
         else if(sta1!="" && x1>=0){
    document.getElementById("email1").value="";
    document.getElementById("email1").focus();
      alert("Space Not Allowed");
        }
        else if(sta2!="" && x2>=0){
    document.getElementById("pass").value="";
    document.getElementById("pass").focus();
      alert("Space Not Allowed");
        }
        else if(sta3!="" && x3==""){
    document.getElementById("addr").value="";
    document.getElementById("addr").focus();
      alert("Space Not Allowed");
        }
        else if(sta4!="" && x4>=0){
    document.getElementById("aadh").value="";
    document.getElementById("aadh").focus();
      alert("Space Not Allowed");
        }
        else if(sta5!="" && x5>=0){
    document.getElementById("mobno").value="";
    document.getElementById("mobno").focus();
      alert("Space Not Allowed");
        }
}
</script>    
    
<head>
<title>User Registration</title>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
<link href="complainer_page.css" rel="stylesheet" type="text/css" media="all" />
<style>

    body {
    font-family: 'Lato', sans-serif;
    background-size: cover;
    background-image: url(rgistrationbg.jpg);
    background-position: center;
    color: #f0f0f0;
    margin: 0;
    padding: 0;
}

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

.video {
    margin-top: 7%;
    background-color: rgba(0, 0, 0, 0.8);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    max-width: 500px;
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
input[type="email"],
select {
    width: 90%;
    padding: 10px;
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
<head>
<body style="background-size: cover;
    background-image: url(rgistrationbg.jpg);
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
            <a class="navbar-brand" href="home.php"><b>Crime Management System</b></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <a class="navbar-brand" href="home.php">Home</li></a>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="userlogin.php">User Login  <i class="fa fa-user"></i></a></li>
            </ul>
        </div>
    </div>
</nav>
	
<div class="video"> 
	<div class="center-container">
		 <div class="bg-agile">
         <h3 style="color:#f0f0f0;">User registration</h3>
			<br>
			<div class="login-form">
                	
				<form action="#" method="post">
					<p>Full Name</p><input type="text"  name="name"  required="" id="name1" onfocusout="f1()" />
					<p>Email-Id</p><input type="email"  name="email"  required="" id="email1" onfocusout="f1()"/>
                    <p>Password</p><input type="text"  name="password"  placeholder="6 Character minimum" pattern=".{6,}" id="pass" onfocusout="f1()"/>
					<p>Home Adress</p><input type="text"  name="adress"  required="" id="addr" onfocusout="f1()"/>
					<p>Aadhar Number</p><input type="text"  name="aadhar_number" minlength="12" maxlength="12" required pattern="[123456789][0-9]{11}" id="aadh" onfocusout="f1()"/>
					<div class="left-w3-agile">
						<p>Gender</p><select class="form-control" name="gender">
							<option>Male</option>
							<option>Female</option>
							<option>Others</option>
						</select>
					</div>
					<div class="right-agileits">
						<p>Mobile</p><input type="text"  name="mobile_number" required pattern="[6789][0-9]{9}" minlength="10" maxlength="10" id="mobno" onfocusout="f1()"/>
					</div>
					<a href="userlogin.php"><input type="submit" value="Submit" name="s"></a>
				</form>	
			</div>	
		</div>
	</div>	
</div>	
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>