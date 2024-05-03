<!-- on importe la connexion en premier puis get_task -->
<?php require_once('./requete/connexion.php'); ?>
<?php require_once('./requete/get_task.php'); ?>
<?php require_once('./template/_card.php'); ?>

<!-- on importe le header et la navbar -->
<?php require_once('./template/_header.php'); ?>
<?php require_once('./template/_navbar.php'); ?>


<div class="d-flex flex-column align-items_center">
  <h1>Toutes mes tâches</h1>

  <!-- zone de retour d'erreur -->
  <?php if(isset($_GET['error'])){ ?>
  <p class="error"><?php echo $_GET['error'] ?></p>
  <?php } ?>

  <div class ="d-flex col-10 flex-wrap justify-content-start">
    
    <!--affiche les tâches de l'utilisateur connecté -->
    <?php get_my_task($_SESSION['id']); ?>
  </div>
</div>

<!-- on importe le footer -->
<?php require_once('./template/_footer.php'); ?>