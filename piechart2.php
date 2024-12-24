<?php
$dataPoints = array();
$tableRows = array(); 


$defaultLocation = 'Default Location'; 
$selectedLocation = isset($_POST['location']) ? $_POST['location'] : $defaultLocation;

try {
    
    $link = new \PDO(
        'mysql:host=localhost;dbname=crime_portal;charset=utf8mb4',
        'root',
        '',
        array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_PERSISTENT => false
        )
    );

  
    $handleCompleted = $link->prepare("
        SELECT COUNT(c_id) AS y 
        FROM complaint 
        WHERE location = :selectedLocation AND pol_status = 'ChargeSheet Filed'
    ");

    
    $handlePending = $link->prepare("
        SELECT COUNT(c_id) AS y 
        FROM complaint 
        WHERE location = :selectedLocation AND pol_status = 'In Process'
    ");

   
    $handleCompleted->bindParam(':selectedLocation', $selectedLocation, \PDO::PARAM_STR);
    $handlePending->bindParam(':selectedLocation', $selectedLocation, \PDO::PARAM_STR);

    $handleCompleted->execute();
    $completedResult = $handleCompleted->fetch(\PDO::FETCH_OBJ);

    $handlePending->execute();
    $pendingResult = $handlePending->fetch(\PDO::FETCH_OBJ);

    if ($completedResult->y > 0) {
        array_push($dataPoints, array("label" => "Completed", "y" => $completedResult->y));
        $tableRows[] = array("status" => "Completed", "count" => $completedResult->y); 
    }

    if ($pendingResult->y > 0) {
        array_push($dataPoints, array("label" => "Pending", "y" => $pendingResult->y));
        $tableRows[] = array("status" => "Pending", "count" => $pendingResult->y); 
    }

    $link = null;
} catch (\PDOException $ex) {
    print($ex->getMessage());
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime Rate per Location</title>

   
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }

        #chartContainer {
            margin-top: 30px;
            padding: 15px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-inline .form-group {
            margin-right: 10px;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styling for Back to Dashboard button */
        .back-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>

    <script>
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Crime Rate for Location: <?php echo htmlspecialchars($selectedLocation); ?>" // Display selected location in chart title
            },
            data: [{
                type: "pie",
                yValueFormatString: "#,##0\"\"",
                indexLabel: "{label}: {y}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
    </script>
</head>
<body>
    <div class="container">
        <h2>Crime Rate by Location (Pending and Completed)</h2>

        <form method="POST" class="form-inline justify-content-center">
            <div class="form-group">
                <label for="location">Select Location:</label>
                <select id="location" name="location" class="form-control">
                    <option value="">Select Location</option>
                    <?php
                    
                    $link = new \PDO('mysql:host=localhost;dbname=crime_portal;charset=utf8mb4', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_PERSISTENT => false));
                    $stmt = $link->query("SELECT DISTINCT location FROM complaint");
                    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['location']) . "' " . ($selectedLocation == $row['location'] ? "selected" : "") . ">" . htmlspecialchars($row['location']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>


        <?php if (!empty($tableRows)): ?>
        <div class="table-container">
            <h3>Crime Data Details</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Count of Complaints</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tableRows as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td><?php echo htmlspecialchars($row['count']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <!-- Back to Dashboard Button -->
        <div class="back-btn">
            <a href="headdashboard1.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
