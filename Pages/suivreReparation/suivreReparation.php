<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi de Commande</title>
    <link rel="stylesheet" href="./suivreReparation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
          <li><a href="#">se Deconnecter</a></li>
        </ul>
      </li>
    </ul>
  </nav>

    <h1>Suivi de Réparation</h1>
    <div class="timeline">
        <div class="step-container">
            <div class="step">
                <i class="fas fa-clock"></i>
            </div>
            <p class="step-text">Attente</p>
        </div>
        <div class="line"></div>
        <div class="step-container">
            <div class="step">
                <i class="fas fa-check"></i>
            </div>
            <p class="step-text">Validation</p>
        </div>
       
        <div class="line"></div>
        <div class="step-container">
            <div class="step">
                <i class="fas fa-tools"></i>
            </div>
            <p class="step-text">Réparation</p>
        </div>
        <div class="line"></div>
        <div class="step-container">
            <div class="step">
                <i class="fas fa-car"></i>
            </div>
            <p class="step-text">Livraison</p>
        </div>
    </div>

    <div class="info-box">
        <img src="img/voiture.PNG" alt="Image de voiture" class="car-image">
        <div class="info-details">
            <?php
            // Effectuer la connexion à la base de données
            $conn = new mysqli('localhost', 'utilisateur', 'mot_de_passe', 'nom_de_la_base_de_donnees');
            
            // Vérifier la connexion
            if ($conn->connect_error) {
                die("La connexion a échoué : " . $conn->connect_error);
            }
            
            // Exécuter la requête SQL pour récupérer les données
            $sql = "SELECT * FROM suivi_de_reparation";
            $result = $conn->query($sql);
            
            // Vérifier s'il y a des résultats
            if ($result->num_rows > 0) {
                // Parcourir les résultats et les afficher
                while($row = $result->fetch_assoc()) {
                    $prixReparation = $row["prix_reparation"];
                    $numeroGaragiste = $row["numero_garagiste"];
                    $motifReparation = $row["motif_reparation"];
                    $descriptionReparation = $row["description_reparation"];
                    $etatReparation = $row["etat_reparation"];
            
                    // Utilisez ces variables comme vous le souhaitez, par exemple :
                    echo "<p><strong>Prix réparation :</strong> " . $prixReparation . "</p>";
                    echo "<p><strong>Numéro du garagiste :</strong> " . $numeroGaragiste . "</p>";
                    echo "<p><strong>Motif :</strong> " . $motifReparation . "</p>";
                    echo "<p><strong>Description :</strong> " . $descriptionReparation . "</p>";
                    echo "<p><strong>État :</strong> " . $etatReparation . "</p>";
                }
            } else {
                echo "0 résultats";
            }
            
            // Fermer la connexion
            $conn->close();
            ?>
            
        </div>
    </div>
</body>
</html>
