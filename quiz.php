<?php
session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit();
}
?>

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

    <p><h1><?php echo $_SESSION['username']; ?> , welcome to the quiz！</h1></p><br>
    <center><button><a href="logout.php">logout</a></button></center>
<?php

    include "quizconnect.php";

   
    $stmt = $con->prepare("SELECT * FROM `data` ORDER BY RAND()");
    $stmt->execute();
    $res = $stmt->get_result();
    $links = $slides = $options = $choices = "";
    if ($res->num_rows > 0) {
        $num = 0;
        while ($row = $res->fetch_assoc()) {
            $num++;
            $links .= '<a href="#slide-'.$num.'">'.$num.'</a>';
            
            $con1 = [1,2,3,4];
            shuffle($con1);
            for ($i=1; $i <= 4; $i++) { 
                $choice = "option_".$con1[$i-1];
                ($i == 1)? $required="required":"";
                $options .= '
                            <input type="hidden" name="qid'.$num.'" value="'.$row["id"].'">
                            <label class="option option-'.$i.'">
                                <input type="radio" name="answer'.$num.'" class="optionbox" id="option-'.$num.$i.'" value="'.$row[$choice].'" '.$required.'>
                                <span>'.wordwrap($row[$choice], 25, "<br />\n").'</span>
                            </label>';
            }

            $slides .= '
                <div id="slide-'.$num.'">
                    <table>
                        <tr>
                            <td colspan="2">   
                                <div class="titleblock">Question #'.$num.'</div>
                                <textarea name="txtQuestion'.$row["id"].'" rows="5" placeholder="Enter question #'.$row["id"].' here..." disabled required>'.$row["question"].'</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="wrapper">
                                    '.$options.'
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            ';
            $options = $choices = "";
        }
    } 
    $con->close();
?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style3.css">
        <style>
            .titleblock,
            table th div,
            button,
            .slider .links>a {
                background: #299!important;
            }
        </style>
    </head>
    <body>
        <main>
            <form method="post" action="quizresult.php">
                <div class="title">
                </div>
                <div class="slider">
                    <div class="links">
                        <?php echo $links; ?>
                    </div>
                    <div class="slides">
                        <?php echo $slides; ?>
                    </div>

                    <button type="submit" name="btnSubmit" class="btnSubmit">Submit</button>
                </div>
            </form>
        </main>
    </body>
</html>