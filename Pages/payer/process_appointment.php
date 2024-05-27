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
    $marque = $_POST["model"];
    $prix = $_POST["price"];
    $nom = $_POST["name"];
    $adresse = $_POST["address"];
    $mode_paiement = $_POST["paymentType"];
    $numero_carte = $_POST["paymentSubtype"];
    $numero_cheque = $_POST["chequeNumber"];
    $couleur_voiture = $_POST["color"];
    $livraison_domicile = $_POST["delivery"];
    $date_livraison = $_POST["deliveryDate"];
    $heure_livraison = $_POST["deliveryTime"];

    // Préparer et exécuter la requête SQL d'insertion
    $requete = "INSERT INTO commandes (modele, marque, prix, nom_prenom, adresse, mode_paiement, numero_carte, numero_cheque, couleur, livraison_domicile, date_livraison, heure_livraison) 
            VALUES ('$modele', '$marque', '$prix', '$nom_prenom', '$adresse', '$mode_paiement', '$numero_carte', '$numero_cheque', '$couleur', '$livraison_domicile', '$date_livraison', '$heure_livraison')";


    if ($connexion->query($requete) === TRUE) {
        // Rediriger vers une autre page après l'insertion
        header("Location: acheterVoiture/acheter.html");
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Erreur lors de l'insertion de l'enregistrement : " . $connexion->error;
    }
}

// Fermer la connexion à la base de données
$connexion->close();
?>
