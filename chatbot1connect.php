<?php
// connecting to database
$conn = mysqli_connect("localhost", "root", "", "chatbotdb") or die("Database Error");
// getting user message through ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);
//checking user query to database query
$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");
// if user query matched to database query we'll show the reply otherwise it go to else statement
if(mysqli_num_rows($run_query) > 0){
    //fetching replay from the database according to the user query
    $fetch_data = mysqli_fetch_assoc($run_query);
    //storing replay to a varible which we'll send to ajax
    $replay = $fetch_data['replies'];
    echo $replay;
}else{
    echo "Sorry, I don't quite understand what you mean. <br>You may ask me:<br><br>
          1. can you give me some advice<br><br>
          2. what can you do<br><br>
          3. can you talk about deception<br><br>
          4. tell me about the website<br><br>
          5. how to use the website<br><br>
          6. can you educate me about deception";
}
?>