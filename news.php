<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>Anti-Deception Education Website</title>
</head>
<style>
		img {
			height: 200px;
			margin-top: 20px;
			margin-bottom: 20px;
		}
		img:hover {
    		transform: scale(1.0);
		}
		.slideshow {
 		 position: relative;
  		height: 300px;
  		overflow: hidden;
		}

		.slideshow img {
  		position: absolute;
  		top: 0;
  		left: 0;
  		opacity: 0;
  		transition: opacity 1s ease-in-out;
		}

		.slideshow img:first-child {
  		opacity: 1;
		}

		@keyframes slide {
  		100% {
    	opacity: 0;
    	transform: translateX(0);
  		}
  		100% {
    	opacity: 1;
    	transform: translateX(0);
  		}
		}

		.slideshow img {
  		animation: slide 10s infinite;
		}
	</style>
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
	<h1><font color="#299" size="+3">The latest Deception News</h1></font>
	</center>
<?php

// Set the API endpoint and parameters
$url = 'https://newsapi.org/v2/everything';
$params = [
	'q' => '香港詐騙',
	'sortBy' => 'publishedAt',
    'apiKey' => '93d29defb00a446eb7b283c46b6c160e'
];

// formatting parameters
$queryString = http_build_query($params);

// Initialize curl session
$ch = curl_init();

// set curl options
curl_setopt($ch, CURLOPT_URL, $url . '?' . $queryString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, '93d29defb00a446eb7b283c46b6c160e');

// Execute the curl request
$response = curl_exec($ch);

// close the curl session
curl_close($ch);

// process response data
$data = json_decode($response);

// If API data is fetched successfully, display the articles
if (isset($data->articles)) {
// fetch all articles
  $articles = $data->articles;

// Loop through each news and perform corresponding operations
  foreach ($articles as $article) {
	$author = $article->author;
    $title = $article->title;
    $description = $article->description;
	$url = $article->url;
    $urlToImage = $article->urlToImage;
	$publishedAt = $article->publishedAt;
	$content = $article->content;

// displaying data on a web page
	echo "<hr>";
	echo "<table>";
	echo "<tr><td><font color=#299><u>Title</u></td></tr><tr><td><h3><font color=red> " . $title . "</h3></td></tr>";
	echo "<tr><td><font color=#299><u>Author</u></td></tr><tr><td><h3><font color=red> " . $author . "</h3></td></tr>";
    echo "<tr><td><font color=#299><u>Description</u></td></tr><tr><td><h3><font color=red> " . $description . "</h3></td></tr>";
	echo "<tr><td><font color=#299><u>Url</u></td></tr><tr><td><h3><font color=red> ";
	echo "<a href='".$url."'>$url</h3></a></td></tr>";
	echo "<img src='".$urlToImage."'></h3></a></td></tr>";
	echo "<tr><td><font color=#299><u>Published At</u></td></tr><tr><td><h3><font color=red> " . $publishedAt . "</h3></td></tr>";
	echo "<tr><td><font color=#299><u>Content</u></td></tr><tr><td><h3><font color=red> " . $content . "</h3></td></tr>";
	echo "</table>";
  }
} else {
  echo "<p>Unable to fetch data from the API.</p>";
}
?>
</body>
</html>