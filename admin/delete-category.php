<?php
session_start();
require 'config/connect.php';
if(!empty($_GET['id'])){
  $stmt = $pdo->prepare("DELETE FROM tbl_category WHERE id=".$_GET['id']);
  $stmt->execute();
  if($stmt){
    header('location:manage-category.php');
    $_SESSION['remove'] = "Category Have Been Removed Successfully";
  }
}
?>
