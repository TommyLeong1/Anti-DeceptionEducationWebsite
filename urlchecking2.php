<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>Anti-Deception Education Website</title>
	<style>
		img:hover {
    		transform: scale(1.0);
		}
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
<br>
<form method="post" align = "center">
	<img src="Test_photo/3.png" width="600" height="280">
   <br>
  <input type="text" name="url" id="url" required style="width: 300px; height: 30px;" placeholder="Enter a URL to check">
  <button type="submit"><img src="Test_photo/2.png" width="40"></button>
</form>
<br>
<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$url = $_POST['url'];
	$is_valid_url = filter_var($url, FILTER_VALIDATE_URL);

	// Check if the URL is legal
	if (!$is_valid_url) {
		echo '<center>You searched: ' . $url;
    echo '<p><font color="red" size="+1">This URL is suspicious. Please avoid clicking.</font></p>';
	echo '<img src="Test_photo/4.png" width="200"><br>';
	echo '<br><p><font color="green" size="+2">Stay Safe Online: Tips for Browsing with Secure HTTPS Connection</p>
	      <ol>
		  <font color="orange"><li>Be wary of clicking on links from unknown sources or suspicious-looking emails.</li>
		  <li>Look out for phishing scams, which may try to trick you into sharing personal information or login credentials.</li>
		  <li>Keep your computer and web browser updated with the latest security patches and software updates.</li>
		  <li>Check the URL of a website before entering any sensitive information or making a purchase, to ensure that it is a legitimate and secure site.</li>
		  <li>If you are unsure about the safety of a website or link, do not click on it and instead, seek out more information or assistance from a trusted source.<p></li>';
	} else 
if(isset($_POST['url'])) {
  $url = $_POST['url'];
  $api_key = 'AIzaSyAUZqqehUUgmF0PfiAxClbtXwPAbq5h-TI';

  // Build the request
  $request = array(
    'client' => array(
      'clientId' => '133704479282-n6p5f5d7epsb05draln42u1gvu6g35jt.apps.googleusercontent.com',
      'clientVersion' => '1.0'
    ),
    'threatInfo' => array(
      'threatTypes' => array('MALWARE', 'SOCIAL_ENGINEERING', 'UNWANTED_SOFTWARE', 'POTENTIALLY_HARMFUL_APPLICATION'),
      'platformTypes' => array('ANY_PLATFORM'),
      'threatEntryTypes' => array('URL'),
      'threatEntries' => array(array('url' => $url))
    )
  );

  // Send the request
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . $api_key);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  $response = curl_exec($ch);
  curl_close($ch);

  // Parse the response
  $result = json_decode($response, true);
  $matches = isset($result['matches']) ? $result['matches'] : array();

  // Display the results
  if(count($matches) > 0) {
    echo '<p>The URL is dangerous!</p>';
    echo '<ul>';
    foreach($matches as $match) {
      echo '<li>Threat type: ' . $match['threatType'] . '</li>';
      echo '<li>Platform type: ' . $match['platformType'] . '</li>';
      echo '<li>Threat entry type: ' . $match['threatEntryType'] . '</li>';
    }
    echo '</ul>';
  } else {
	echo '<center>You searched: ' . $url;
    echo '<p><font color="green" size="+1">The URL is no record of Deception or Cyber risk report.</font></p>';
	echo '<img src="Test_photo/1.png" width="200"><br>';
	echo '<br><p><font color="green" size="+2">Stay Safe Online: Tips for Browsing with Secure HTTPS Connection</p>
	      <ol>
		  <font color="orange"><li>Be wary of clicking on links from unknown sources or suspicious-looking emails.</li>
		  <li>Look out for phishing scams, which may try to trick you into sharing personal information or login credentials.</li>
		  <li>Keep your computer and web browser updated with the latest security patches and software updates.</li>
		  <li>Check the URL of a website before entering any sensitive information or making a purchase, to ensure that it is a legitimate and secure site.</li>
		  <li>If you are unsure about the safety of a website or link, do not click on it and instead, seek out more information or assistance from a trusted source.<p></li>';
  }
}
}
?>
</body> </html>