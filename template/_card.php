<?php
// méthode de requête pour obtenir toutes les tâches


function render_my_card($task){ 
  
  //ici on va transformer le timestamp en date et en francais
  //on récupère le timestamp
   //on va déclarer nos variables
  $date = date('d/m/Y H:i:s',$task['created_at']);
  $title = $task['title'];
  $description = empty($task['description']) ? 'Pas de description' : $task['description'];
  $image = $task['image'];
  $user_email = $task['email'];
  $deadline = $task['deadline'] === 0 ? 'Pas de date limite' : date('d/m/Y', $task['deadline']);

  $param = http_build_query($task); //http built request permet de renovyer toutes les données sous forme d'url
  
  ?>
  <div class="card m-3" style="width: 18rem;">
    <div class="card-body d-flex flex-column justify-content-between">
      <!-- enfant 1 -->
      <div class ="my-2">
        <h5 class="card-title card_title"><?php echo $title?></h5>
        <p class="card-text"><?php echo $description ?></p>
      </div>
      <!-- enfant 2 -->
      <div class ="my-2">
        <?php 
        //si j'ai une image
        if(!empty($image)){ ?>
        <a href="../images/<?php echo $image ?>" target ="_blank" title="Voir en grand">
          <img class="image-card" src="../images/<?php echo $image ?>" alt="image de la tâche <?php echo $title ?> ">
        </a>
        <?php } ?>
      </div>
      <!-- enfant 3 -->
      <div class ="my-2">
          <p class="card-text">
          <small class="text-muted">Créer par :
            <span class="text_card fw-bold"><?php echo $user_email ?></span>
          </small>
        </p>
        <p class="card-text">
          <small class="text-muted">Créer le:
            <span class="text_card fw-bold"><?php echo $date ?></span>
          </small>
        </p>
        <p class="card-text">
          <small class="text-muted">Date limite:
            <span class="text_card fw-bold"><?php echo $deadline ?></span>
          </small>
        </p>
        <div class="d-flex justify-content-around mt-3">
          <a href="../update_task.php?<?php echo $param ?>" class="task_update">
            <p class ="card-text">
              <i class="bi bi-pencil fa-lg"></i>
            </p>
          </a>
          <a href="../requete/delete_task.php?id=<?php echo $task['id'] ?>" class="task_delete">
            <p class ="card-text">
              <i class="bi bi-trash fa-lg"></i>
            </p>
          </a>
        </div>
      </div>

    </div>
  </div>
<?php }