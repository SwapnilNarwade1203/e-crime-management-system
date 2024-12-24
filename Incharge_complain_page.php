<!DOCTYPE html>
<html>
<head>
    
    <?php
    session_start();
    if(!isset($_SESSION['x']))
        header("location:inchargelogin.php");
    
    $conn=mysqli_connect("localhost","root","");
    if(!$conn)
    {
        die("could not connect".mysqli_error());
    }
    mysqli_select_db($conn,"crime_portal");
    
    $i_id=$_SESSION['email'];
    $result1=mysqli_query($conn,"SELECT location FROM police_station where i_id='$i_id'");
    $q2=mysqli_fetch_assoc($result1);
    $location=$q2['location'];
    
    if(isset($_POST['s2']))
    {
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $cid=$_POST['cid'];
        
        $_SESSION['cid']=$cid;
        $qu=mysqli_query($conn,"select inc_status,location from complaint where c_id='$cid'");
        
        $q=mysqli_fetch_assoc($qu);
        $inc_st=$q['inc_status'];
        $loc=$q['location'];
        
        if(strcmp("$loc","$location")!=0)
        {
            $msg="Case Not of your Location";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
        else if(strcmp("$inc_st","Unassigned")==0)
        {   
            header("location:Incharge_complain_details.php");
            
        }
        else{
            header("location:incharge_complain_details1.php");
        }
    }
    }
    
    $query="select c_id,type_crime,d_o_c,location,inc_status,p_id from complaint where location='$location' order by c_id desc";
    $result=mysqli_query($conn,$query);  
    ?>

    <title>Incharge Homepage</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    
    <script>
     function f1()
        {
          var sta2=document.getElementById("ciid").value;
          var x2=sta2.indexOf(' ');
     if(sta2!="" && x2>=0)
     {
        document.getElementById("ciid").value="";
        alert("Blank Field not Allowed");
      }       
}
</script>

    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #dfdfdf;
            color: #333;
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

        input[type="text"] {
            width: 150px;
            padding: 10px;
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .table {
            margin-top: 30px;
            background-color: white;
            color: black;
        }

        .table thead {
            background-color: black;
            color: white;
        }

        .table tbody {
            background-color: white;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
        }

    </style>
    
</head>
<body>
    <nav  class="navbar navbar-default navbar-fixed-top">
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
                    <li class="active"><a href="Incharge_complain_page.php">View Complaints</a></li>
                    <li><a href="incharge_view_police.php">Police Officers</a></li>
                    <li><a href="inc_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <form style="margin-top:7%; margin-left: 30%;" method="post">
        <input type="text" name="cid" placeholder="Complaint Id" id="ciid" onfocusout="f1()" required>
        <div>
            <input class="btn btn-primary" type="submit" value="Search" name="s2">
        </div>
    </form>
    
    <div style="padding:50px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Complaint Id</th>
                    <th>Type of Crime</th>
                    <th>Date of Crime</th>
                    <th>Location</th>
                    <th>Complaint Status</th>
                    <th>Police ID</th>
                </tr>
            </thead>
            <tbody>
                <?php while($rows=mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $rows['c_id'];?></td>
                        <td><?php echo $rows['type_crime'];?></td>
                        <td><?php echo $rows['d_o_c'];?></td>
                        <td><?php echo $rows['location'];?></td>
                        <td><?php echo $rows['inc_status']; ?></td>
                        <td><?php echo $rows['p_id']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
