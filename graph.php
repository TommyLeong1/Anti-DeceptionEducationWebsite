<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>Anti-Deception Education Website</title>
</head>
<body>
	<header>Anti-Deception Education Website</header>
	<nav>
        <a href="index.php">Homepage</a>
		<a href="chatbot.php">Chatbot</a>
        <a href="quiz.php">Quiz</a>
		<a href="urlchecking.php">URL checking</a>
		<a href="graph.php">Statistical graph</a>
		<a href="alertsvideo.php">Alerts and videos</a>
        <a href="news.php">Latest Deception News</a>
	</nav>
	<section><center>
<?php
// Connect to the database
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "antideceptioneducationwebsite";
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the number of reports for each deception type
$sql = "SELECT deception_type, COUNT(*) as count FROM user_reports GROUP BY deception_type";
$result = mysqli_query($conn, $sql);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array($row['deception_type'], (int)$row['count']);
}

// Close the database connection
mysqli_close($conn);

// Generate the chart
?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Deception Type', 'Number of Reports'],
                <?php
                foreach ($data as $row) {
                    echo "['" . $row[0] . "', " . $row[1] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'User Reports of Deception Types',
                pieHole: 0.4
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>

	<?php
// Database connection settings
$host = 'localhost';
$dbname = 'antideceptioneducationwebsite';
$username = 'root';
$password = '';

// Create a database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Database connection failed: ' . $e->getMessage();
    exit;
}

// Prepare SQL statement
$sql = "SELECT date_reported, description FROM user_reports";

// Create PDOStatement object and execute SQL statement
$stmt = $pdo->query($sql);

// Prepare HTML table
echo '<table border="1">';
echo '<tr><th><font color="orange" size="+3">Date Reported</th><th><font color="Tomato" size="+3">Description of user scammed</th></tr>';

// Use fetch() method to read each row from the database
while ($row = $stmt->fetch()) {
    echo '<tr>';
    echo '<th><font color="blue" size="+2">' . $row['date_reported'] . '</th>';
    echo '<th><font color="red" size="+2">' . $row['description'] . '</th>';
    echo '</tr>';
}

echo '</table>';
?>
</body>
</html>