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
	<section>
<?php
session_start();

// If the user is already logged in, redirect them to the game page
if (isset($_SESSION['username'])) {
  header('Location: quiz.php');
  exit();
}

// Handle login information submitted by the user
if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connect to the database
  $db = new mysqli('localhost', 'root', '', 'textgame');

  // Query whether the user exists
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = $db->query($query);

  // If the user exists, save its username to the session and redirect to the game page
  if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['score'] = 0;
    $_SESSION['answered'] = array();
    header('Location: quiz.php');
    exit();
  };
    $error = 'The username does not exist. Please enter again.';
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login form</title>
  <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
  <div id="container">
    <h1><font color=#299>Login form</font></h1><br>
    <form method="post" action="login.php">
      <label for="username">User name：</label>
      <input type="text" name="username" id="username" required><br>
      <label for="password">Password：</label>
      <input type="text" name="password" id="password" required><br>
      <center><button type="submit">Login</button></center>
    </form>
    <?php if (isset($error)) { ?>
      <p class="error"><?php echo $error; ?></p>
    <?php } ?>
  </div>
</body>
</html>