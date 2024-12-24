<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Pending Complaints</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <?php
    session_start();
    if (!isset($_SESSION['x'])) {
        header("location:policelogin.php");
    }

    $conn = mysqli_connect("localhost", "root", "");
    if (!$conn) {
        die("could not connect" . mysqli_error($conn));
    }
    mysqli_select_db($conn, "crime_portal");

    if (isset($_POST['s2'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cid = $_POST['cid'];
            $_SESSION['cid'] = $cid;
            $alok = mysqli_query($conn, "SELECT p_id FROM complaint WHERE c_id='$cid'");
            $row = mysqli_fetch_assoc($alok);
            $p_id = $_SESSION['pol'];
            if ($row['p_id'] == $p_id) {
                header("location:police_complainDetails.php");
            } else {
                echo "<script type='text/javascript'>M.toast({html: 'Not in your scope'});</script>";
            }
        }
    }

    $p_id = $_SESSION['pol'];
    $result = mysqli_query($conn, "SELECT c_id, type_crime, d_o_c, location FROM complaint WHERE p_id='$p_id' AND pol_status='In Process' ORDER BY c_id DESC");
    ?>

    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #3f51b5; /* Materialize primary color */
        }

        .navbar .brand-logo {
            color: #fff;
        }

        .navbar .nav-wrapper {
            padding: 0 20px;
        }

        .navbar a {
            color: #fff !important;
        }

        .input-field label {
            color: #3f51b5; /* Materialize primary color */
        }

        input[type="text"] {
            border: 1px solid #3f51b5; /* Materialize primary color */
        }

        .btn {
            background-color: #3f51b5; /* Materialize primary color */
        }

        .btn:hover {
            background-color: #303f9f; /* Darker shade of primary color */
        }

        .highlight {
            margin-top: 20px;
        }

        .table {
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #3f51b5; /* Materialize primary color */
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-fixed">
        <div class="nav-wrapper">
            <a href="home.php" class="brand-logo ">Crime Management System</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li class="active"><a href="police_pending_complain.php">Pending Complaints</a></li>
                <li><a href="police_complete.php">Completed Complaints</a></li>
                <li><a href="p_logout.php">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <form method="post" class="section">
            <div class="input-field col s12">
                <input id="cid" name="cid" type="text" class="validate" placeholder="Complaint Id" required>
                <label for="cid"><h5>Complaint Id</h5></label>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="s2">Search</button>
        </form>

        <div class="section">
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                        <th>Complaint Id</th>
                        <th>Type of Crime</th>
                        <th>Date of Crime</th>
                        <th>Location of Crime</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rows['c_id']); ?></td>
                        <td><?php echo htmlspecialchars($rows['type_crime']); ?></td>
                        <td><?php echo htmlspecialchars($rows['d_o_c']); ?></td>
                        <td><?php echo htmlspecialchars($rows['location']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>
</body>
</html>
