<!-- script qui va récupérer les posts de tâches de l'utilisateur connectée -->

<?php
//on importe le rendu de carte

function get_my_task($user_id){
  //on crée la connexion a la bdd
  global $connexion;
  //on crée la requete
  $query = "SELECT t.*, u.email
  FROM `task` AS t
  INNER JOIN `user` AS u ON t.user_id = u.id  
  WHERE user_id = ?";
  //on prépare la requete
  if ($stmt = mysqli_prepare($connexion, $query)){
    //on bind les paramètres
    mysqli_stmt_bind_param($stmt, "i", $user_id); //(prépare la requete, le type de parametre, les parametres)
    //on execute la requete
    if(mysqli_stmt_execute($stmt)){
      // on récupère le résultat de la requete
      $result = mysqli_stmt_get_result($stmt);
      //on va vérfier si il y a des résultats
      if(mysqli_num_rows($result)>0){
        //on boucle sur les résultats
        while($task = mysqli_fetch_assoc($result)){ //mysqli_fetch_assoc permet de récupérer les données sous forme de tableau associatif
          //on affiche les données avec la fonction render_my_card qui renvoie des card des tâches
          render_my_card($task);}
          
      }else{
        no_post();
      }
    }else{
      var_dump('Erreur lors de l\'execution de get_my_task');
    }
  }else{
    var_dump('Erreur lors de la préparation de get_my_task');
  }
}