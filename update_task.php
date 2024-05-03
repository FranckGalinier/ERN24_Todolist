<?php

require_once('./template/_header.php');
require_once('./template/_navbar.php');

if($_SESSION['id'] != $_GET['user_id']){
    header('Location: ./task.php');
}else{
$title = $_GET['title'];
$description = $_GET['description'] ?? ''; //si j'ai une description je la garde sinon (??) je mets une chaine vide
$image = $_GET['image'] ?? '';
$deadline = $_GET['deadline'] ? date('Y-m-d', $_GET['deadline']) : '';
$id = $_GET['id'];

?>

<main>
  <h1>Modifier cette tâche</h1>

  <div class="col-12 d-flex flex-column align-items-center p-2">
    <form action="./requete/edit_task.php" method="POST" enctype="multipart/form-data"> <!-- on va gérer des fichiers donc on ajoute enctype="multipart/form-data" -->

      <input type="hidden" name="id" value="<?php echo $id ?>" readonly>  
    
      <!-- zone de retour d'erreur -->
      <?php if(isset($_GET['error'])){ ?>
      <p class="error"><?php echo $_GET['error'] ?></p>
      <?php } ?>

      <!-- input pour le titre du post -->
      <label for="title">Titre</label>
      <input type="text" name="title" placeholder="Titre de la tâche" value="<?php echo $title ?>">

      <!-- input pour la description -->
      <div class="d-flex flex-column mb-3">
        <label for="description">Description</label>
        <textarea name="description" placeholder="Description de la tâche" cols="30" rows="10"><?php echo $description ?></textarea>
      </div>

      <!-- input deadline -->
      <label for="deadline">Date limite</label>
      <input type="date" name="deadline" min="<?php echo date('Y-m-d') ?>" value="<?php echo $deadline ?>">

      <!-- input pour l'image-->
      <label for="image">Charger une image</label>
      <input type="file" name="image">

      <!-- on va affichger l'iamge si elle existe avec son nom -->
        <?php if(!empty($image)){ ?>
        <p>Image actuelle : <?php echo $image ?></p>
        <img src="../images/<?php echo $image ?>" alt="image de la tâche" class="image-card">
        <?php } ?>

        <!-- bouton submit -->
        <div class="d-flex justify-content-center mt-4">
          <button class="box-button" type=""submit>Modifier</button>
        </div>

    </form>
  </div>
</main>

<?php }

require_once('./template/_footer.php');
