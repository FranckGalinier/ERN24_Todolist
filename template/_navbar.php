<div id="navbar">
  <div class="navbar-header">

    <?php session_start(); ?>
    <?php if(!isset($_SESSION['email'])){
      header('Location: ./login.php');
      exit();
    } ?>


    <h5>Bienvenue</h5>
    <p><?php echo $_SESSION['email'] ?></p>
  </div>
  <div class="navbar-link">
    <div>
      <a href="../home.php">Accueil</a>
      <a href="../task.php">Toutes les tâches</a>
      <a href="../add-task.php">Ajouter une tâche</a>
    </div>
    <div>
      <a href="../requete/logout.php">Se déconnecter</a>
    </div>
  </div>
</div>