<?php

$dataPoints = array();
$tableRows = array();
try {
    // Creating a new connection.
    $link = new \PDO(
        'mysql:host=localhost;dbname=crime_portal;charset=utf8mb4',
        'root',
        '',
        array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_PERSISTENT => false
        )
    );

    // Use alias to simplify the data extraction
    $handle = $link->prepare('SELECT location AS x, COUNT(c_id) AS y FROM complaint GROUP BY location');
    $handle->execute();
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);

    foreach ($result as $row) {
        array_push($dataPoints, array("location" => $row->x, "y" => $row->y));
        $tableRows[] = array("location" => $row->x, "count" => $row->y);
    }
    $link = null;
} catch (\PDOException $ex) {
    print($ex->getMessage());
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- CanvasJS Chart Library -->
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f5f5f5;
            color: #333;
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

        .table {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background-color: black;
            color: white;
        }

        tbody {
            background-color: white;
            color: black;
        }

        table th, table td {
            text-align: center;
            padding: 10px;
        }

        /* Chart Styling */
        #chartContainer {
            margin-top: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 15px;
            background-color: white;
            border-radius: 10px;
        }

        /* Button for Exporting Chart */
        .canvasjs-chart-toolbar {
            border-radius: 10px;
        }

        /* Back to Dashboard Button */
        .dashboard-btn {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

    </style>

    <script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Number of Complaints by Location"
            },
            axisX: {
                title: "Location",
                interval: 1,
                labelFontSize: 0,
                labelAngle: -45
            },
            axisY: {
                title: "Count of Complaints",
                interval: 1,
                includeZero: true
            },
            data: [{
                type: "column", // Change type to bar, line, area, pie, etc.
                indexLabel: "{location}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
    </script>
</head>
<body>
    <div class="container">
        <h2>Complaint Analysis by Location</h2>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>

        <?php if (!empty($tableRows)): ?>
            <div class="mt-4">
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
        <div class="dashboard-btn">
            <a href="headdashboard1.php" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
