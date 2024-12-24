<!DOCTYPE html>
<html>
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
    
    $query="select i_id,i_name,location from police_station";
    $result=mysqli_query($conn,$query); 
    $result1=mysqli_query($conn,"select p_id,p_name,spec,location from police");   
    ?>
    
    <title>Head View Police Station</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-image: url('complainbg1.png');
            background-size: cover;
            background-position: center;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h3 {
            color: #fff;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .table {
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        thead {
            background-color: black;
            color: white;
        }

        tbody {
            background-color: whitesmoke;
            color: black;
        }
    </style>
</head>
<body>    
    <div style="padding:50px;">
        <table class="table table-bordered">
            <h3>Police Station Details</h3>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Incharge Id</th>
                    <th scope="col">Incharge Name</th>
                    <th scope="col">Location of Police Station</th>
                </tr>
            </thead>
            <?php while($rows=mysqli_fetch_assoc($result)){ ?> 
            <tbody>
                <tr>
                    <td><?php echo $rows['i_id']; ?></td>
                    <td><?php echo $rows['i_name']; ?></td>     
                    <td><?php echo $rows['location']; ?></td>         
                </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>

    <div style="padding:50px;">
        <table class="table table-bordered">
            <h3>Police Details</h3>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Police Id</th>
                    <th scope="col">Police Name</th>
                    <th scope="col">Specialist</th>
                    <th scope="col">Location</th>
                </tr>
            </thead>
            <?php while($rows=mysqli_fetch_assoc($result1)){ ?> 
            <tbody>
                <tr>
                    <td><?php echo $rows['p_id']; ?></td>
                    <td><?php echo $rows['p_name']; ?></td>     
                    <td><?php echo $rows['spec']; ?></td>          
                    <td><?php echo $rows['location']; ?></td>          
                </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>  

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
