<?php

require_once('./connexion.php');
require_once('../tools/function.php');

//on récupère l'id de la tâche
if(isset($_GET['id'])){
  session_start();
  $task_id = intval($_GET['id']);
  $user_id = intval($_SESSION['id']);
  global $connexion;
  $query = "DELETE FROM `task` WHERE id = $task_id";
  //on vérifie que la tâche appartient bien à l'utilisateur connecté
  if(check_task_user($user_id, $task_id)){
    if(mysqli_query($connexion, $query)){
    header('Location: ../home.php');
    exit();
    
    }
    }else{
      header('Location: ../hacker.php');
      exit();
    }
  }else{
    header('Location: ../home.php?error=Erreur lors de la suppression de la tâche');
  }
