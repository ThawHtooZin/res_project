<?php
session_start();
require 'config/connect.php';
if(!empty($_GET['id'])){
  $stmt = $pdo->prepare("DELETE FROM tbl_admin WHERE id=".$_GET['id']);
  $stmt->execute();
  if($stmt){
    header('location:manage-admin.php');
    $_SESSION['remove'] = "Admin Have Been Removed Successfully";
  }
}
?>
