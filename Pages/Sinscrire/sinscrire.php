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
    die(json_encode(array("success" => false, "message" => "Échec de la connexion à la base de données : " . $connexion->connect_error)));
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $motdepasse = $_POST["motdepasse"];
    $confirmermotdepasse = $_POST["confirmermotdepasse"];
    $region = $_POST["region"];
    $telephone = $_POST["telephone"];
    $adresse = $_POST["adresse"];

    // Vérifier si les mots de passe correspondent
    if ($motdepasse !== $confirmermotdepasse) {
        echo json_encode(array("success" => false, "message" => "Les mots de passe ne correspondent pas."));
        exit;
    }

    // Hacher le mot de passe avant de le stocker dans la base de données
    $motdepasse_hash = password_hash($motdepasse, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête SQL d'insertion
    $requete = "INSERT INTO client (nom, prenom, email, motdepasse, region, telephone, adresse) 
                VALUES ('$nom', '$prenom', '$email', '$motdepasse_hash', '$region', '$telephone', '$adresse')";

    if ($connexion->query($requete) === TRUE) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "message" => "Erreur lors de l'insertion de l'enregistrement : " . $connexion->error));
    }
}

// Fermer la connexion à la base de données
$connexion->close();
?>
