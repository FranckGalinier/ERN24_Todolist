<?php
require_once('./connexion.php');
require_once('../tools/function.php');
 
if (
  isset($_POST['title']) && isset($_POST['description']) && isset($_POST['deadline']) && isset($_POST['id'])
) {
  //on déclare les variables
  $title = validate($_POST['title']);
  $description = validate($_POST['description']);
  $deadline_string = validate($_POST['deadline']);
  //on doit transformer la date en timestamp
  $deadline = !empty($deadline_string) ? strtotime($deadline_string) : 0;
  $id = intval($_POST['id']);
  $param = http_build_query($_POST);
  global $connexion;
 
  //si on a pas d'image a gérer
  if (empty($_FILES['image']['name'])) {
    //on crée la requete
    $query = "UPDATE `task` SET title=? , description=? , deadline=? WHERE id=?";
    //on prépare la requete
    if ($stmt = mysqli_prepare($connexion, $query)) {
      //on bind les paramètres
      mysqli_stmt_bind_param(
        $stmt,
        "ssii",
        $title,
        $description,
        $deadline,
        $id
      );
      //on execute la requete
      if (!mysqli_stmt_execute($stmt)) {
        header("Location: ../update_task.php?$param&error=Erreur d'execution de requete");
        exit();
      }
      //on ferme la connexion
      mysqli_close($connexion);
      //on redirige vers la page d'accueil
      header('Location: ../home.php');
    } else {
      header("Location: ../update_task.php?$param&error=Erreur de preparation de requete");
      exit();
    }
  }else{
    //cas ou on upload une image
    $format = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name']; //chemin temporaire ou se trouve mon fichier "physique"
    $dir_name = '../images/'; //chemin ou je veux que mon fichier soit déplacé
    if (
      $format !== 'image/jpeg' &&
      $format !== 'image/png' &&
      $format !== 'image/jpg' &&
      $format !== 'image/gif' &&
      $format !== 'image/webp'
    ) {
      header("Location: ../update_task.php?$param&error=Format d'image non conforme (jpeg, png, jpg, gif ou webp)");
      exit();
    }else{
      //on peut faire le traitement de l'image
      //on crée un nom unique pour l'image
      $image_name = uniqid() . '_' . $image;
      //on déplace l'image dans le dossier images
      if (move_uploaded_file($tmp_name, $dir_name . $image_name)) {
        //on cree la requete
        $query = "UPDATE `task` SET title=? , description=? , deadline=? , image=? WHERE id=?";
        //on prépare la requete
        if($stmt= mysqli_prepare($connexion, $query)){
          //on bind les paramètres
          mysqli_stmt_bind_param(
            $stmt,
            "ssisi",
            $title,
            $description,
            $deadline,
            $image_name,
            $id
          );
          //on execute la requete
          if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../update_task.php?$param&error=Erreur d'execution de requete");
            exit();
          }
          //on ferme la connexion
          mysqli_close($connexion);
          //on redirige vers la page d'accueil
          header('Location: ../home.php');
        }else{
          header("Location: ../update_task.php?$param&error=Erreur de preparation de requete");
          exit();
       
        }
      }else{
        header("Location: ../update_task.php?$param&error=Erreur de déplacement de l'image");
        exit();
      }
    }
  }
} else {
  var_dump('Erreur de données formulaire');
}