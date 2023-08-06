<nav class="container-fluid px-5 navbar navbar-expand-lg navbar-dark bg-primary px-5">
  <a class="navbar-brand" href="Acceuil.php"><img src="icons/icons8-amazone-48.png" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span> <!-- js -->
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: flex; justify-content:space-between">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link text-white pe-3" href="Acceuil.php">Acceuil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white pe-3" href="Ajout_prod.php">Ajouter</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white pe-3" href="contact.php">Contact</a>
      </li>
    </ul>
    <div>
      <form class="form-inline d-flex justify-content-end my-2 my-lg-0" method="GET">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" name="value" aria-label="Search" style="width: 210px;">
        <button class="btn btn-outline-light ms-2 my-2 my-sm-0" type="submit" name="search" formaction="search.php">Search</button>
        <a class="ms-5" href="#"><img src="icons/icons8-utilisateur-30.png" title="
            <?php if (isset($_SESSION['user'])) {
              if (date("H") < 17) {
                $date = "Bonjour";
              } else {
                $date = "Bonsoir";
              }
            ?>
              <?php echo $date . " " . $_SESSION['user']['nom'] ?>
           <?php }
            ?>" /></a>
        <?php
        if (isset($_SESSION['user'])) { ?>
          <a class="ms-5" href="deconnexion.php"><img src="icons/icons8-sortie-30.png" title="Log Out" /></a>
        <?php
        }
        ?>

      </form>
    </div>


  </div>
</nav>