<!-- on importe le header et la navbar -->
<?php require_once('./template/_header.php'); ?>
<?php require_once('./template/_navbar.php'); ?>




<main>
  <h1>Ajouter une tâche</h1>

  <div class="col-12 d-flex flex-column align-items-center p-2">
    <form action="./requete/add_new_task.php" method="POST" enctype="multipart/form-data"> <!-- on va gérer des fichiers donc on ajoute enctype="multipart/form-data" -->

      <!-- zone de retour d'erreur -->
      <?php if(isset($_GET['error'])){ ?>
      <p class="error"><?php echo $_GET['error'] ?></p>
      <?php } ?>

      <!-- input pour le titre du post -->
      <label for="title">Titre</label>
      <input type="text" name="title" placeholder="Titre de la tâche">

      <!-- input pour la description -->
      <div class="d-flex flex-column mb-3">
        <label for="description">Description</label>
        <textarea name="description" placeholder="Description de la tâche" cols="30" rows="10"></textarea>
      </div>

      <!-- input deadline -->
      <label for="deadline">Date limite</label>
      <input type="date" name="deadline" min="<?php echo date('Y-m-d'); ?>">

      <!-- input pour l'image-->
      <label for="image">Charger une image</label>
      <input type="file" name="image">

        <!-- bouton submit -->
      <div class="d-flex justify-content-center mt-4">
        <button class="box-button" type=""submit>Ajouter</button>
      </div>

    </form>
  </div>
</main>

<!-- on importe le footer -->
<?php require_once('./template/_footer.php'); ?>