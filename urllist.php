<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>Anti-Deception Education Website</title>
	<style>
		img {
			width: 50%;
			margin-top: 20px;
			margin-bottom: 20px;
		}
		img:hover {
    		transform: scale(1.0);
	</style>
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
	<section>
<center>
<img src="Test_photo/6.jpg" height="280">
<h1><font color="red" size="+3">The latest list of malicious URLs</h1></font>
<h3><font color="green">The following is the latest information on malicious websites, please be careful and avoid entering these websites.</h2></font>
</center>

<?php
$url = "https://api.hkma.gov.hk/public/bank-svf-info/fraudulent-bank-scams?lang=en";

// Initialize the cURL connection
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL and get the data returned by the API
$response = curl_exec($ch);

// Close the cURL connection
curl_close($ch);

// convert JSON data to PHP object
$data = json_decode($response);

// If API data is fetched successfully, display the result
if (isset($data->result) && $data->result->records) {
// fetch all records
  $records = $data->result->records;

// Loop through each news and perform corresponding operations
  foreach ($records as $record) {
	$issue_date = $record->issue_date;
    $alleged_name = $record->alleged_name;
    $scam_type = $record->scam_type;
	$pr_url = $record->pr_url;
    $fraud_website_address = $record->fraud_website_address;

// displaying data on a web page
	echo "<hr>";
	echo "<table>";
	echo "<tr><td><font color=#299><u>Alleged Name</u></td></tr><tr><td><h3><font color=red> " . $alleged_name . "</h3></td></tr>";
	echo "<tr><td><font color=#299><u>Scam Type</u></td></tr><tr><td><h3><font color=red> " . $scam_type . "</h3></td></tr>";
    echo "<tr><td><font color=#299><u>Issue Date</u></td></tr><tr><td><h3><font color=red> " . $issue_date . "</h3></td></tr>";
	echo "<tr><td><font color=#299><u>Malicious URL</u></td></tr><tr><td><h6><font color=red> " . $fraud_website_address. "</h5></td></tr>";
	echo "<tr><td><font color=#299><u>Detailed documentation</u></td></tr><tr><td><h3><font color=red> ";
	echo "<a href='".$pr_url."'>$pr_url</h3></a></td></tr>";
	echo "</table>";
  }
} else {
  echo "<p>Unable to fetch data from the API.</p>";
}
?>
</body>
</html>