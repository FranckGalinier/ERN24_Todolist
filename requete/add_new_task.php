<?php
require_once('./connexion.php');
require_once('../tools/function.php');



if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['deadline'])){ // isset = si la variable existe et n'est pas NULL
  session_start();
  //on déclare nos variables
  $title = validate($_POST['title']);
  $description = validate($_POST['description']);
  $deadline_string = validate($_POST['deadline']); //date au format 2024-05-12 10:00:00
  //on doit transfrome la date en timestamp
  $deadline = !empty($deadline_string) ? strtotime($deadline_string):0 ;//strtotime = transforme une date en timestamp / si il n'y a pas de date on met 0
  $user_id = intval($_SESSION['id']); // INTBAL = transforme la valeur en entier
  $image = $_FILES['image']['name'];
  var_dump($_FILES);

  //on vérifie que les champs obligatoire sont remplies
  if(empty($title)){ //si le titre est vide
    header('Location: ../add-task.php?error=Le titre est obligatoire');
    exit();

  }else{
    global $connexion;
    //on regarde si l'image n'est pas vide
    if(!empty($image)){
      //on a upload une image on fait le traitement
      $format =$_FILES['image']['type'];
      $tmp_name = $_FILES['image']['tmp_name'];// chemin temporaire ou se trouve mon fichier physique
      $dir_name = '../images/';//chemin qui va contenir mon fichier

      //on vérifie que l'image est du bon format
      if($format != 'image/jpeg' && $format != 'image/png' && $format != 'image/gif' && $format != 'image/jpg' && $format != 'image/webp'){
        header('Location: ../add-task.php?error=Veuillez poster une image au format jpeg, jpg, png, gif ou webp');
        exit();

      }else{//l'image est au bon format
        //on peut faire le traitement de l'image
        //on crée un nom unique pour l'image
        $image_name = uniqid().'_'.$image;
        //on déplace l'image dans le dossier images
        if(move_uploaded_file($tmp_name, $dir_name.$image_name)){
          //on créer la requête
          $query = "INSERT INTO `task` (title, description, deadline, image, user_id) VALUES (?, ?, ?, ?, ?)";
          //on prépare la requête
          if($stmt = mysqli_prepare($connexion,$query)){
            //on bind les paramètres
            mysqli_stmt_bind_param($stmt, "ssisi", $title, $description, $deadline, $image_name, $user_id);
            // on execute la requête
            if(mysqli_stmt_execute($stmt)){
              // on ferme la connexion
              header('Location: ../home.php?success=Votre tâche a été ajoutée avec succès');
              exit();
            }else{
              header('Location: ../add-task.php?error=Erreur de requête');
              exit();
            } 

          }else{
            header('Location: ../add-task.php?error=Erreur de requête avec image');
            exit();
          }
        }
      }

      }else{//on a pas upload d'img Pas de traitement d'image

        //on créer la requête
        $query = "INSERT INTO `task` (title, description, deadline, user_id) VALUES (?, ?, ?, ?)";
        //on prépare la requête
        if($stmt = mysqli_prepare($connexion,$query)){
          //on bind les paramètres
          mysqli_stmt_bind_param($stmt, "ssii", $title, $description, $deadline, $user_id);
          // on execute la requête
          if(mysqli_stmt_execute($stmt)){
            // on ferme la connexion
            mysqli_stmt_close($connexion);
            header('Location: ../home.php?success=Votre tâche a été ajoutée avec succès');
            exit();
          }else{
            header('Location: ../add-task.php?error=Erreur de requête');
            exit();
          } 
        
        }else{
          header('Location: ../add-task.php?error=Erreur de requête sans image');
          exit();
        }
      }

    }
 
  }else{
    var_dump('erreur de données de formulaire');
}

