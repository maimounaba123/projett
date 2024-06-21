<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="./profil.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav id="navigation">
        <a href="../acceuil/acceuil.html" class="logo"><img src="img/Vector.png" style="width: 20%;height: 25%;">  Service<b>Car</b>Link</a>
        <ul class="links">
          <li><a href="../acceuil/acceuil.html">Acceuil</a></li>
          <li><a href="../services/services.html">Nos services</a> </li>
          <li><a href="../Contact/contact.html">Description</a></li>
          
          <li class="dropdown"><a href="../profil/profil.php" class="trigger-drop">Profil<i class="arrow"></i></a>
            <ul class="drop">
              <li><a href="../profil/profil.php">Informations personnelles</a></li>
              <li><button onclick=" deconnexion()">Déconnexion</button></li>
            </ul>
          </li>
        </ul>
      </nav>
    
    <div class="profile-container">
        <div class="left-side">
            <img src="img/user.png" alt="Photo de profil" class="profile-image">
            <div class="user-info">
            <?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if(isset($_SESSION['email'])) {
    // Récupérer l'email du client à partir de la session
    $email_client = $_SESSION['email'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "server";

    // Connexion
    $connexion = new mysqli($servername, $username, $password, $database);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("Connection failed: " . $connexion->connect_error);
    }

    // Requête SQL pour récupérer les informations du client en fonction de son email
    $sql = "SELECT nom, prenom, email, telephone FROM client WHERE email = '$email_client'";

    $result = $connexion->query($sql);

    if ($result->num_rows > 0) {
        // Afficher les données du client
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>Nom :</strong> " . $row["nom"] . "</p>";
            echo "<p><strong>Prénom :</strong> " . $row["prenom"] . "</p>";
            echo "<p><strong>Email :</strong> " . $row["email"] . "</p>";
            echo "<p><strong>Téléphone :</strong> " . $row["telephone"] . "</p>";
        }
    } else {
      header("Location: acceuil/acceuil.html");
      exit();
    }

    // Fermer la connexion
    $connexion->close();
} else {
  header("Location: acceuil/acceuil.html");
  exit();
}
?>

              
            </div>
        </div>
        <div class="right-side">
            <div class="action-box">
                <i class="material-icons acolor">edit</i>
                <span><a href="editProfil/editProfil.html">Éditer mon profil</a></span>
            </div>
            <div class="action-box">
                <i class="material-icons acolor">exit_to_app</i>
                <span>Déconnecter</span>
            </div>
            <div class="action-box">
                <i class="material-icons acolor">vpn_key</i>
                <span><a href="changerPassword/changerPassword.html">Changer mon mot de passe</a></span>
            </div>
        </div>
    </div>
  <script>
    // Fonction pour se déconnecter
    function deconnexion() {
          window.location.href = "acceuil.html";
            // Redirigez vers la page de connexion ou effectuez d'autres actions nécessaires
        }
  </script>
</body>
</html>
