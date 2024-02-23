<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de voitures</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Bibliothèque</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="accueil">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="book-list">Liste des Livres</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="form-add-book">Ajouter un Livre</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="adherent-list">Liste des Adhérents</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="form-add-adherent">Ajouter un Adhérent</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="form-create-emprunt">Emprunter un Livre</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="emprunt-list">Liste des Emprunts</a>
      </li>
      <!-- Vous pouvez ajouter d'autres liens ici si nécessaire -->
    </ul>
  </div>
</nav>

<?php require $view . '.php' ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

