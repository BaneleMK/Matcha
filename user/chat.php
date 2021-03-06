<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}
require_once('../config/setup.php');
include_once('../functions/sanitize.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body bgcolor="red">

        <?php include('../includes/navbar.php');?>
          
        <div class="container">
            <h1>Chat W/<?php

            $id = $_GET['id'];

            $sql = "SELECT * FROM users WHERE id = $id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $res = $stmt->fetch();
            
            echo $res['username'];
            ?></h1>
        </div>

        <div class="container">
            <div id="chatbox" class="d-flex flex-column bd-highlight mb-3">
                <?php
                  $userid = $_SESSION['id'];
                  $sql = "SELECT * FROM messages WHERE (receiverid = '$id' AND senderid= '$userid') OR senderid= '$id' AND receiverid = '$userid'";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();

                  while ($res = $stmt->fetch()){
                    $textmes = $res['textmessage'];
                    $mesid = $res['messageid'];
                    if ($res['receiverid'] == $id){
                      echo "<div id=\"$mesid\" class=\"align-self-end\">$textmes</div>";
                    } else {
                      echo "<div id=\"$mesid\" class=\"align-self-start\">$textmes</div>";
                    }
                  }
                ?>
            </div>
            <form id="messageform" action="chat.info.php" method=POST>
            <div class="input-group mb-3">
              <input value="<?php echo $id;?>" id="receiver" name="receiver" hidden>
              <input type="text" id="textmessage" name="textmessage" class="form-control" placeholder="feel free to type here" aria-label="Recipient's username" aria-describedby="button-addon2">
              <div class="input-group-append">
                <!--input id="messageform" class="btn btn-outline-secondary" type="submit" id="button-addon2" value="send"-->
                <button id="messageform" class="btn btn-outline-secondary" type="submit" id="button-addon2">Send it</button>
              </div>
            </div>
            </form>
        </div>
    <!--js for bootstrap-->
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    
    <script type='text/javascript'>
      /*$("button").click(function(){
        $.ajax({url: "demo_test.txt", success: function(result){
          $("#div1").html(result);
        }});
      });*/
      /*var time = 5;
      setInterval(() => {
        $.get("hello.php", function(data) {
          alert(time +' sec passed: ' + data);
        })
        .done(function () {
          alert('passed');
        })
        .fail(function () {
          alert('error...ror');
        });
        
        alert(time +' sec passed.');
        time += 5;
      }, 5000);*/

      var time = 0;
      
      //attr("id")
      lastmessageid = $("#chatbox div:last-child").attr("id")
      setInterval(() => {
        $.get("newmessage.php", {lastmessageid: lastmessageid}, function(data) {
          console.log(time +' sec passed: ' + data); 
          lastmessageid = data;
          //alert(time +' sec passed: ' + data);
        })
        .done(function () {
          console.log('passed');            
          //alert('passed');
        })
        .fail(function () {
          console.log('something went wrong boss');            
          //alert('something went wrong boss');
        });
        
        time += 5;
      }, 5000);

      $("#messageform").submit(function(event){
        event.preventDefault();
        
        var text = $("#textmessage").val();
        var receiver = $("#receiver").val();
        
        $("#textmessage").val("");

        var flexbox = document.createElement("div");
        var message = document.createTextNode(text);

        flexbox.appendChild(message);
        flexbox.classList.add("align-self-end");

        var chat = document.getElementById("chatbox");
        chat.appendChild(flexbox);

        var $form = $(this);
        var url = $form.attr('action');

        // something is wrong with the next instruction
        var posting = $.post( url, {textmessage: text, receiver: receiver } );

        /*posting.done(function(data){
          alert('sent');
        });*/

      });
    </script>
</body>
</html>