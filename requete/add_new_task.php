
<?php

require_once('./connexion.php');
require_once('../tools/function.php');

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['deadline'])) { //si tout ces champs sont remplis alors
  //on déclare les variables
  session_start();// on démarre la session pour récupérer les infos
  $title = validate($_POST['title']);
  $description = validate($_POST['description']);
  $deadline_string = validate($_POST['deadline']); //format 2024-05-02 10:00:00
  //on doit transformer la date en timestamp

  $deadline = !empty($deadline_string) ? strtotime($deadline_string) : 0; //strtotime() transforme une date en timestamp
  $user_id = intval($_SESSION['id']);// intval() transforme une chaine de caractère en entier
  $image = $_FILES['image']['name'];// on recupère le nom de l'image dans le tableau $_FILES
  $created_at = time(); //time() retourne le timestamp actuel (date et heure actuelle)

  //on vérifie que les champs obligatoire sont remplis
  if (empty($title)) {
    header('Location: ../add-task.php?error=Veuillez renseigner un titre');
    exit();
  } else {
    global $connexion; // on se connecte à la base de données
    //on regarde si $image n'est pas empty
    if (!empty($image)) {
      //on a upload une image on fait le traitement
      //on verifie que l'image est du bon format
      $format = $_FILES['image']['type'];// on recupère le format de l'image
      $tmp_name = $_FILES['image']['tmp_name']; //chemin temporaire ou se trouve mon fichier "physique"
      $dir_name = '../images/'; //chemin ou je veux que mon fichier soit déplacé
      if (
        $format !== 'image/jpeg' &&//si le format n'est pas en jpeg et
        $format !== 'image/png' &&//en png et
        $format !== 'image/jpg' &&//en jpg et
        $format !== 'image/gif' &&//en gif et
        $format !== 'image/webp'//en webp
      ) {
        header('Location: ../add-task.php?error=Format d\'image non conforme (jpeg, png, jpg, gif ou webp)');
        exit();// on affiche un message d'erreur et on sort
      } else {
        //on peut faire le traitement de l'image car les formats sont bons
        //on crée un nom unique pour l'image
        $image_name = uniqid() . '_' . $image; // uniqid() génère un id unique concaténé avec le nom de l'image
        //on déplace l'image dans le dossier images
        if (move_uploaded_file($tmp_name, $dir_name . $image_name)) {
          //on crée la requete
          $query = "INSERT INTO `task`(title, description, deadline, image, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?)";
          //on prépare la requete
          if ($stmt = mysqli_prepare($connexion, $query)) {
            //on bind les paramètres
            mysqli_stmt_bind_param(
              $stmt,
              "ssisii",
              $title,
              $description,
              $deadline,
              $image_name,
              $user_id,
              $created_at
            );

            //on execute la requete
            if (mysqli_stmt_execute($stmt)) {
              //on ferme la connexion
              mysqli_close($connexion);
              //on redirige vers la page d'accueil
              header('Location: ../home.php');
            } else {
              header('Location: ../add-task.php?error=Erreur d\'enregistrement avec image');
              exit();
            }
          } else {
            header('Location: ../add-task.php?error=Erreur de requete avec image');
            exit();
          }
        }
      }
    } else {
      //on n'a pas upload d'image donc pas de traitement
      //on crée la requete
      $query = "INSERT INTO `task`(title, description, deadline, user_id, created_at) VALUES (?, ?, ?, ?,?)";
      //on prépare la requete
      if ($stmt = mysqli_prepare($connexion, $query)) { // mysqli prepare prend la connexion et la requete et la stocke dans stmt (stmt = statement = requete)
        //on bind les paramètres // bind = lier
        mysqli_stmt_bind_param(
          $stmt, // variable de la requete
          "ssiii",
          $title,
          $description,
          $deadline,
          $user_id,
          $created_at
        );

        //on execute la requete
        if (mysqli_stmt_execute($stmt)) {
          //on ferme la connexion
          mysqli_close($connexion);
          //on redirige vers la page d'accueil
          header('Location: ../home.php');
        } else {

          header('Location: ../add-task.php?error=Erreur d\'enregistrement sans image');
          exit();
        }
      } else {

        header('Location: ../add-task.php?error=Erreur de requete sans image');
        exit();
      }
    }
  }
} else {
  var_dump('Erreur de données formulaire');
}
