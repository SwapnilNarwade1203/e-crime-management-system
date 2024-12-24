<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Incharge Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="styletable.css"> <!-- Your custom CSS file -->

    <?php
    session_start();
    if (!isset($_SESSION['x'])) {
        header("location:policelogin.php");
    }

    // Database connection
    $conn = mysqli_connect("localhost", "root", "");
    if (!$conn) {
        die("Could not connect: " . mysqli_error($conn));
    }
    mysqli_select_db($conn, "crime_portal");

    $cid = $_SESSION['cid'];
    $p_id = $_SESSION['pol'];

    // Fetch complaint details
    $query = "SELECT c_id, type_crime, d_o_c, mob, description, u_addr FROM complaint NATURAL JOIN user WHERE c_id='$cid' AND p_id='$p_id'";
    $result = mysqli_query($conn, $query);

    // Check if data exists
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('No complaint data found for this case or query failed.');</script>";
        exit();
    }

    // Handle case status update
    if (isset($_POST['status'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $upd = $_POST['update'];
            $qu1 = mysqli_query($conn, "INSERT INTO update_case(c_id, case_update) VALUES('$cid','$upd')");
        }
    }

    // Handle case closure and final report submission
    if (isset($_POST['close'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $up = $_POST['final_report'];
            $qu2 = mysqli_query($conn, "INSERT INTO update_case(c_id, case_update) VALUES('$cid', '$up')");
            $q2 = mysqli_query($conn, "UPDATE complaint SET pol_status='ChargeSheet Filed' WHERE c_id='$cid'");
        }
    }

    // Fetch case updates
    $res2 = mysqli_query($conn, "SELECT d_o_u, case_update FROM update_case WHERE c_id='$cid'");
    ?>
</head>
<body>
    <nav class="navbar navbar-fixed">
        <div class="nav-wrapper">
            <a href="home.php" class="brand-logo">Crime Management System</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="police_pending_complain.php">View Complaints</a></li>
                <li class="active"><a href="police_complainDetails.php">Complaints Details</a></li>
                <li><a href="p_logout.php">Logout &nbsp<i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="section">
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Complaint Id</th>
                        <th>Type of Crime</th>
                        <th>Date of Crime</th>
                        <th>Description</th>
                        <th>Complainant Mobile</th>
                        <th>Complainant Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($row)) { ?>
                    <tr>
                        <td><?php echo $row['c_id']; ?></td>
                        <td><?php echo $row['type_crime']; ?></td>
                        <td><?php echo $row['d_o_c']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['mob']; ?></td>
                        <td><?php echo $row['u_addr']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date Of Update</th>
                        <th>Case Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows1 = mysqli_fetch_assoc($res2)) { ?>
                    <tr>
                        <td><?php echo $rows1['d_o_u']; ?></td>
                        <td><?php echo $rows1['case_update']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col s6">
                <form method="post">
                    <h5>Complaint ID</h5>
                    <input type="text" name="cid" disabled value="<?php echo $cid; ?>">

                    <div class="input-field col s12">
                        <select name="update">
                            <option value="" disabled selected>Update Case Status</option>
                            <option value="Criminal Verified">Criminal Verified</option>
                            <option value="Criminal Caught">Criminal Caught</option>
                            <option value="Criminal Interrogated">Criminal Interrogated</option>
                            <option value="Criminal Accepted the Crime">Criminal Accepted the Crime</option>
                            <option value="Criminal Charged">Criminal Charged</option>
                        </select>
                        <label>Update Status</label>
                    </div>

                    <button class="btn waves-effect waves-light" type="submit" name="status">Update Case Status</button>
                </form>
            </div>

            <div class="col s6">
                <form method="post">
                    <div class="input-field">
                        <textarea name="final_report" id="final_report" class="materialize-textarea" placeholder="Final Report" required></textarea>
                        <label for="final_report">Final Report</label>
                    </div>
                    <button class="btn red waves-effect waves-light" type="submit" name="close">Close Case</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            M.FormSelect.init(elems, {});
        });
    </script>
</body>
</html>
