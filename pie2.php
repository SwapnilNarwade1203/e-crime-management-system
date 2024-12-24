<?php

$dataPoints = array();
$tableRows = array();
$selectedMonth = isset($_POST['month']) ? $_POST['month'] : '01'; // Default to January if no month is selected
$selectedYear = isset($_POST['year']) ? $_POST['year'] : date('Y'); // Default to current year if no year is selected

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

    // Adjust query to filter by selected month and year
    $query = 'SELECT location AS label, COUNT(c_id) AS y 
              FROM complaint 
              WHERE MONTH(d_o_c) = :selectedMonth AND YEAR(d_o_c) = :selectedYear
              GROUP BY location';

    $handle = $link->prepare($query);
    $handle->bindParam(':selectedMonth', $selectedMonth, \PDO::PARAM_INT);
    $handle->bindParam(':selectedYear', $selectedYear, \PDO::PARAM_INT);
    $handle->execute();
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);

    $total = 0;
    foreach ($result as $row) {
        $total += $row->y; // Calculate the total count
    }

    // Calculate percentages and push to dataPoints
    foreach ($result as $row) {
        $percentage = ($row->y / $total) * 100; // Convert count to percentage
        array_push($dataPoints, array("location" => $row->label, "y" => $percentage));
        $tableRows[] = array("location" => $row->label, "count" => $row->y, "percentage" => $percentage);
    }

    $link = null;
} catch (\PDOException $ex) {
    print($ex->getMessage());
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <style>/* styles.css */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    margin: 20px auto;
    padding: 20px;
    max-width: 1200px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    margin-bottom: 20px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

select {
    display: block;
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

thead th {
    background-color: #007bff;
    color: white;
}
</style>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "CRIME RATE ANALYSIS PER MONTH"
            },
            subtitles: [{
                text: "<?php echo htmlspecialchars($_POST['month']); ?>/<?php echo htmlspecialchars($_POST['year']); ?>"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
    </script>
</head>
<body>
    <div class="container">
        <form method="post" action="">
            <label for="month">Select Month:</label>
            <select id="month" name="month">
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <label for="year">Select Year:</label>
            <select id="year" name="year">
                <?php
                // Generate options for years dynamically
                $currentYear = date('Y');
                for ($i = $currentYear; $i >= 2000; $i--) {
                    echo "<option value=\"$i\"".($i == $selectedYear ? " selected" : "").">$i</option>";
                }
                ?>
            </select>

            <input type="submit" value="Submit">
        </form>

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>

        <?php if (!empty($tableRows)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Count of Complaints</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tableRows as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo htmlspecialchars($row['count']); ?></td>
                            <td><?php echo number_format($row['percentage'], 2); ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
