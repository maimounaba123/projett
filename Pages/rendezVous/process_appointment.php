<?php
// Paramètres de connexion à la base de données
$serveur = "localhost"; // ou l'adresse IP du serveur MySQL
$utilisateur = "root";
$motdepasse = "";
$base_de_donnees = "server";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $matricule = $_POST["matricule"];
    $model = $_POST["model"];
    $brand = $_POST["brand"];
    $vehicleType = $_POST["vehicleType"];
    $vehicleSubtype = $_POST["vehicleSubtype"];
    $motif = $_POST["motif"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $color = $_POST["color"];

    // Préparer et exécuter la requête SQL d'insertion
    $requete = $connexion->prepare("INSERT INTO appointments (matricule, model, brand, vehicleType, vehicleSubtype, motif, date, time, color) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $requete->bind_param("sssssssss", $matricule, $model, $brand, $vehicleType, $vehicleSubtype, $motif, $date, $time, $color);

    if ($requete->execute()) {
        // Message de succès
        header("Location: rendezVous/rendezVous.html");
        exit();
    } else {
        // Message d'erreur
        header("Location: rendezVous/rendezVous.html");
        exit();
    }

    $requete->close();
}

// Fermer la connexion à la base de données
$connexion->close();
?>
