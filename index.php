<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>Anti-Deception Education Website</title>
	<style>
		img {
			width: 100%;
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
	<div class="slideshow">
  		<img class="mySlides" src="Index_photo/1.png" width="60" height="280">
  		<img class="mySlides" src="Index_photo/2.png" width="60" height="280">
	</div>	
	<section>	
		<h1><font color="skyblue" size="+3">Welcome to the Anti-Deception Education Website</h1>
		<p>This website is designed to help users identify and prevent online deception, and protect your property and personal information.</p>
		<ul><font color="green" size="+2">
			<li>To test URLs you consider suspicious and avoid deception you are prone to fall into.</li>
			<li>Gain a better understanding of common deception tactics used by scammers and how to protect yourself from them.</li>
			<li>Provide users with practical examples of deception tactics and help them identify potential scams.</li>
			<li>Practice users' deception prevention skills and gain confidence in their ability to identify and avoid scams.</li>
			<li>To experience the consequences of making poor choices when it comes to deception and learn from their mistakes.</li>
		</ul>
		<p><font color="orange">Please note that this website is intended to provide assistance and advice, but cannot guarantee complete protection from fraud. If you find any suspicious behavior or information, please report it in time and take the necessary measures.</p>
	</section>
	<div class="slideshow">
		<img class="mySlides" src="Index_photo/3.png" width="60" height="280">
  		<img class="mySlides" src="Index_photo/4.png" width="60" height="280">
	</div>	
</body>
</html>