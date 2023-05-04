<?php
session_start();
require 'config/connect.php';
if(!empty($_GET['id'])){
  $stmt = $pdo->prepare("DELETE FROM tbl_food WHERE id=".$_GET['id']);
  $stmt->execute();
  if($stmt){
    header('location:manage-food.php');
    $_SESSION['remove'] = "Food Have Been Removed Successfully";
  }
}
?>
