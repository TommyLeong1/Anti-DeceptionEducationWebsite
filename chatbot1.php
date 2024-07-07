<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<title>Anti-Deception Education Website</title>
</head>
<body1>
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
<body1/>

<body>
    <br>
    <div class="wrapper">
        <div class="title">
        <br><a href="chatbot2.php"><img src="Chatbot_photo/3.png" height="100"></a><br>            
        AntiScambot
        </div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon"> 
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hello there, I am AntiScambot. Are you confused about what Deception? Can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
        <img src="Chatbot_photo/4.png" height="30" id="clean-btn">
            <div class="input-data">
                <input id="data" type="text" placeholder="Talk to AntiScambot on here..." required>
                <button id="send-btn"><img src="Chatbot_photo/5.png" width="30" height="30"></button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#clean-btn").on("click", function(){
                location.reload();
            });

            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'chatbot1connect.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
</body>
</html>