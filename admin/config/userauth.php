<?php
if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
  header("location: login.php");
}
// Already done this befrure this video.
?>
