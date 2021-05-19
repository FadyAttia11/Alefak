<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    if($user_data) {
      if($user_data['user_role'] == 'owner') {
        return header('Location: index-owner.php');
      } else if ($user_data['user_role'] == 'vet') {
          return header('Location: index-vet.php');
      } else if ($user_data['user_role'] == 'delivery') {
        return header('Location: index-delivery.php');
      } else if ($user_data['user_role'] == 'admin') {
        return header('Location: index-admin.php');
      }
    }
    header('Location: index-guest.php');
?>