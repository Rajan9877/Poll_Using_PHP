<?php
session_start();
if(!isset($_SESSION["pollid"])){
    header('Location: http://localhost/poll/auth/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Poll</title>
  <style>
     .poll-container {
      max-width: 400px;
      margin: auto;
    }

    .poll-option {
      margin-bottom: 10px;
    }

    .percentage-bar {
      height: 20px;
      background-color: #eee;
      border-radius: 5px;
      overflow: hidden;
      position: relative;
    }

    .percentage-fill {
      height: 100%;
      border-radius: 5px;
      background-color: greenyellow;
      transition: width 0.5s ease-in-out;
    }
    .error{
        color: red;
    }
    .logoutbtn{
      background-color: red;
      color: white;
      border: 1px solid red;
      padding: 7px 15px;
      cursor: pointer;
      border-radius: 50px;
      transition: all 0.3s ease-in-out;
    }
    .logoutbtn:hover{
      background-color: rgb(255, 70, 70);
    }
    .votebtn{
      background-color: greenyellow;
      border: 1px solid greenyellow;
      padding: 7px 15px;
      cursor: pointer;
      border-radius: 50px;
      transition: all 0.3s ease-in-out;
    }
    .votebtn:hover{
      background-color: rgb(193, 255, 100);
    }
    footer{
      text-align: center;
      margin-top: 25px;

    }
    nav{
      text-align: center;
    }
  </style>
</head>
<body>

<div class="poll-container">
  <nav>
    <a href="auth/logout_user.php"><button class="logoutbtn">Logout</button></a>
  </nav>
  <h2 class="heading2">Who is your favourite player in cricket?</h2>
  <p class="error"></p>
  <form id="pollForm">
    <div class="poll-option">
      <label>
        <input type="radio" name="vote" value="option1"> Rohit Sharma
      </label>
    </div>
    <div class="poll-option">
      <label>
        <input type="radio" name="vote" value="option2"> Virat Kohli
      </label>
    </div>
    <button type="button" class="votebtn" onclick="submitVote()">Vote</button>
  </form>
  <!-- <div id="pollResults"> -->
    <!-- Poll results will be displayed here dynamically -->
  <!-- </div> -->
  <br>
<h2>Till Now</h2>
  <div class="percentage-container">
    <p>Rohit Sharma</p>
    <div class="percentage-bar">
      <div class="percentage-fill" id="option1" style="width: 0%;">0%</div>
    </div>
  </div>

  <div class="percentage-container">
    <p>Virat Kohli</p>
    <div class="percentage-bar">
      <div class="percentage-fill" id="option2" style="width: 0%;">0%</div>
    </div>
  </div>

</div>
<?php

include('footer.php');

?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="script.js"></script>
</body>
</html>
