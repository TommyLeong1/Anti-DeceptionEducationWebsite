<?php
session_start();

// If the user is not logged in, redirect him to the login page
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

    <p><h1><font color = "green"><?php echo $_SESSION['username']; ?> , You have answered all the questions and here are your results.</font></h1></p><br>
<?php
    // include database connection

    include "quizconnect.php";
    $key = [];
    $num = 0;
    if(isset($_POST["btnSubmit"])) {
        for ($i=1; $i < 11; $i++) { 
            $stmt = $con->prepare("SELECT * FROM `data` WHERE `id`=?");
            $stmt->bind_param("i", $_POST["qid".$i]);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_assoc()){
                for ($x=1; $x < 5; $x++) {
                    if ($_POST["answer".$i] == $row["option_".$x]) {
                        if ($row["answer"] == $x){
                            $num++;
                        }else {
                            echo "<hr><p align=left><font color=#299> Question " .$i. "</font><br>".$row["question"]. "<br><br>".
                             "<p align=left><font color=#299> Your answer</font><br><font color=red>" .$_POST["answer".$i]. "</font></p><br>".
                             "<p align=left><font color=#299> Correct answer</font><br><font color=green>" .$row["option_".$row["answer"]]. "</font></p><br>".
                             "<p align=left><font color=#299>Explanation</font><br>" .$row["explanation"]. "</p><br>"; 
                             break;     
                        }                      
                    }
                }
            }
            $stmt->close();
        }
    }

   // Give a rating based on the user's score
    if ($num >= 6) {
        $evaluation = '<font color = green>You have a strong sense of prevention and know how to avoid deceptions.</font>';
    } elseif ($num >= 4) {
        $evaluation = '<font color = #FFC300>Your awareness of deceptions prevention needs to be strengthened, and more learning and practice are needed.</font>';
    } elseif ($num < 4) {
        $evaluation = '<font color = red>Your awareness of prevention is relatively weak, and you need to strengthen your study and practice.</font>';
    }
    $con->close();
?>
<!DOCTYPE html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Result | Quiz Randomizer in PHP MySQL</title>
        <link rel="stylesheet" href="style3.css">
    </head>
    <body>
        <main>
            <div class="title">
                <hr>
                <h1><font color = "green">Result</font><h1>
                <hr>

                <h1 class="txtScore"><font color=#299>Score:</font> <?php echo ($num*10); ?></h1>
                <h1 class="txtScore"><font color=#299>Your Evaluation：</font><br><?php echo $evaluation; ?></h1><br>

                <div class="btnWrapper">
                     <center>
                    <a href="quiz.php" class="btnHalf btnQuiz">Take the Quiz Again?</a>
                    </center>
                </div>
            </div>
        </main>
    </body>
</html>