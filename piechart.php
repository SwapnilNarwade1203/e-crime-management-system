<?php
$dataPoints = array();
$tableRows = array(); // Array to store table rows

// Get current month and year if not selected
$selectedMonth = isset($_POST['month']) ? $_POST['month'] : date('m');
$selectedYear = isset($_POST['year']) ? $_POST['year'] : date('Y');

try {
    // Creating a new connection
    $link = new \PDO(
        'mysql:host=localhost;dbname=crime_portal;charset=utf8mb4',
        'root',
        '',
        array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_PERSISTENT => false
        )
    );

    // Query to filter data by the selected month and year
    $handle = $link->prepare("
        SELECT location AS x, COUNT(c_id) AS y 
        FROM complaint 
        WHERE MONTH(d_o_c) = :selectedMonth AND YEAR(d_o_c) = :selectedYear 
        GROUP BY location
    ");
    
    // Bind the selected month and year parameters to the query
    $handle->bindParam(':selectedMonth', $selectedMonth, \PDO::PARAM_INT);
    $handle->bindParam(':selectedYear', $selectedYear, \PDO::PARAM_INT);
    
    $handle->execute();
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);

    $total = 0;
    foreach ($result as $row) {
        $total += $row->y; // Calculate the total count
    }

    // Calculate percentages and push to dataPoints and table rows
    foreach ($result as $row) {
        $percentage = ($row->y / $total) * 100; // Convert count to percentage
        array_push($dataPoints, array("location" => $row->x, "y" => $percentage));
        $tableRows[] = array("location" => $row->x, "count" => $row->y); // Store table rows
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
    <title>Crime Rate per Month</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- CanvasJS Chart Library -->
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
                text: "Crime Rate per Location - <?php echo date('F Y', strtotime("$selectedYear-$selectedMonth-01")); ?>" // Display selected month in chart title
            },
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{location} - {y}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
    </script>
</head>
<body>
    <div class="container">
        <h2>Crime Rate by Location</h2>

        <!-- Form for Month and Year Selection -->
        <form method="POST" class="form-inline justify-content-center">
            <div class="form-group">
                <label for="month">Select Month:</label>
                <select id="month" name="month" class="form-control">
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $month = str_pad($i, 2, '0', STR_PAD_LEFT);
                        $monthName = date('F', mktime(0, 0, 0, $i, 10));
                        echo "<option value='$month' " . ($selectedMonth == $month ? "selected" : "") . ">$monthName</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="year">Select Year:</label>
                <select id="year" name="year" class="form-control">
                    <?php
                    $currentYear = date('Y');
                    for ($i = 2015; $i <= $currentYear; $i++) {
                        echo "<option value='$i' " . ($selectedYear == $i ? "selected" : "") . ">$i</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- Chart Container -->
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>

        <!-- Table for Displaying Crime Data -->
        <?php if (!empty($tableRows)): ?>
        <div class="table-container">
            <h3>Crime Data Details</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Count of Complaints</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tableRows as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
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
